<?php

namespace App\Imports;

use App\Models\Provinces;
use App\Models\District;
use App\Models\Cities;
use App\Models\ListDelear;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ListDealerImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // $province = Province::where('name', $row['provinsi'])->first();
        // $city = Cities::where('name', $row['KOT/KAB'])->first();
        $district = District::with(['cities.province'])->where('code', $row['kecamatan'])->first();
        if (!$district) {
            \Log::warning('Kecamatan tidak ditemukan', [
                'kecamatan_excel' => $row['kecamatan'],
            ]);
            return null;
        }

        return new ListDelear([
            'code'          => $row['code'],
            'district_code' => (int) $row['kecamatan'],
            'namedds'       => $row['nameddsmd'],
            'namedelear'    => $row['namadealer'],
            'provinsi'      => $district->cities->province->name ?? '-',
            'kota'          => $district->cities->name ?? '-',
            'kecamatan'     => $district->name,
            'district_id'   => $district->id,
        ]);
    }
}
