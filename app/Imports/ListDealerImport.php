<?php

namespace App\Imports;

use App\Models\Provinces;
use App\Models\District;
use App\Models\Cities;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ListDealerImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $province = Province::where('name', $row['provinsi'])->first();
        $city = Cities::where('name', $row['kota'])->first();
        $district = District::where('name', $row['kecamatan'])->first();

        return new ListDealer([
            'code'          => $row['code'],
            'district_code' => $row['district_code'],
            'namedds'       => $row['namedds'],
            'namedelear'    => $row['namedelear'],
            'province_id'   => $province?->id,
            'city_id'       => $city?->id,
            'district_id'   => $district?->id,
        ]);
    }
}
