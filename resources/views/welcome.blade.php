@extends('layouts.appuser')

@section('title', 'Dashboard')

@section('content')
<main class="p-3 mx-auto items-center">
            
    <div class="mx-auto mt-6 text-center z-20" id="promoleft">
        <!-- Logo -->
      <!-- <div class="text-white mx-auto text-8xl ml-[9rem] font-bold"> -->
        <img 
            src="{{ asset('img/logo-gede.png') }}" 
            alt="Yamaha" 
            class="w-auto mx-auto"
        >
      <!-- </div> -->
        <h1 id="countdown" class="text-red-600 font-bold text-6xl mt-4">
            00 : 00 : 00
        </h1>

        <div class="mx-auto">
            <h1 class="text-white text-3xl ml-8">JAM <span class="ml-6">MENIT</span><span class="ml-6">DETIK</span></h1>
        </div>

        <x-slider-promo />

        <div class="mb-6">
            <div x-data="{ openSyarat: false }">
            
            <button
                id="syartbtn"
                @click="openSyarat = true"
                class="text-2xl mt-4 text-blue-800 hover:text-blue-600"
            >
                Syarat & Ketentuan Berlaku
            </button>

            <!-- LOGIN MODAL -->
                <div
                    x-show="openSyarat"
                    x-transition
                    id="modalSyarat"
                    class="fixed inset-0 z-50 flex w-50 items-center justify-center hidden"
                >
                    <!-- OVERLAY -->
                    <div
                        class="absolute inset-0 bg-black/60"
                        @click="openSyarat = false"
                    ></div>

                    <!-- MODAL BOX -->
                    <div class="relative bg-white text-left text-black rounded-xl w-full max-w-md p-6 z-10 max-h-[35rem] overflow-y-auto">
                        <h2 class="text-lg font-bold mb-4">
                            Syarat & Ketentuan Order Online
                        </h2>

                        <!-- 1. Ketentuan Umum -->
                        <div class="mb-4">
                            <h3 class="font-semibold mb-1 text-left">1. Ketentuan Umum</h3>
                            <ol class="list-decimal ml-5 space-y-1">
                                <li>Order online adalah proses pemesanan sepeda motor secara online yang dilakukan oleh konsumen.</li>
                                <li>Dengan melakukan order online, konsumen dianggap telah membaca, memahami, dan menyetujui seluruh syarat dan ketentuan yang berlaku.</li>
                                <li>Syarat dan ketentuan ini merupakan bagian yang tidak terpisahkan dari perjanjian jual beli sepeda motor.</li>
                            </ol>
                        </div>

                        <!-- {{-- 2. Proses Order --}} -->
                        <div class="mb-4">
                            <h3 class="font-semibold mb-1">2. Proses Order</h3>
                            <ol class="list-decimal ml-5 space-y-1">
                                <li>Konsumen wajib mengisi dan menyerahkan data diri secara benar, lengkap, dan dapat dipertanggungjawabkan.</li>
                                <li>Order online dapat dilakukan melalui website <span class="font-semibold">maxi25.com</span>.</li>
                                <li>Order dinyatakan sah setelah konsumen menerima konfirmasi pemesanan dari pihak Yamaha Indonesia melalui email dan WhatsApp.</li>
                            </ol>
                        </div>

                        <!-- {{-- 3. Pembayaran --}} -->
                        <div class="mb-4">
                            <h3 class="font-semibold mb-1">3. Pembayaran</h3>
                            <ol class="list-decimal ml-5 space-y-1">
                                <li>Konsumen wajib melakukan pembayaran uang muka (DP) sesuai ketentuan yang berlaku.</li>
                                <li>Nominal pembayaran dan batas waktu pembayaran diinformasikan pada saat order dilakukan.</li>
                                <li>Keterlambatan pembayaran dapat mengakibatkan order dibatalkan secara otomatis.</li>
                            </ol>
                        </div>

                        <!-- {{-- 4. Harga dan Spesifikasi --}} -->
                        <div class="mb-4">
                            <h3 class="font-semibold mb-1">4. Harga dan Spesifikasi</h3>
                            <ol class="list-decimal ml-5 space-y-1">
                                <li>Harga yang tercantum merupakan harga rekomendasi On The Road (OTR) Jakarta.</li>
                                <li>Harga dapat berubah mengikuti kebijakan pabrikan, perubahan pajak, atau peraturan pemerintah.</li>
                                <li>Spesifikasi, warna, dan fitur kendaraan mengacu pada standar pabrikan yang dapat dilihat di website resmi Yamaha.</li>
                            </ol>
                        </div>

                        <!-- {{-- 5. Ketersediaan Unit --}} -->
                        <div class="mb-4">
                            <h3 class="font-semibold mb-1">5. Ketersediaan Unit dan Pengiriman</h3>
                            <ol class="list-decimal ml-5 space-y-1">
                                <li>Ketersediaan unit bergantung pada stok dan alokasi dari pabrikan.</li>
                                <li>Estimasi waktu pengiriman bersifat perkiraan dan dapat berubah.</li>
                                <li>Keterlambatan pengiriman tidak dapat dijadikan alasan pembatalan order tanpa persetujuan perusahaan.</li>
                            </ol>
                        </div>

                        <!-- {{-- 6. Pembatalan --}} -->
                        <div class="mb-4">
                            <h3 class="font-semibold mb-1">6. Pembatalan Order</h3>
                            <ol class="list-decimal ml-5 space-y-1">
                                <li>Pembatalan order oleh konsumen harus diajukan secara tertulis.</li>
                                <li>Uang muka (DP) yang telah dibayarkan mengikuti ketentuan pengembalian dana (refund) yang berlaku.</li>
                                <li>Perusahaan berhak membatalkan order apabila konsumen tidak memenuhi kewajiban pembayaran atau administrasi.</li>
                            </ol>
                        </div>

                        <!-- {{-- 7. Penyerahan --}} -->
                        <div class="mb-4">
                            <h3 class="font-semibold mb-1">7. Penyerahan Unit</h3>
                            <ol class="list-decimal ml-5 space-y-1">
                                <li>Penyerahan unit dilakukan setelah pembayaran dinyatakan lunas dan dokumen administrasi lengkap.</li>
                                <li>Unit yang diserahkan merupakan unit baru sesuai standar pabrikan.</li>
                                <li>Risiko atas kendaraan beralih kepada konsumen setelah serah terima unit.</li>
                            </ol>
                        </div>

                        <!-- {{-- 8. Dokumen --}} -->
                        <div class="mb-4">
                            <h3 class="font-semibold mb-1">8. Dokumen Kendaraan</h3>
                            <ol class="list-decimal ml-5 space-y-1">
                                <li>Pengurusan STNK dan BPKB dilakukan sesuai ketentuan yang berlaku.</li>
                                <li>Waktu penerbitan dokumen kendaraan mengikuti kebijakan instansi terkait.</li>
                            </ol>
                        </div>

                        <!-- {{-- 9. Garansi --}} -->
                        <div class="mb-4">
                            <h3 class="font-semibold mb-1">9. Garansi dan Layanan Purna Jual</h3>
                            <ol class="list-decimal ml-5 space-y-1">
                                <li>Sepeda motor mendapatkan garansi resmi dari pabrikan sesuai ketentuan yang berlaku.</li>
                                <li>Layanan servis dan klaim garansi dilakukan melalui jaringan bengkel resmi.</li>
                            </ol>
                        </div>

                        <!-- {{-- 10. Force Majeure --}} -->
                        <div class="mb-4">
                            <h3 class="font-semibold mb-1">10. Force Majeure</h3>
                            <p>
                                Perusahaan tidak bertanggung jawab atas keterlambatan atau kegagalan pelaksanaan order akibat keadaan kahar (force majeure).
                            </p>
                        </div>

                        <!-- {{-- 11. Hukum --}} -->
                        <div>
                            <h3 class="font-semibold mb-1">11. Hukum yang Berlaku</h3>
                            <p>
                                Syarat dan Ketentuan ini tunduk dan ditafsirkan berdasarkan hukum yang berlaku di Republik Indonesia.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
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

 // OPEN MODAL
    $('#syartbtn').on('click', function () {
        $('#modalSyarat').removeClass('hidden').addClass('flex');
        $('#promoleft').removeClass('z-20');
    });

    // CLOSE MODAL
    $('#cncelSyarat').on('click', function () {
        $('#modalSyarat').addClass('hidden').removeClass('flex');
        $('#promoleft').addClass('z-20');
    });
</script>
@endpush