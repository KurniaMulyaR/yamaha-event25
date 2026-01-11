@extends('layouts.appuser')

@section('title', 'Booking')

@section('content')
<section>
    <div class="w-full bg-black py-6">
        <div class="max-w-3xl mx-auto flex items-center justify-between text-white text-sm">
    
            <!-- STEP 1 -->
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 rounded-full bg-white text-black flex items-center justify-center text-xl">
                    1
                </div>
                <span class="opacity-80 text-xl">Pilih Model</span>
            </div>
    
            <!-- LINE -->
            <div class="flex-1 h-[2px] bg-white/30 mx-4"></div>
    
            <!-- STEP 2 -->
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 rounded-full bg-white flex text-black items-center justify-center text-xl">
                    2
                </div>
                <span class="opacity-80 text-xl">Informasi Konsumen</span>
            </div>
    
            <!-- LINE -->
            <div class="flex-1 h-[2px] bg-white/30 mx-4"></div>
    
            <!-- STEP 3 -->
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center font-bold text-xl">
                    3
                </div>
                <span class="font-medium text-xl">Pembayaran</span>
            </div>
    
        </div>
    </div>

    <div x-data="{ payment: 'credit' }" 
        class="min-h-screen bg-gradient-to-b from-black via-[#1a0b0b] to-[#5a0f0f] text-white p-8">

        <!-- background stripes -->
        <div class="absolute inset-0 bg-[size:120px_100%]"></div>

            <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-3 gap-6">
        
                <!-- LEFT -->
                <div class="lg:col-span-2 space-y-6">
        
                    <!-- CREDIT CARD -->
                    <div class=" rounded-xl p-6 bg-white/5 backdrop-blur"
                    :class="payment === 'credit' ? 'border-blue-500' : 'border-white/10'">
                        <label class="flex items-center gap-3 mb-4 cursor-pointer text-white font-bold text-lg mb-6 bg-[#CB3A31] border-b border-red-900 p-3 rounded-xl">
                            <input  type="radio"
                                    name="payment"
                                    value="credit"
                                    x-model="payment"
                                    class="accent-blue-500">
                            <span class="text-xl font-bold">CREDIT CARD</span>
                        </label>
        
                        <div 
                            x-show="payment === 'credit'"
                            x-transition.opacity.duration.300ms
                            class="mt-6 space-y-4"
                        >
                            <input type="text" placeholder="Card Number"
                                class="w-full rounded-md bg-white text-black px-4 py-2">
        
                            <input type="text" placeholder="Name On Card"
                                class="w-full rounded-md bg-white text-black px-4 py-2">
        
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" placeholder="Expiration Date (YY / MM)"
                                    class="rounded-md bg-white text-black px-4 py-2">
                                <input type="text" placeholder="Security Code"
                                    class="rounded-md bg-white text-black px-4 py-2">
                            </div>
                        </div>
                    </div>
        
                    <!-- VIRTUAL ACCOUNT -->
                    <div class="rounded-xl p-6 bg-white/5 backdrop-blur border border-white/10"
                    :class="payment === 'va' ? 'border-red-500' : 'border-white/10'">
                        <label class="flex items-center gap-3 cursor-pointer text-white font-bold text-lg mb-6 bg-[#CB3A31] border-b border-red-900 p-3 rounded-xl">
                            <input type="radio"
                            name="payment"
                            value="va"
                            x-model="payment"
                            class="accent-red-500">
                            <span class="text-xl font-bold">VIRTUAL ACCOUNT</span>
                        </label>

                        <div 
                        x-show="payment === 'va'"
        x-transition.opacity.duration.300ms
        class="mt-6 space-y-4"
                        class="space-y-4">
                            <input type="text" placeholder="Card Number"
                                class="w-full rounded-md bg-white text-black px-4 py-2">
        
                            <input type="text" placeholder="Name On Card"
                                class="w-full rounded-md bg-white text-black px-4 py-2">
        
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" placeholder="Expiration Date (YY / MM)"
                                    class="rounded-md bg-white text-black px-4 py-2">
                                <input type="text" placeholder="Security Code"
                                    class="rounded-md bg-white text-black px-4 py-2">
                            </div>
                        </div>
                    </div>
        
                    <!-- BUTTON -->
                    <button
                        class="w-full bg-[#162861] hover:bg-[#2D3C6C] transition
                               py-3 rounded-lg font-bold tracking-wide">
                        BOOKING NOW
                    </button>
                </div>
        
                <!-- RIGHT -->
                <div class="rounded-xl bg-white/5 backdrop-blur p-6 border border-white/10">
                    <h3 class="text-white font-bold text-lg mb-6 bg-[#CB3A31] border-b border-red-900 p-3 rounded-xl">
                        PRODUK YANG ANDA PILIH
                    </h3>
        
                    <img src="/img/xmax.png" alt="XMAX"
                        class="w-full object-contain mb-4">
        
                    <h2 class="text-center font-bold text-lg">
                        XMAX TECHMAX SPECIAL LIVERY
                    </h2>
        
                    <div class="mt-6 flex items-center justify-between bg-red-700/80 px-4 py-3 rounded-lg">
                        <span class="font-semibold">Booking Fee</span>
                        <span class="font-bold">Rp. X0.000.000</span>
                    </div>
                </div>
        
            </div>
        </div>
        
    </div>
</section>
@endsection