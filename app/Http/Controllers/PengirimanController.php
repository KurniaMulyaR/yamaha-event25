<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListPesanan;
use App\Models\ListProduk;
use App\Models\Varian;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\DataUser;
use App\Models\User;
use App\Models\CbuDelear;
use App\Models\ListDelear;
use Midtrans\Snap;
use Midtrans\Config;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pesanan.index');
    }

    public function getPesanan(Request $request)
    {
        $query = ListPesanan::query()
                    ->with(['produk','delear','datauser.user']);

        // Search
        if ($search = $request->input('search.value')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $total = $query->count();

        $pesanan = $query
            ->offset($request->start)
            ->limit($request->length)
            ->get()
            ->map(function ($pesanan) {
                $statusBadge = match ($pesanan->status) {
                    'PENDING' => '<span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">PENDING</span>',
                    'LUNAS' => '<span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-200 rounded-full">LUNAS</span>',
                    'PENGIRIMAN' => '<span class="px-2 py-1 text-xs font-semibold text-blue-700 bg-blue-200 rounded-full">PENGIRIMAN</span>',
                    'TERKIRIM' => '<span class="px-2 py-1 text-xs font-semibold text-green-900 bg-green-400 rounded-full">TERKIRIM</span>',
                    default => '<span class="px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-200 rounded-full">-</span>',
                };

                if($pesanan->delearid == 0)
                    {
                        $deler = 'Rekomendasi';
                    }else{
                        $deler = $pesanan->delear->namedelear;
                    }
                if ($pesanan->produk != null) {
                    $varian = Varian::findOrFail($pesanan->varianid);
                    $produk = $varian->name;
                }else{
                    $produk = $pesanan->produkid;
                }

                return [
                    'id' => $pesanan->datauser->user->id,
                    'orderid' => $pesanan->orderid,
                    'name' => $pesanan->datauser->user->name,
                    'produk' => $produk,
                    'delear' => $deler,
                    'status' => $statusBadge,
                    'keterangan' => $pesanan->keterangan,
                    'created_at' => $pesanan->created_at->format('Y-m-d'),
                    'action' => view('admin.pesanan.partials', compact('pesanan'))->render()
                ];
            });

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $pesanan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return ListPesanan::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pesanan = ListPesanan::findOrFail($id);

        $pesanan->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);

        if ($request->status == 'LUNAS') {
            $Datauser = DataUser::with(['user'])->where('userid', $pesanan->userid)->first();
            $passwordPlain = Str::random(10);
            $produk = ListProduk::findOrFail($pesanan->produkid);
            $varian = Varian::findOrFail($pesanan->varianid);
            if ($Datauser->dealer == 0) {
                $delernm = 'Rekomendasi';
            }else{
                 if($produk->name != ' TMAX'){
                    $dealer = ListDelear::where('code', $Datauser->dealer)->first();
                    $delernm = $dealer->namedelear;
                }else {
                    $dealer = CbuDelear::where('code', $Datauser->dealer)->first();
                    $delernm = $dealer->namedelear;
                }
            }

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

            // Request POST ke Infobip API
            $response = Http::withHeaders([
                'Authorization' => 'App ' . config('services.infobip.api_key'),
                'Content-Type' => 'application/json'
            ])->post('https://api.infobip.com/whatsapp/1/message/template', $postData);

            // Response dari Infobip
            if ($response->successful()) {
                Mail::to($user->email)->send(new TestMail($data));

                return response()->json([
                    'status' => 'success',
                    'data' => $response->json()
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => $response->body()
                ], $response->status());
            }
        }

         return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
