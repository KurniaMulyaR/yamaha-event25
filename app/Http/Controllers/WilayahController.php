<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use App\Models\ListDelear;
use App\Models\CbuDelear;
use App\Models\Varian;

class WilayahController extends Controller
{
     // PROVINSI
    public function provinsi($id)
    {
        $varian = Varian::with('produk')->findOrFail($id);

         if (strtoupper($varian->produk->name) === 'TMAX') {
            $del = CbuDelear::with('provinsi')
                ->orderBy('namedds')
                ->get();

            $prv = [];
            foreach($del as $dil){
                $provinsi = Province::where('code', $dil->provinsi)->first();
                $prv[] = $provinsi; 
            }
            $prov = collect($prv)->unique('code')->values(); 
            
            return response()->json($prov);
         }else{
            return response()->json(
                Province::select('code', 'name')->orderBy('name')->get()
            );
         }
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

        if (strtoupper($varian->produk->name) === 'TMAX') {
            // Ambil semua dealer di kota
            $del = CbuDelear::where('provinsi', $id[0])
                ->select('code','namedelear','cansell')
                ->orderBy('namedelear')
                ->get();
        }else{
            // Ambil semua dealer di kota
            $del = ListDelear::select('code','namedelear','cansell')
                ->orderBy('namedelear')
                ->get();
        }
        

        // Filter sesuai varian
        $deler = [];

        foreach($del as $dilir) {
            $deler[] = $dilir;  
        }

        // Kembalikan JSON
        return response()->json($deler);
    }
}
