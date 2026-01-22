<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListProduk;
use App\Models\Varian;
use App\Models\ListPesanan;
use App\Models\DataUser;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Midtrans\Snap;
use Midtrans\Config;
use GuzzleHttp\Client;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('booking.index');
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
        $produk = ListProduk::findOrFail($request->produk_id);
        
        $varian = Varian::findOrFail($request->varian_id);

        return view('booking.index', compact('produk', 'varian'));
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
        //
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
        //
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

    public function pembayaran(Request $request)
    {
        $password = Hash::make('MOTOR');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'role' => 'user'
        ]);

        $dataUser = DataUser::create([
            'userid' => $user->id,
            'nama_pembeli' => $request->name,
            'no_ktp_pembeli' => $request->noktp,
            'tempat_lahir_pembeli' => $request->tempatlahir,
            'tanggal_lahir_pembeli' => $request->tgllahir,
            'alamat_pembeli' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'no_telepon_pembeli' => $request->nohp,
            'no_handphone_pembeli' => 0,
            'email_pembeli' => $user->email,
            'dealer' => $request->dealer,
            'metode_pembayaran' => $request->metodpem,
            'stnk_nama_pemakai' => $request->name,
            'stnk_no_ktp' => $request->noktp,
            'stnk_tempat_lahir'=> $request->tempatlahir,
            'stnk_tanggal_lahir'=> $request->tgllahir,
            'stnk_alamat'=> $request->alamat,
            'stnk_provinsi'=> $request->provinsi,
            'stnk_kecamatan'=> $request->kecamatan,
            'stnk_kelurahan'=> $request->kelurahan,
            'stnk_no_telepon'=> $request->nohp,
            'stnk_no_handphone'=> $request->nohp,
            'stnk_email' => $user->email,
        ]);

        $pesanan = ListPesanan::create([
            'userid' => $user->id,
            'produkid' => $request->produk_id,
            'delearid' => $request->dealer,
            'status' => 'PENDING',
            'keterangan' => 'NULL'
        ]);

        return view('booking.pembayaran', compact('user', 'dataUser', 'pesanan'));
    }

        public function metped(Request $request)
    {
        $pesanan = ListPesanan::findOrFail($request->pesanan_id);

        $pesanan->metode_pembayaran = $request->metodpem;
        $pesanan->save();

        $produk = ListProduk::findOrFail($pesanan->produkid);
        $Datauser = DataUser::with(['user'])->where('userid', $pesanan->userid)->first();

        $user = User::findOrFail($Datauser->userid);
        
        $passwordPlain = Str::random(10);

         // Set your Merchant Server Key

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = 'ORDER-' . $pesanan->id . '-' . Str::upper(Str::random(5));

        $params = array(
            'transaction_details' => array(
                'order_id' => $orderId,
                'gross_amount' => $produk->price,
            ),
            'customer_details' => array(
                'first_name' => $Datauser->nama_pembeli,
                'email' => $Datauser->user->email,
                'phone' => $Datauser->no_telepon_pembeli,
            ),
            'enabled_payments' => $request->payment_type === 'credit'
                ? ['credit_card']
                : ['bca_va', 'bni_va', 'bri_va']
        );

        $snapToken = Snap::getSnapToken($params);

         // ===== INFONIP WHATSAPP =====
        $client = new Client([
            'base_uri' => config('services.infobip.base_url'),
            'headers' => [
                'Authorization' => 'App ' . config('services.infobip.api_key'),
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ]
        ]);

        $passwordPlain = 'MOTOR';

        $message = <<<TEXT
        ✅ Pembayaran Berhasil dengan Metode {$request->metodpem}.
        
        Order ID: {$orderId}

        Akun Anda sudah aktif.

        Email:
        {$Datauser->user->email}

        Password:
        {$passwordPlain}

        ⚠️ Demi keamanan, HARAP segera login dan ganti password Anda.
        TEXT;

        try {
            $client->post('/whatsapp/1/message/text', [
                'json' => [
                    'from' => config('services.infobip.sender'),
                    'to' => $Datauser->no_telepon_pembeli,
                    'content' => [
                        'text' => $message
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Infobip Error', [
                'order_id' => $orderId,
                'message' => $e->getMessage()
            ]);
        }

        $user->password = Hash::make($passwordPlain);
        $user->save();

         // ===== END INFONIP WHATSAPP =====

        return response()->json([
            'snap_token' => $snapToken
        ]);
    }
}
