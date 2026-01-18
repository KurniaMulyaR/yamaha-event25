<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListProduk;

class HomeController extends Controller
{
    public function home()
    {
        $produk = ListProduk::select('name','type','price','ttlunit','colour','img','id')
        ->orderBy('id')
        ->get()
        ->map(function ($item) {
            return [
                'title' => $item->name,
                'image' => asset('storage/' . $item->img),
                'id'    => $item->id, // 🔑 paling aman
                'key'   => 'produk-' . $item->id, // 🔥 unik
                'price' => 'Rp.' . number_format($item->price, 0,',','.'),
                'ttlunit' => $item->ttlunit,
                'sold' => 0,
                'colour' => $item->colour,
                'type' => $item->type,
            ];
        });

        return view('welcome', compact('produk'));
    }
}
