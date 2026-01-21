@extends('layouts.appuser')

@section('title', 'Booking')

@section('content')
<section id="booking">
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
                <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center font-bold text-xl">
                    2
                </div>
                <span class="font-medium text-xl">Informasi Konsumen</span>
            </div>
    
            <!-- LINE -->
            <div class="flex-1 h-[2px] bg-white/30 mx-4"></div>
    
            <!-- STEP 3 -->
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 rounded-full bg-white flex text-black items-center justify-center text-xl">
                    3
                </div>
                <span class="opacity-80 text-xl">Pembayaran</span>
            </div>
    
        </div>
    </div>

    <div class="min-h-screen bg-gradient-to-b from-black to-red-700 relative overflow-hidden">

        <!-- background stripes -->
        <div class="absolute inset-0 bg-[size:120px_100%]"></div>
    
        <div class="relative z-10 max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 md:grid-cols-3 gap-6">
    
            <!-- FORM KONSUMEN -->
            <div class="lg:col-span-2 bg-black/60 rounded-xl">
                <h2 class="text-white font-bold text-lg mb-6 bg-[#CB3A31] border-b border-red-900 p-3 rounded-xl">
                    INFORMASI KONSUMEN
                </h2>
    
                <form method="POST" action="{{ route('pembayaran') }}">
                  @csrf

                  <input id="produk_id" name="produk_id" value="{{ $produk->id }}" hidden />

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4">
                      <div class="form-group">
                          <label for="namalengkap" class="block text-sm/6 font-medium text-white">Nama Lengkap</label>
                          <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                              <input id="namalengkap" type="text" name="namalengkap" required placeholder="Nama Lengkap ..." class="w-full rounded-md bg-white/10 border border-white/20
                                          px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" />
                            </div>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="noktp" class="block text-sm/6 font-medium text-white">No KTP</label>
                              <div class="mt-2">
                              <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input id="noktp" type="text"
                                maxlength="16"
                                inputmode="numeric"
                                pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g,'')" name="noktp" placeholder="No KTP ..." class="w-full rounded-md bg-white/10 border border-white/20
                                          px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" />
                              </div>
                            </div>
                      </div>

                      <div class="form-group">
                          <label for="tempatlahir" class="block text-sm/6 font-medium text-white">Tempat Lahir</label>
                          <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                              <input id="tempatlahir" type="text" name="tempatlahir" required placeholder="Tempat Lahir ..." class="w-full rounded-md bg-white/10 border border-white/20
                                          px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" />
                            </div>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="tgllahir" class="block text-sm/6 font-medium text-white">Tanggal Lahir</label>
                          <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                              <input id="tgllahir" type="date" max="{{ now()->subYears(17)->format('Y-m-d') }}" name="tgllahir" required placeholder="Tanggal Lahir ..." class="w-full rounded-md bg-white/10 border border-white/20
                                          px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" />
                            </div>
                          </div>
                      </div>

                      <div class="col-span-full">
                          <label for="alamat" class="block text-sm/6 font-medium text-white">Alamat</label>
                          <div class="mt-2">
                              <textarea id="alamat" name="alamat" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="provinsi" class="block text-sm/6 font-medium text-white">Provinsi</label>
                          <div class="mt-2 grid grid-cols-1">
                            <select id="provinsi" name="provinsi" autocomplete="provinsi-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                              <option>Pilih Provinsi</option>
                            </select>
                            <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                              <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="kota" class="block text-sm/6 font-medium text-white">Kota / Kabupaten</label>
                          <div class="mt-2 grid grid-cols-1">
                            <select id="kota" name="kota" autocomplete="kota-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                              <option>Pilih Kota</option>
                            </select>
                            <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                              <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="kecamatan" class="block text-sm/6 font-medium text-white">Kecamatan</label>
                          <div class="mt-2 grid grid-cols-1">
                            <select id="kecamatan" name="kecamatan" autocomplete="kecamatan-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                              <option>Pilih Kecamatan</option>
                            </select>
                            <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                              <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="kelurahan" class="block text-sm/6 font-medium text-white">Kelurahan</label>
                          <div class="mt-2 grid grid-cols-1">
                            <select id="kelurahan" name="kelurahan" autocomplete="kelurahan-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                              <option>Pilih Kelurahan</option>
                            </select>
                            <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                              <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                          </div>
                        </div>
      
                        <div class="form-group">
                          <label for="nohp" class="block text-sm/6 font-medium text-white">
                            No HP
                          </label>

                          <div class="mt-2">
                            <div class="flex rounded-md overflow-hidden border border-white/20 focus-within:ring-2 focus-within:ring-red-500">
                              
                              <!-- Prefix -->
                              <span class="flex items-center px-3 bg-gray-200 text-gray-700 text-sm">
                                +62
                              </span>

                              <!-- Input -->
                              <input
                                id="nohp"
                                type="tel"
                                name="nohp"
                                placeholder="812xxxxxxx"
                                maxlength="11"
                                inputmode="numeric"
                                class="w-full bg-white px-4 py-2 focus:outline-none"
                                oninput="this.value = this.value.replace(/[^0-9]/g,'')"
                              />
                            </div>
                          </div>
                        </div>


                      <div class="form-group">
                        <label for="email" class="block text-sm/6 font-medium text-white">E-Mail</label>
                        <div class="mt-2">
                          <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input id="email" type="email"
                            name="email"
                            placeholder="email@domain.com"
                            class="w-full rounded-md bg-white/10 border border-white/20
                                    px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                            required />
                          </div>
                        </div>
                    </div>
      
                    <div class="form-group">
                      <label for="dealer" class="block text-sm/6 font-medium text-white">Dealer</label>
                      <div class="mt-2 grid grid-cols-1">
                        <select id="dealer" name="dealer" autocomplete="dealer-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                          <option>Pilih Dealer</option>
                        </select>
                        <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                          <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="metodpem" class="block text-sm/6 font-medium text-white">Metode Pembayaran</label>
                      <div class="mt-2 grid grid-cols-1">
                        <select id="metodpem" name="metodpem" autocomplete="metodpem-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                          <option>CREDIT CARD</option>
                          <option>VIRTUAL ACCOUNT</option>
                        </select>
                        <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                          <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                      </div>
                    </div>
                  </div>
      
                  <div class="mt-6 ml-4">
                      <label class="flex items-center text-sm text-white">
                          <input type="checkbox" class="mr-2">
                          Apakah Data Identitas Pembeli Sama Dengan Identitas Pemilik?
                      </label>
                  </div>
                  
                  <div class="mt-6 ml-4">
                      <label class="flex items-center text-sm text-white">
                          <input type="checkbox" class="mr-2">
                          Mengizinkan PT YIMM untuk menggunakan informasi di atas dan menghubungi Saya melalui email dan/atau telepon atau sarana komunikasi pribadi lainnya untuk kegiatan pelayanan kepada customer.
                      </label>
                  </div>
    
                  <button class="text-center m-4 bg-[#162861] text-white py-3 rounded-lg font-bold hover:opacity-90 transition" style="width: 95%">
                      SUBMIT
                  </button>
                </form>
            </div>
    
            <!-- PRODUK -->
            <div class="bg-black/60 rounded-xl text-center" style="height: 22rem">
                <h3 class="text-white font-bold text-lg mb-6 bg-[#CB3A31] border-b border-red-900 p-3 rounded-xl">
                    PRODUK YANG ANDA PILIH
                </h3>
    
                <img src="storage/{{ $produk->img }}" class="mx-auto h-40 object-contain">
    
                <h4 class="text-white font-bold mt-4 text-2xl">{{ $produk->name }}</h4>
                <p class="text-gray-300 text-xl">{{ $produk->type }}</p>
    
                <p class="text-white font-bold mb-6 bg-[#CB3A31] border-b border-red-900 p-3 rounded-xl text-3xl mt-4">
                    {{ 'Rp.' . number_format($produk->price, 0,',','.') }}
                </p>
            </div>
        </div>
    </div>
    
