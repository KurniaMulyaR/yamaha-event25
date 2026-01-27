@extends('layouts.appuser')

@section('title', 'Dashboard')

@push('style')
<style>
    @media (max-width: 390px) {
        .img-rep{
            margin-bottom: 3rem ;
            margin-top: 4rem;
        }
        .count-rep{
            margin-bottom: 0.5rem ;
        }
        .promo-rep{
            margin-top: 1rem ;
            margin-bottom: 1.4rem ;
        }
        .ket-rep{
            margin-top: 2rem ;
        }
        .bg-img-rep{
            min-height: 91vh;
        }
    }
</style>
@endpush

@section('content')
<main class="mx-auto items-center">
    <div class="relative p-6 min-h-[109vh] bg-img-rep bg-cover bg-center bg-black/70"
     style="background-image: url('{{ asset('img/bckground.jpg') }}')">

    <div class="absolute inset-0 bg-black/70 flex items-center justify-center px-4">
    <div class="text-center max-w-4xl">
        <h1 class="text-white font-bold
                   text-2xl
                   sm:text-3xl
                   md:text-4xl
                   lg:text-[48px]">
            Order Online Max Special Livery Sudah Resmi Kami Tutup.
        </h1>

        <h2 class="text-white mt-4
                   text-base
                   sm:text-lg
                   md:text-2xl
                   lg:text-[38px]">
            Kami Ucapkan Terima Kasih Kepada Konsumen Yang Telah Berpartisipasi.
        </h2>
    </div>
</div>


    <div class="mx-auto mt-6 text-center z-20" id="promoleft">
        <!-- Logo -->
      <!-- <div class="text-white mx-auto text-8xl ml-[9rem] font-bold"> -->
        <img 
            src="{{ asset('img/logo-gede.png') }}" 
            alt="Yamaha" 
            class="w-auto mx-auto img-rep"
        >
      <!-- </div> -->
        <!-- <h1 id="countdown" class="text-red-600 font-bold text-6xl mt-4 count-rep">
            00 : 00 : 00
        </h1>

        <div class="mx-auto">
            <h1 class="text-white text-3xl ml-8">JAM <span class="ml-6">MENIT</span><span class="ml-6">DETIK</span></h1>
        </div> -->

    </div>
</div>
</main>
@endsection

@push('scripts')

<script>
//     function startCountdown() {
//     // Target: 25 Januari jam 19:00
//     const targetDate = new Date(
//         new Date().getFullYear(), // tahun sekarang
//         0,                        // Januari = 0
//         27,                       // tanggal
//         19, 0, 0                  // JAM 19:00:00
//     ).getTime();

//     const countdownEl = document.getElementById('countdown');

//     const interval = setInterval(() => {
//         const now = new Date().getTime();
//         const distance = targetDate - now;

//         if (distance <= 0) {
//             clearInterval(interval);
//             countdownEl.innerHTML = "00 : 00 : 00";
//             return;
//         }

//         const hours = Math.floor(distance / (1000 * 60 * 60));
//         const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//         const seconds = Math.floor((distance % (1000 * 60)) / 1000);

//         countdownEl.innerHTML =
//             String(hours).padStart(2, '0') + " : " +
//             String(minutes).padStart(2, '0') + " : " +
//             String(seconds).padStart(2, '0');

//     }, 1000);
// }

// startCountdown();

//  // OPEN MODAL
//     $('#syartbtn').on('click', function () {
//         $('#modalSyarat').removeClass('hidden').addClass('flex');
//         $('#promoleft').removeClass('z-20');
//     });

//     // CLOSE MODAL
//     $('#cncelSyarat').on('click', function () {
//         $('#modalSyarat').addClass('hidden').removeClass('flex');
//         $('#promoleft').addClass('z-20');
//     });
</script>
@endpush