<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListDelear;
use App\Models\Notifikasi;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ListDealerImport;

class DelearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.delear.index');
    }

    public function getDelear(Request $request)
    {
        $query = ListDelear::query();

        // Search
        // if ($search = $request->input('search.value')) {
        //     $query->where('name', 'like', "%{$search}%")
        //           ->orWhere('email', 'like', "%{$search}%");
        // }

        $total = $query->count();

        $delear = $query
            ->offset($request->start)
            ->limit($request->length)
            ->get()
            ->map(function ($delear) {
                return [
                    'id' => $delear->id,
                    'code' => $delear->code,
                    'district_code' => $delear->district_code,
                    'namedds' => $delear->namedds,
                    'provinsi' => $delear->provinsi,
                    'kota' => $delear->kota,
                    'kecamatan' => $delear->kecamatan,
                    'namedelear' => $delear->namedelear,
                    'cansell' => $delear->cansell,
                    'created_at' => $delear->created_at->format('Y-m-d'),
                    'action' => view('admin.delear.partials', compact('delear'))->render()
                ];
            });;

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $delear,
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
        $request->validate([
            'code' => 'required|string|max:255',
            'district_code' => 'required|string|max:255',
            'namedds' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'namedelear' => 'required|string|max:255',
        ]);

        ListDelear::create([
            'code' => $request->code,
            'district_code' => $request->district_code,
            'namedds' => $request->namedds,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'namedelear' => $request->namedelear,
        ]);

        return response()->json(['success' => true]);
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

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Notifikasi::truncate();
        Excel::import(new ListDealerImport, $request->file('file'));

        return back()->with('success', 'Dealer berhasil diimport');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return ListDelear::findOrFail($id);
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
        $delear = ListDelear::findOrFail($id);

        $delear->update([
            'code' => $request->code,
            'district_code' => $request->district_code,
            'namedds' => $request->namedds,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'namedelear' => $request->namedelear,
        ]);

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
        $delear = ListDelear::findOrFail($id);
        $delear->delete();

        return response()->json(['success' => true]);
    }
}
