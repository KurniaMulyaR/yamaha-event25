<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListProduk;

class HomeController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function motor()
    {
        $produk = ListProduk::with('varians')
                ->select('id','name','type','price','ttlunit','colour','img')
                ->orderBy('id')
                ->get()
                ->map(function ($item) {
                    return [
                        'id'      => $item->id,
                        'key'     => 'produk-' . $item->id,

                        // PRODUK
                        'title'   => $item->name,
                        'name'    => $item->name,
                        'type'    => $item->type,
                        'price'   => $item->price,
                        'price_rp'=> 'Rp.' . number_format($item->price, 0, ',', '.'),
                        'ttlunit' => $item->ttlunit,
                        'colour'  => $item->colour,
                        'sold'    => 0,

                        // IMAGE
                        'img'     => $item->img,
                        'image'   => $item->img
                            ? asset('storage/' . $item->img)
                            : null,

                            
                        // 🔥 VARIAN (PENTING BUAT EDIT)
                        'varians' => $item->varians->map(function ($v) {
                            return [
                                'id'      => $v->id,
                                'name'    => $v->name,
                                'jmlunit' => $v->jmlunit,
                                'colour'  => $v->colour,
                                'price'  => 'Rp.' . number_format($v->price, 0, ',', '.'),
                                'dp' => 'Rp.' . number_format($v->dp, 0, ',', '.'),
                                'img' => $v->img
                                        ? asset('storage/' . $v->img)
                                    : null,
                            ];
                        })->values(),
                    ];
                });

                return view('motor', compact('produk'));
    }

    public function generalprivacy()
    {
        return view('generalprivacy');
    }
}
