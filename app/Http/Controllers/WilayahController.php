<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use App\Models\ListDelear;

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
        return response()->json(
            ListDelear::where('district_code', $kota)
                ->select('code', 'namedds')
                ->orderBy('namedds')
                ->get()
        );
    }
}
