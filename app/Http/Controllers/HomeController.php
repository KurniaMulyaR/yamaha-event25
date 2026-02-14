<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListProduk;
use App\Models\User;
use App\Models\DataUser;
use App\Models\ListPesanan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class HomeController extends Controller
{
    public function home()
    {
        return view('welcome',  [
            'maxi' => urlencode(Crypt::encryptString('maxi')),
        ]);
    }

    public function motor($enc)
    {
        return view('welcome',  [
            'maxi' => urlencode(Crypt::encryptString('maxi')),
        ]);
        try {
            $motor = Crypt::decryptString(urldecode($enc));
            
        } catch (DecryptException $e) {
            abort(404);
        }
        if($motor == 'maxi'){
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
                                'defaultVarian' => 2,
                                
                            ];
                        })->values(),
                    ];
                });
                
                return view('motor', compact('produk'));
        }else{
             abort(404);
        }   

    }

    public function generalprivacy()
    {
        return view('generalprivacy');
    }

    public function dashboard()
    {
        // ===== BASIC COUNT =====
        $totalUsers     = User::count();
        $totalDataUser  = DataUser::count();
        $totalOrders    = ListPesanan::count();

        $totalPaid      = ListPesanan::where('status', 'LUNAS')->count();
        $totalFailed    = ListPesanan::where('status', 'PENDING')->count();
        $ctr = ($totalPaid / $totalDataUser) * 100;

        // ===== SAFE CALCULATION =====
        $conversionRate = 0;
        $successRate    = 0;
        $failureRate    = 0;

        if ($totalUsers > 0) {
            $conversionRate = ($totalPaid / $totalUsers) * 100;
        }

        if ($totalOrders > 0) {
            $successRate = ($totalPaid / $totalOrders) * 100;
            $failureRate = ($totalFailed / $totalOrders) * 100;
        }

        // ===== FORMAT 2 DECIMAL =====
        $conversionRate = number_format($conversionRate, 2);
        $successRate    = number_format($successRate, 2);
        $failureRate    = number_format($failureRate, 2);
        $ctrttl = number_format($ctr, 2);

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDataUser',
            'totalOrders',
            'totalPaid',
            'totalFailed',
            'conversionRate',
            'successRate',
            'failureRate',
            'ctrttl'
        ));
    }
}