</section>
@endsection

@push('scripts')

<script>
$(function () {

    // LOAD PROVINSI
    $.get('/ajax/provinsi', function (data) {
        data.forEach(item => {
            $('#provinsi').append(
                `<option value="${item.code}">${item.name}</option>`
            );
        });
    });

    // LOAD KOTA
    $('#provinsi').on('change', function () {
        let code = $(this).val();
        $('#kota').html('<option value="">Loading...</option>');
        $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');

        $.get(`/ajax/kota/${code}`, function (data) {
            $('#kota').html('<option value="">Pilih Kota</option>');
            data.forEach(item => {
                $('#kota').append(
                    `<option value="${item.code}">${item.name}</option>`
                );
            });
        });
    });

    // LOAD KECAMATAN
    $('#kota').on('change', function () {
        let code = $(this).val();
        $('#kecamatan').html('<option value="">Loading...</option>');

        $.get(`/ajax/kecamatan/${code}`, function (data) {
            $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
            data.forEach(item => {
                $('#kecamatan').append(
                    `<option value="${item.code}">${item.name}</option>`
                );
            });
        });
    });

    // LOAD KELURAHAN
    $('#kecamatan').on('change', function () {
        let code = $(this).val();
        $('#kelurahan').html('<option value="">Loading...</option>');

        $.get(`/ajax/kelurahan/${code}`, function (data) {
            $('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
            data.forEach(item => {
                $('#kelurahan').append(
                    `<option value="${item.code}">${item.name}</option>`
                );
            });
        });

        $('#dealer').html('<option value="">Loading...</option>');

        $.get(`/ajax/dealer/${code}`, function (data) {
            $('#dealer').html('<option value="">Pilih Dealer</option>');
            data.forEach(item => {
                $('#dealer').append(
                    `<option value="${item.code}">${item.namedds}</option>`
                );
            });
        });
    });

});
</script>

@endpush