<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListProduk;
use App\Models\ListPesanan;
use App\Models\DataUser;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


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

        return view('booking.index', compact('produk'));
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
}
