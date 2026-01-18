<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListProduk;

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
        $query = ListProduk::query();

        // Search
        if ($search = $request->input('search.value')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $total = $query->count();

        $produk = $query
            ->offset($request->start)
            ->limit($request->length)
            ->get()
            ->map(function ($produk) {
                return [
                    'id' => $produk->id,
                    'name' => $produk->name,
                    'type' => $produk->type,
                    'price' => $produk->price,
                    'ttlunit' => $produk->ttlunit,
                    'colour' => $produk->colour,
                    // 🖼️ FOTO PRODUK
                    'img' => $produk->img
                            ? '<img src="'.asset('storage/'.$produk->img).'"
                                    class="w-12 h-12 rounded object-cover mx-auto cursor-pointer preview-img"
                                    data-img="'.asset('storage/'.$produk->img).'">'
                            : '<div class="w-12 h-12 bg-gray-300 rounded flex items-center justify-center text-xs">
                                N/A
                            </div>',
                    'created_at' => $produk->created_at->format('Y-m-d'),
                    'action' => view('admin.produk.partials', compact('produk'))->render()
                ];
            });;

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $produk,
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
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'ttlunit' => 'required|string|max:255',
            'colour' => 'required|string|max:255',
            'img' => 'required|image|mimes:jpg,jpeg,png|max:2048'
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
        return ListProduk::findOrFail($id);
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

        if ($request->hasFile('img')) {

            // hapus foto lama
            if ($produk->img && Storage::disk('public')->exists($produk->img)) {
                Storage::disk('public')->delete($produk->img);
            }   

            // simpan foto baru
            $produk->img = $request->file('img')->store('produk', 'public');
        }

        $produk->update([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'unit' => $request->unit,
            'colour' => $request->colour,
        ]);

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
        $produk->delete();

        return response()->json(['success' => true]);
    }
}
