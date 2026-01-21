@extends('layouts.appuser')

@section('title', 'Dashboard')

@section('content')
<main class="p-6 grid grid-flow-col grid-rows-1 gap-2">
            
    <div>
        <x-slider-bike :produk="$produk"/>
    </div>
    <div class="mx-auto mt-6 text-center z-20">
        <h1 class="text-white text-bold text-5xl">
            Maxi Maximal
        </h1>
        <h2 class="text-white text-2xl mt-3">
            Feel The Maximalride
        </h2>
        <h2 class="text-white text-2xl mt-3">
            Booking Segera Dibuka Dalam
        </h2>
        <h1 id="countdown" class="text-red-600 font-bold text-6xl mt-4">
            00 : 00 : 00
        </h1>

        <div class="flex space-x-8 ml-[5rem]">
            <h1 class="text-white text-3xl mt-4 ml-8">JAM</h1>
            <h1 class="text-white text-3xl mt-4 ml-6">MENIT</h1>
            <h1 class="text-white text-3xl mt-4">DETIK</h1>
        </div>

        <x-slider-promo />

        <div class="mb-6">
            <a href="#" class="text-2xl mt-4 text-blue-800 hover:text-blue-600">
                Syarat & Ketentuan Berlaku
            </a>
        </div>

        <a href="#booking" class="text-2xl mt-3 bg-blue-900 hover:bg-blue-700 transition text-white font-bold px-10 py-3 rounded-lg text-lg shadow-lg">
            Booking Now
        </a>
    </div>
</main>

<x-section-bike :produk="$produk"/>
@endsection

@push('scripts')

<script>
    function startCountdown() {
    // Target: 25 Januari jam 19:00
    const targetDate = new Date(
        new Date().getFullYear(), // tahun sekarang
        0,                        // Januari = 0
        25,                       // tanggal
        19, 0, 0                  // JAM 19:00:00
    ).getTime();

    const countdownEl = document.getElementById('countdown');

    const interval = setInterval(() => {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance <= 0) {
            clearInterval(interval);
            countdownEl.innerHTML = "00 : 00 : 00";
            return;
        }

        const hours = Math.floor(distance / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdownEl.innerHTML =
            String(hours).padStart(2, '0') + " : " +
            String(minutes).padStart(2, '0') + " : " +
            String(seconds).padStart(2, '0');

    }, 1000);
}

startCountdown();
</script>
@endpush