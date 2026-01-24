<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListPesanan;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pesanan.index');
    }

    public function getPesanan(Request $request)
    {
        $query = ListPesanan::query()
                    ->with(['produk','delear','datauser.user']);

        // Search
        if ($search = $request->input('search.value')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $total = $query->count();

        $pesanan = $query
            ->offset($request->start)
            ->limit($request->length)
            ->get()
            ->map(function ($pesanan) {
                $statusBadge = match ($pesanan->status) {
                    'PENDING' => '<span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">PENDING</span>',
                    'LUNAS' => '<span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-200 rounded-full">LUNAS</span>',
                    'PENGIRIMAN' => '<span class="px-2 py-1 text-xs font-semibold text-blue-700 bg-blue-200 rounded-full">PENGIRIMAN</span>',
                    'TERKIRIM' => '<span class="px-2 py-1 text-xs font-semibold text-green-900 bg-green-400 rounded-full">TERKIRIM</span>',
                    default => '<span class="px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-200 rounded-full">-</span>',
                };

                return [
                    'id' => $pesanan->datauser->user->id,
                    'name' => $pesanan->datauser->user->name,
                    'produk' => $pesanan->produk->name,
                    'delear' => $pesanan->delear->namedelear,
                    'status' => $statusBadge,
                    'keterangan' => $pesanan->keterangan,
                    'created_at' => $pesanan->created_at->format('Y-m-d'),
                    'action' => view('admin.pesanan.partials', compact('pesanan'))->render()
                ];
            });

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $pesanan,
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
        //
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
        return ListPesanan::findOrFail($id);
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
        $pesanan = ListPesanan::findOrFail($id);

        $pesanan->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan
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
        //
    }
}
