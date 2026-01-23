<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListProduk;
use Illuminate\Support\Facades\Storage;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.produk.index');
    }

    public function getProduk(Request $request)
    {
        $query = ListProduk::with('varians');

        // Search
        if ($search = $request->input('search.value')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%")
                ->orWhereHas('varians', function ($v) use ($search) {
                    $v->where('name', 'like', "%{$search}%");
                });
            });
        }

        $total = ListProduk::count();
        $filtered = $query->count();


        $produk = $query
            ->offset($request->start)
            ->limit($request->length)
            ->latest()
            ->get();
            $data = $produk->map(function ($produk) {

        $varianHtml = $produk->varians->map(function ($v) {
            $pricev = $v->price;
            return "<span class='px-2 py-1 bg-gray-100 rounded text-xs mr-1'>
                        {$v->name} ({$v->jmlunit}) ({$pricev})
                    </span>";
        })->implode('');

        return [
            'id' => $produk->id,
            'name' => $produk->name,
            'type' => $produk->type,
            'price' => number_format($produk->price) ?? 0,
            'ttlunit' => $produk->ttlunit,
            'colour' => $produk->colour,

            // FOTO
            'img' => $produk->img
                ? '<img src="'.asset('storage/'.$produk->img).'"
                        class="w-12 h-12 rounded object-cover mx-auto cursor-pointer preview-img"
                        data-img="'.asset('storage/'.$produk->img).'">'
                : '<div class="w-12 h-12 bg-gray-300 rounded flex items-center justify-center text-xs">
                    N/A
                </div>',

            // VARIAN
            'varian' => $varianHtml ?: '-',

            'created_at' => $produk->created_at->format('Y-m-d'),

            'action' => view('admin.produk.partials', compact('produk'))->render()
        ];
    });


        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'type'     => 'required|string|max:255',
            'price'    => 'required|string|max:255',
            'ttlunit'  => 'required|string|max:255',
            'colour'   => 'required|string|max:255',
            'img'      => 'required|image|mimes:jpg,jpeg,png|max:2048',

            'varian.*.name'    => 'required|string|max:255',
            'varian.*.jmlunit' => 'required|numeric',
            'varian.*.colour'  => 'required|string|max:255',
            'varian.*.price'  => 'required|string|max:255',
        ]);

        $photoPath = null;

        if ($request->hasFile('img')) {
            $photoPath = $request->file('img')->store('produk', 'public');
        }

        ListProduk::create([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'ttlunit' => $request->ttlunit,
            'colour' => $request->colour,
            'img' => $photoPath
        ]);

        if ($request->varian) {
            foreach ($request->varian as $v) {
                $produk->varians()->create([
                    'name'    => $v['name'],
                    'jmlunit' => $v['jmlunit'],
                    'colour'  => $v['colour'],
                    'price'  => $v['price'],
                ]);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return ListProduk::with('varians')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produk = ListProduk::findOrFail($id);

        /* =======================
        UPDATE FOTO
        ======================= */
        if ($request->hasFile('img')) {

            if ($produk->img && Storage::disk('public')->exists($produk->img)) {
                Storage::disk('public')->delete($produk->img);
            }

            $produk->img = $request->file('img')->store('produk', 'public');
        }

        /* =======================
        UPDATE PRODUK
        ======================= */
        $produk->update([
            'name'   => $request->name,
            'type'   => $request->type,
            'price'  => $request->price ?? 0,
            'unit'   => $request->unit,
            'colour' => $request->colour,
        ]);

        /* =======================
        UPSERT VARIAN
        ======================= */
        if ($request->varian) {
            foreach ($request->varian as $v) {
                $produk->varians()->updateOrCreate(
                    [
                        'id' => $v['id'] ?? null, // kalau ada → update
                    ],
                    [
                        'name'      => $v['name'],
                        'jmlunit'   => $v['jmlunit'],
                        'colour'    => $v['colour'],
                        'price'    => $v['price'],
                        'produk_id' => $produk->id,
                    ]
                );
            }
        }


        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = ListProduk::findOrFail($id);

        // hapus gambar
        if ($produk->img && Storage::disk('public')->exists($produk->img)) {
            Storage::disk('public')->delete($produk->img);
        }

        // hapus varian
        $produk->varians()->delete();

        // hapus produk
        $produk->delete();

        return response()->json(['success' => true]);
    }
}
