@extends('layouts.appuser')

@section('title', 'Booking')

@section('content')
<section>
    <div class="w-full bg-black py-6">
        <div class="max-w-3xl mx-auto flex items-center justify-between text-white text-sm">
        </div>
    </div>

    <div class="min-h-screen bg-gradient-to-b from-black to-red-700 relative overflow-hidden">

        <!-- background stripes -->
        <div class="absolute inset-0 bg-[size:120px_100%]"></div>

        <div class="min-h-screen bg-gradient-to-b from-black via-[#1a0b0b] to-[#5a0f0f] text-white p-8">
            <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-3 gap-8">
        
                <!-- LEFT : INFORMASI KONSUMEN -->
                <div class="lg:col-span-1 rounded-xl bg-white/5 backdrop-blur border border-white/10 p-6">
                    <h2 class="bg-[#7c1f1a] px-4 py-2 rounded-lg font-bold mb-6">
                        INFORMASI KONSUMEN
                    </h2>
        
                    <!-- Avatar -->
                    <div class="flex flex-col items-center mb-6">
                        <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center text-black text-3xl font-bold">
                            👤
                        </div>
                        <p class="mt-3 font-semibold">Fulan</p>
                    </div>
        
                    <!-- Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 text-sm">
                        <div>
                            <p class="text-gray-400">No KTP</p>
                            <p>123456789123456</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Tempat, Tanggal Lahir</p>
                            <p>Jakarta, 18 Januari 2000</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Alamat</p>
                            <p>Jl. Martadinata</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Provinsi</p>
                            <p>Jawa Barat</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Kota / Kab</p>
                            <p>Kota Bekasi</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Kecamatan</p>
                            <p>Bekasi Barat</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Kelurahan</p>
                            <p>Bintara</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Nomor HP</p>
                            <p>+6282127381234</p>
                        </div>
                        <div>
                            <p class="text-gray-400">E-mail</p>
                            <p>fulan@gmail.com</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Dealer</p>
                            <p>Bekasi Barat</p>
                        </div>
                    </div>
                </div>
        
                <!-- RIGHT : PRODUK -->
                <div class="lg:col-span-2 rounded-xl bg-white/5 backdrop-blur border border-white/10 p-6" style="height: 22rem">
                    <h2 class="bg-[#7c1f1a] px-4 py-2 rounded-lg font-bold mb-6">
                        PRODUK YANG ANDA PILIH
                    </h2>
        
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Motor -->
                        <img src="/img/xmax.png" class="w-full md:w-56 object-contain">
        
                        <!-- Detail -->
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <h3 class="font-bold text-lg">
                                    XMAX TECHMAX SPECIAL LIVERY
                                </h3>
                                <span class="font-bold">Rp. X00.000.000</span>
                            </div>
        
                            <!-- Progress -->
                            <div class="flex items-center gap-4 mt-4 text-sm">
                                <span class="flex items-center gap-2">
                                    <span class="w-3 h-3 bg-red-500 rounded-full"></span> Pembayaran
                                </span>
                                <span class="flex items-center gap-2">
                                    <span class="w-3 h-3 bg-red-500 rounded-full"></span> Pengiriman
                                </span>
                                <span class="flex items-center gap-2">
                                    <span class="w-3 h-3 bg-gray-400 rounded-full"></span> Diterima
                                </span>
                            </div>
        
                            <!-- Keterangan -->
                            <textarea
                                placeholder="Keterangan ..."
                                class="mt-4 w-full rounded-lg bg-white/10 border border-white/20
                                       text-white px-4 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-red-500">
                            </textarea>
                        </div>
                    </div>
                </div>
        
            </div>
        </div>
        
    </div>
</section>
@endsection