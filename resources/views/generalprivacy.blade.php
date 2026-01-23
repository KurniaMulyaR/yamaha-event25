@extends('layouts.appuser')

@section('title', 'Dashboard')

@section('content')
<main class="p-3 mx-auto items-center min-h-screen bg-gradient-to-b from-black to-red-700 text-white">
    <div class="max-w-5xl mx-auto px-4">

        <!-- Header -->
        <div class="mb-8 text-center">
            <p class="text-sm text-white uppercase tracking-wide">
                PT Yamaha Indonesia Motor Manufacturing
            </p>
            <h1 class="text-2xl sm:text-3xl font-bold text-white mt-1">
                Privacy Policy
            </h1>
        </div>

        <!-- Title -->
        <h2 class="text-xl sm:text-2xl font-semibold text-white mb-4">
            Pemberitahuan Pelindungan Data Pribadi
        </h2>

        <!-- Description -->
        <p class="text-white leading-relaxed mb-8 p-6">
            PT Yamaha Indonesia Motor Manufacturing (“Kami”) - sebagai bagian dari grup perusahaan global Yamaha Motor (“Yamaha Motor Grup”) -- berkomitmen untuk menyediakan produk dan layanan berkualitas tinggi yang memberikan kegembiraan dan kegembiraan tak terduga yang memperkaya kehidupan mereka dengan kepuasan baru, selaras dengan masyarakat dan lingkungan. Slogan merek Yamaha Motor adalah “Revs Your Heart.” Untuk menggairahkan hati Anda, kami menghargai siapa pelanggan Kami (“Anda”), dan privasi Anda sangat penting bagi kami. Pemberitahuan pelindungan data pribadi ini menjelaskan bagaimana kami melakukan proses dan melindungi data pribadi Anda yang dikumpulkan untuk pengalaman kami.
        </p>

        <!-- CONTENT BOX -->
        <div class="bg-black/60 p-3 rounded-2xl shadow-md p-6 sm:p-8 space-y-8 mt-4">

            <!-- 1 -->
            <div>
                <h3 class="font-semibold text-lg mb-2">
                    1. Data apa yang Kami kumpulkan
                </h3>
                <ul class="list-disc pl-5 space-y-2 text-white">
                    <li>Nama lengkap, Nomor KTP, usia, tanggal lahir, jenis kelamin, pekerjaan, alamat, negara tempat tinggal, dan informasi kontak seperti nomor telepon, alamat email, dan akun media sosial;</li>
                    <li>Informasi terkait produk dan layanan yang telah atau akan Anda beli (nomor seri, model, jaminan, status penggunaan, lokasi, riwayat layanan, dan tempat pembelian);</li>
                    <li>Pendapat, permintaan, pertanyaan, dan informasi lain yang Anda berikan;</li>
                    <li>Informasi individu yang diperoleh dari produk dan layanan;</li>
                    <li>Informasi dari investigasi dan acara Yamaha Motor Grup;</li>
                    <li>Informasi teknis seperti alamat IP, cookie/history, dan informasi perangkat;</li>
                    <li>Informasi lain sebagaimana dijelaskan dalam pemberitahuan terpisah.</li>
                </ul>
            </div>

            <!-- 2 -->
            <div>
                <h3 class="font-semibold text-lg mb-2">
                    2. Bagaimana Kami menggunakan data pribadi dan informasi Anda
                </h3>

                <p class="font-medium mt-2">(1) Untuk berkomunikasi dengan Anda</p>
                <ul class="list-disc pl-5 space-y-1 text-white">
                    <li>Memverifikasi identitas Anda;</li>
                    <li>Menanggapi pertanyaan atau permintaan Anda;</li>
                    <li>Mengelola kontes, acara, dan promosi;</li>
                    <li>Menyampaikan informasi administratif dan keselamatan;</li>
                    <li>Melakukan penelitian dan survei.</li>
                </ul>

                <p class="font-medium mt-4">(2) Penelitian dan pengembangan</p>
                <ul class="list-disc pl-5 space-y-1 text-white">
                    <li>Mengembangkan dan meningkatkan produk dan layanan;</li>
                    <li>Menentukan spesifikasi sesuai kebutuhan konsumen;</li>
                    <li>Menjamin kualitas dan keamanan produk.</li>
                </ul>

                <p class="font-medium mt-4">(3) Tujuan bisnis</p>
                <ul class="list-disc pl-5 space-y-1 text-white">
                    <li>Analisis data, audit, dan pencegahan penipuan;</li>
                    <li>Riset pasar dan pemasaran langsung maupun tidak langsung;</li>
                    <li>Promosi produk dan layanan Yamaha Motor Grup.</li>
                </ul>

                <p class="font-medium mt-4">(4) Kondisi lain</p>
                <ul class="list-disc pl-5 space-y-1 text-white">
                    <li>Memenuhi kewajiban hukum dan kontraktual;</li>
                    <li>Penyelidikan insiden atau kecelakaan;</li>
                    <li>Perlindungan aset, jaringan, dan hak hukum.</li>
                </ul>
            </div>

            <!-- 3 -->
            <div>
                <h3 class="font-semibold text-lg mb-2">3. Dasar Hukum</h3>
                <p class="text-white">
                    Dasar hukum pemrosesan data pribadi meliputi persetujuan, kewajiban kontraktual, kewajiban hukum, dan kepentingan yang sah. Anda dapat menarik persetujuan kapan saja dengan menghubungi kami.
                </p>
            </div>

            <!-- 4 -->
            <div>
                <h3 class="font-semibold text-lg mb-2">4. Bagaimana kami membagikan data Anda</h3>
                <p class="text-white">
                    Data dapat dibagikan kepada afiliasi, mitra, dan dealer di Indonesia maupun global (termasuk Jepang) dengan perlindungan sesuai hukum yang berlaku.
                </p>
            </div>

            <!-- 5 -->
            <div>
                <h3 class="font-semibold text-lg mb-2">5. Masa penyimpanan data</h3>
                <p class="text-white">
                    Data disimpan hanya selama diperlukan sesuai tujuan pengumpulan dan peraturan perundang-undangan.
                </p>
            </div>

            <!-- 6 -->
            <div>
                <h3 class="font-semibold text-lg mb-2">6. Keamanan data pribadi</h3>
                <p class="text-white">
                    Kami menerapkan langkah keamanan teknis dan organisasi untuk mencegah akses tidak sah, kehilangan, dan penyalahgunaan data pribadi.
                </p>
            </div>

            <!-- 7 -->
            <div>
                <h3 class="font-semibold text-lg mb-2">7. Hak Anda</h3>
                <p class="text-white">
                    Anda berhak mengakses, memperbaiki, memperbarui, menghapus, atau menghentikan pemrosesan data pribadi Anda sesuai hukum.
                </p>
            </div>

            <!-- 8 -->
            <div>
                <h3 class="font-semibold text-lg mb-2">8. Perubahan kebijakan</h3>
                <p class="text-white">
                    Kami dapat memperbarui pemberitahuan ini dan akan menginformasikan perubahan signifikan melalui sarana yang wajar.
                </p>
            </div>

            <!-- 9 -->
            <div>
                <h3 class="font-semibold text-lg mb-2">9. Kontak</h3>
                <p class="text-white">
                    Telepon: <strong>021-24575555</strong><br>
                    Email: <a href="mailto:contact_center@yamaha-motor.co.id" class="text-blue-600 hover:underline">
                        contact_center@yamaha-motor.co.id
                    </a>
                </p>
            </div>

        </div>
    </div>
</section>
@endsection
