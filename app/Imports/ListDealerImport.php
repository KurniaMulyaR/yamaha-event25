<?php

namespace App\Imports;

use App\Models\Provinces;
use App\Models\District;
use App\Models\Cities;
use App\Models\ListDelear;
use App\Models\ListPesanan;
use App\Models\DataUser;
use App\Models\ListProduk;
use App\Models\Notifikasi;
use App\Models\Varian;
use App\Models\User;
use App\Jobs\SendInfobipWhatsAppJob;
use App\Models\CbuDelear;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class ListDealerImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // $province = Province::where('name', $row['provinsi'])->first();
        // $city = Cities::where('name', $row['KOT/KAB'])->first();
        // $district = District::with(['cities.province'])->where('code', $row['kecamatan'])->first();
        // $kot = Cities::where('code', $row['kot'])->first();
        // if (!$kot) {
        //     \Log::warning('Kecamatan tidak ditemukan', [
        //         'kecamatan_excel' => $row['kecamatan'],
        //     ]);
        //     return null;
        // }

        // return new CbuDelear([
        //     'code'          => $row['code'],
        //     'district_code' => (int) $row['kecamatan'] ?? '-',
        //     'namedds'       => $row['name_ddsmd'],
        //     'namedelear'    => $row['nama_dealer'],
        //     'provinsi'      => (int) $row['provinci'],
        //     'kota'          => $kot->name ?? '-',
        //     'code_kota'     => (int) $row['kot'],
        //     'kecamatan'     =>  '-',
        //     'district_id'   =>  '-',
        //     'cansell' => $row['can_sell'],
        // ]);

        // $list = ListDelear::where('code', $row['code'])->first();

        // if ($list) {
        //     $list->cansell = $row['can_sell'] ?? '-';
        //     $list->save();
        // } else {
        //     // Bisa buat log / buat record baru
        //     // misal: ListDelear::create([...])
        //     Log::warning("Dealer code {$row['code']} tidak ditemukan");
        // }

        $pesanan = ListPesanan::where('orderid',$row['orderid'])->first();

        $pesanan->update([
            'delearid' => $row['code'],
            'status' => 'LUNAS',
            'keterangan' => 'IMPORT-DATA',
        ]);

        // if ($row['transactionstatus'] == 'settlement') {
            $Datauser = DataUser::with(['user'])->where('userid', $pesanan->userid)->first();
            $Datauser->dealer = $row['code'];
            $Datauser->save();

            $passwordPlain = Str::random(10);
            $produk = ListProduk::find($pesanan->produkid);
            $varian = Varian::find($pesanan->varianid);

            if (!$produk) {
                Log::warning('Produk tidak ditemukan', [
                    'produkid' => $pesanan->produkid
                ]);
                return null;
            }

            ListDelear::updateOrCreate(
                ['code' => $row['code']],
                [
                    'code' => $row['code'],
                    'district_code' => '0',
                    'namedds' => $row['ddsmd'],
                    'provinsi' => $row['provinsi'],
                    'kota' => $row['kot'],
                    'kecamatan' => '-',
                    'namedelear' $row['dealer'],
                    'code_kota' => '0',
                    'cansell' => $produk->name,
                ]
            );

            // if ($Datauser->dealer == 0) {
            //     $delernm = 'Rekomendasi';
            // }else{
                 if($produk->name != ' TMAX'){
                    $dealer = ListDelear::where('code', $Datauser->dealer)->first();
                    $delernm = $dealer->namedelear;
                }else {
                    $dealer = CbuDelear::where('code', $Datauser->dealer)->first();
                    $delernm = $dealer->namedelear;
                }
            // }

            // if($delernm != 'Rekomendasi'){
                $phone = preg_replace('/[^0-9]/', '', $Datauser->no_telepon_pembeli);

                if (str_starts_with($phone, '0')) {
                    $phone = '+62' . substr($phone, 1);
                } elseif (str_starts_with($phone, '62')) {
                    $phone = '+' . $phone;
                } elseif (str_starts_with($phone, '8')) {
                    $phone = '+62' . $phone;
                }

                $tipe = $produk->name . ' ' . $varian->name;
                // Data JSON sesuai struktur Infobip
                $postData = [
                    "messages" => [
                        [
                            "from" => config('services.infobip.sender'),
                            "to" => $phone,
                            "messageId" => "876234998113297",
                            "content" => [
                                "templateName" => "5118_booking_online_fixed",
                                "templateData" => [
                                    "body" => [
                                        "placeholders" => [$Datauser->nama_pembeli, $delernm, $tipe]
                                    ]
                                ],
                                "language" => "id"
                            ],
                            "callbackData" => "template-message",
                            "urlOptions" => [
                                "shortenUrl" => true,
                                "trackClicks" => true,
                                "trackingUrl" => "https://maxi25.com",
                                "removeProtocol" => true
                            ]
                        ]
                    ]
                ];
                
                $user = User::findOrFail($Datauser->userid);
                $user->password = Hash::make($passwordPlain);
                $user->save();
                $data = [
                    'name' => $Datauser->nama_pembeli,
                    'delear' => $delernm,
                    'tipe' => $tipe,
                    'password' => $passwordPlain,
                    'email' => $user->email,
                ];

                // SendInfobipWhatsAppJob::dispatch($postData)
                //     ->delay(now()->addMinutes(2));
                // Mail::to($user->email)
                //     ->later(now()->addMinutes(2), new TestMail($data));

                Notifikasi::create([
                    'userid' => $Datauser->userid,
                    'phone' => $phone,
                    'email' => $user->email,
                    'post_data' => $postData, // otomatis jadi JSON
                    'status' => 'pending',
                ]);

                // // Request POST ke Infobip API
                // $response = Http::withHeaders([
                //     'Authorization' => 'App ' . config('services.infobip.api_key'),
                //     'Content-Type' => 'application/json'
                // ])->post('https://api.infobip.com/whatsapp/1/message/template', $postData);

                // // Response dari Infobip
                // if ($response->successful()) {
                    
                //     return response()->json([
                //         'status' => 'success',
                //         'data' => $response->json()
                //     ]);
                // } else {
                //     return response()->json([
                //         'status' => 'error',
                //         'message' => $response->body()
                //     ], $response->status());
                // }
            // }
        // }

        //  return response()->json(['success' => true]);

    }
}
