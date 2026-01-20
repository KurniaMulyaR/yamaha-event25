<?php

namespace App\Imports;

use App\Models\Provinces;
use App\Models\District;
use App\Models\Cities;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ListDealerImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        // $province = Province::where('name', $row['provinsi'])->first();
        // $city = Cities::where('name', $row['KOT/KAB'])->first();
        $district = District::with(['cities.province'])->where('name', $row['kecamatan'])->first();

        return new ListDealer([
            'code'          => $row['code'],
            'district_code' => (int) $row['kecamatan'],
            'namedds'       => $row['nameddsmd'],
            'namedelear'    => $row['namadealer'],
            'province_id'   => $district->cities->province->id,
            'city_id'       => $district->cities->id,
            'district_id'   => $district->id,
        ]);
    }
}
