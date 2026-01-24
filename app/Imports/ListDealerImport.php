<?php

namespace App\Imports;

use App\Models\Provinces;
use App\Models\District;
use App\Models\Cities;
use App\Models\ListDelear;
use App\Models\CbuDelear;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;


class ListDealerImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // $province = Province::where('name', $row['provinsi'])->first();
        // $city = Cities::where('name', $row['KOT/KAB'])->first();
        // $district = District::with(['cities.province'])->where('code', $row['kecamatan'])->first();
        $kot = Cities::where('code', $row['kot'])->first();
        // if (!$kot) {
        //     \Log::warning('Kecamatan tidak ditemukan', [
        //         'kecamatan_excel' => $row['kecamatan'],
        //     ]);
        //     return null;
        // }

        return new CbuDelear([
            'code'          => $row['code'],
            'district_code' => (int) $row['kecamatan'] ?? '-',
            'namedds'       => $row['name_ddsmd'],
            'namedelear'    => $row['nama_dealer'],
            'provinsi'      => (int) $row['provinci'],
            'kota'          => $kot->name ?? '-',
            'code_kota'     => (int) $row['kot'],
            'kecamatan'     =>  '-',
            'district_id'   =>  '-',
            'cansell' => $row['can_sell'],
        ]);

        // $list = ListDelear::where('code', $row['code'])->first();

        // if ($list) {
        //     $list->cansell = $row['can_sell'] ?? '-';
        //     $list->save();
        // } else {
        //     // Bisa buat log / buat record baru
        //     // misal: ListDelear::create([...])
        //     Log::warning("Dealer code {$row['code']} tidak ditemukan");
        // }
    }
}
