<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListPesanan;
use Midtrans\Transaction;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
       $serverKey = config('midtrans.server_key');

        $signature = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        // Validasi signature
        if ($signature !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $transaction = ListPesanan::where('order_id', $request->order_id)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Mapping status Midtrans → status sistem
        switch ($request->transaction_status) {
            case 'settlement':
            case 'capture':
                $transaction->status = 'paid';
                $transaction->paid_at = now();
                break;

            case 'pending':
                $transaction->status = 'pending';
                break;

            case 'expire':
            case 'cancel':
            case 'deny':
                $transaction->status = 'failed';
                break;
        }

        $transaction->payment_type = $request->payment_type;
        $transaction->midtrans_transaction_id = $request->transaction_id;
        $transaction->save();

        return response()->json(['message' => 'OK']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
}
