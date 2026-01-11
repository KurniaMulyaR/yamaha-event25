@extends('layouts.appuser')

@section('title', 'Dashboard')

@section('content')
<main class="p-6 grid grid-flow-col grid-rows-1 gap-2">
            
    <div>
        <x-slider-bike />
    </div>
    <div class="mx-auto mt-6 text-center">
        <h1 class="text-white text-bold text-5xl">
            Maxi Maximal
        </h1>
        <h2 class="text-white text-2xl mt-3">
            Feel The Maximalride
        </h2>
        <h2 class="text-white text-2xl mt-3">
            Booking Segera Dibuka Dalam
        </h2>
        <h1 class="text-red-600 text-bold text-6xl mt-4">
            00 : 00 : 00
        </h1>
        <div class="flex space-x-4">
            <h1 class="text-white text-3xl mt-4">
                JAM
            </h1>
            <h1 class="text-white text-3xl mt-4">
                MENIT
            </h1>
            <h1 class="text-white text-3xl mt-4">
                DETIK
            </h1>
        </div>

        <x-slider-promo />

        <div>
            <a href="#" class="text-2xl mt-4 text-blue-800 hover:text-blue-600">
                Syarat & Ketentuan Berlaku
            </a>
        </div>

        <button class="text-2xl mt-3 bg-blue-900 hover:bg-blue-700 transition text-white font-bold px-10 py-3 rounded-lg text-lg shadow-lg">
            Booking Now
        </button>
    </div>
</main>

<x-section-bike />
@endsection
