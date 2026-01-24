<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use App\Models\ListDelear;
use App\Models\Varian;

class WilayahController extends Controller
{
     // PROVINSI
    public function provinsi()
    {
        return response()->json(
            Province::select('code', 'name')->orderBy('name')->get()
        );
    }

    // KOTA / KAB
    public function kota($provinsi)
    {
        return response()->json(
            City::where('province_code', $provinsi)
                ->select('code', 'name')
                ->orderBy('name')
                ->get()
        );
    }

    // KECAMATAN
    public function kecamatan($kota)
    {
        return response()->json(
            District::where('city_code', $kota)
                ->select('code', 'name')
                ->orderBy('name')
                ->get()
        );
    }

    // KELURAHAN
    public function kelurahan($kota)
    {
        return response()->json(
            Village::where('district_code', $kota)
                ->select('code', 'name')
                ->orderBy('name')
                ->get()
        );
    }

    // DEALER
    public function dealer($kota)
    {
        $id = explode('|', $kota); // misal "kodeKota|varianId"

        // Ambil varian
        $varian = Varian::with('produk')->findOrFail($id[1]);

        // Ambil semua dealer di kota
        $del = ListDelear::where('code_kota', $id[0])
            ->select('code','namedelear','cansell')
            ->orderBy('namedelear')
            ->get();

        // Filter sesuai varian
        $deler = [];

        foreach($del as $dilir) {
            // Jika varian TMAX, tampilkan hanya dealer yang cansell = TMAX
            if(strtoupper($varian->name) === 'TMAX') {
                if(strtoupper($dilir->cansell) === 'TMAX') {
                    $deler[] = $dilir;
                }
            } else {
                // selain TMAX, tampilkan semua dealer
                $deler[] = $dilir;
            }
        }

        // Kembalikan JSON
        return response()->json($deler);
    }
}
