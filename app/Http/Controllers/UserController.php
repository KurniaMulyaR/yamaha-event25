<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    public function getUser(Request $request)
    {
        $query = DataUser::query()
                    ->with(['user','village.districts.cities.province','dealeri']);

        // Search
        if ($search = $request->input('search.value')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $total = $query->count();
        
        $dataUsers = $query
            ->offset($request->start)
            ->limit($request->length)
            ->get()
            ->map(function ($dataUser) {
                return [
                    'id' => $dataUser->user->id,
                    'name' => $dataUser->user->name,
                    'email' => $dataUser->user->email,
                    'no_ktp_pembeli' => $dataUser->no_ktp_pembeli ,
                    'tempat_lahir_pembeli' => $dataUser->tempat_lahir_pembeli,
                    'tanggal_lahir_pembeli' => $dataUser->tanggal_lahir_pembeli,
                    'alamat_pembeli' => $dataUser->alamat_pembeli,
                    'provinsi' => $dataUser->provinsi,
                    'kota' => $dataUser->kota,
                    'kecamatan' => $dataUser->kecamatan,
                    'kelurahan' => $dataUser->kelurahan,
                    'no_telepon_pembeli' => $dataUser->no_telepon_pembeli,
                    'no_handphone_pembeli' => $dataUser->no_handphone_pembeli,
                    'dealer' => $dataUser->dealer,
                    'metode_pembayaran' => $dataUser->metode_pembayaran,
                    'stnk_nama_pemakai' => $dataUser->stnk_nama_pemakai,
                    'stnk_no_ktp' => $dataUser->stnk_no_ktp,
                    'stnk_tempat_lahir' => $dataUser->stnk_tempat_lahir,
                    'stnk_tanggal_lahir' => $dataUser->stnk_tanggal_lahir,
                    'stnk_alamat' => $dataUser->stnk_alamat,
                    'stnk_provinsi' => $dataUser->stnk_provinsi,
                    'stnk_kecamatan' => $dataUser->stnk_kecamatan,
                    'stnk_kelurahan' => $dataUser->name,
                    'stnk_no_telepon' => $dataUser->stnk_no_telepon,
                    'stnk_no_handphone' => $dataUser->stnk_no_handphone,
                    'stnk_email' => $dataUser->user->email,
                    'created_at' => $dataUser->created_at->format('Y-m-d'),
                    'action' => view('admin.user.partials', compact('dataUser'))->render(),
                    'role' => $dataUser->user->role,
                ];
            });;

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $dataUsers,
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
        $DataUser = DataUser::findOrFail($id);
        $user = User::where('id',$DataUser->userid)->first();

        return response()->json($user);
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
        $user = User::findOrFail($id);

        $user->update($request->only('name', 'email','role'));

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
        $DataUser = DataUser::findOrFail($id);
        $user = User::where('id',$DataUser->userid)->first();

        $user->delete();
        $DataUser->delete();

        return response()->json(['success' => true]);
    }

    public function checkEmail(Request $request)
    {
        return response()->json([
            'exists' => User::where('email', $request->email)->exists()
        ]);
    }
}
