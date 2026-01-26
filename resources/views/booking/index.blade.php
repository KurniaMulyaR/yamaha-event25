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
    
        <div class="relative z-10 max-w-7xl mx-auto px-6 py-16 grid lg:grid-cols-2 lg:grid-cols-3 gap-6">
    
            <!-- FORM KONSUMEN -->
            <div class="lg:col-span-2 rounded-xl">
                <h2 class="text-white font-bold text-lg mb-6 bg-[#CB3A31] border-b border-red-900 p-3 rounded-xl">
                    INFORMASI KONSUMEN
                </h2>
    
                <form method="POST" action="{{ route('pembayaran') }}" id="myForm">
                  @csrf

                  @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                  <input id="produk_id" name="produk_id" value="{{ $produk->id }}" hidden />
                  <input id="varian_id" name="varian_id" value="{{ $varian->id }}" hidden />

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4 bg-black/60 rounded">
                      <div class="form-group">
                          <label for="namalengkap" class="block text-sm/6 font-medium text-white">Nama Lengkap</label>
                          <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                              <input id="namalengkap" type="text" name="namalengkap" required placeholder="Nama Lengkap ..." class="w-full rounded-md bg-white/10 border border-white/20
                                          px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 input-field" />
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
                                required
                                pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g,'')" name="noktp" placeholder="No KTP ..." class="w-full rounded-md bg-white/10 border border-white/20
                                          px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 input-field" />
                              </div>
                            </div>
                            <small id="ktpError" class="text-red-400 hidden">
                                Nomor KTP tidak valid
                            </small>
                      </div>

                      <div class="form-group">
                          <label for="tempatlahir" class="block text-sm/6 font-medium text-white">Tempat Lahir</label>
                          <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                              <input id="tempatlahir" type="text" name="tempatlahir" required placeholder="Tempat Lahir ..." class="w-full rounded-md bg-white/10 border border-white/20
                                          px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 input-field" />
                            </div>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="tgllahir" class="block text-sm/6 font-medium text-white">Tanggal Lahir</label>
                          <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                              <input id="tgllahir" type="text" max="{{ now()->subYears(17)->format('Y-m-d') }}" name="tgllahir" required placeholder="Tanggal Lahir ..." class="w-full rounded-md bg-white/10 border border-white/20
                                          px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 input-field" />
                            </div>
                          </div>
                      </div>

                      <div class="col-span-full">
                          <label for="alamat" class="block text-sm/6 font-medium text-white">Alamat</label>
                          <div class="mt-2">
                              <textarea id="alamat" name="alamat" required rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 input-field"></textarea>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="provinsi" class="block text-sm/6 font-medium text-white">Provinsi</label>
                          <div class="mt-2 grid grid-cols-1">
                            <select id="provinsi" name="provinsi" required autocomplete="provinsi-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 js-example-basic-single">
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
                            <select id="kota" name="kota" autocomplete="kota-name" required class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 js-example-basic-single">
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
                            <select id="kecamatan" name="kecamatan" required autocomplete="kecamatan-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 js-example-basic-single">
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
                            <select id="kelurahan" name="kelurahan" required autocomplete="kelurahan-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 js-example-basic-single">
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
                                required
                                class="w-full bg-white px-4 py-2 focus:outline-none input-field"
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
                                    px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 input-field"
                            required />
                          </div>

                          <p id="email-error" class="text-sm text-red-500 mt-1 hidden">
                                Email sudah terdaftar
                            </p>
                        </div>
                    </div>
      
                    <div class="form-group mb-4">
                      <label for="dealer" class="block text-sm/6 font-medium text-white">Dealer</label>
                      <div class="mt-2 grid grid-cols-1">
                        <select id="dealer" name="dealer" required autocomplete="dealer-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 js-example-basic-single">
                          <option>Pilih Dealer</option>
                          <option value="0">Pilihkan Saya Dealer Rekomendasi</option>
                        </select>
                        <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                          <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                      </div>
                    </div>
                  </div>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4 mt-6 bg-black/60" id="formIdentitas">
  
                    <!-- Nama Pemilik -->
                    <div class="mt-4">
                        <label for="stnk_nama_pemakai" class="block text-sm font-medium text-white">Nama Pemilik</label>
                        <div class="mt-2">
                          <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input id="stnk_nama_pemakai" name="stnk_nama_pemakai" type="text" placeholder="Nama Pemilik ..." required
                            class="w-full rounded-md bg-white/10 border border-white/20
                                        px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 input-field">
                            </div>
                        </div>
                    </div>

                    <!-- No KTP -->
                    <div class="mt-4">
                        <label for="stnk_no_ktp" class="block text-sm font-medium text-white">No KTP</label>
                        <div class="mt-2">
                          <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input id="stnk_no_ktp" maxlength="16"
                                inputmode="numeric"
                                pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g,'')" name="stnk_no_ktp" type="text" placeholder="No KTP ..." required
                        class="w-full rounded-md bg-white/10 border border-white/20 input-field
                                    px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>                    
                        </div>
                        <small id="ktpErrortnk" class="text-red-400 hidden">
                            Nomor KTP tidak valid
                        </small>
                    </div>


                    <!-- Tempat Lahir -->
                    <div>
                        <label for="stnk_tempat_lahir" class="block text-sm font-medium text-white">Tempat Lahir</label>
                        <div class="mt-2">
                          <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input id="stnk_tempat_lahir" name="stnk_tempat_lahir" type="text" placeholder="Tempat Lahir ..." required
                        class="w-full rounded-md bg-white/10 border border-white/20 input-field
                                    px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>                    
                        </div>
                    </div>


                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="stnk_tanggal_lahir" class="block text-sm font-medium text-white">Tanggal Lahir</label>
                        <div class="mt-2">
                          <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600 ">
                        <input id="stnk_tanggal_lahir" name="stnk_tanggal_lahir" type="date" required
                        class="w-full rounded-md bg-white/10 border border-white/20 input-field
                                    px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>                    
                        </div>
                    </div>


                    <!-- Alamat -->
                    <div>
                        <label for="stnk_alamat" class="block text-sm font-medium text-white">Alamat</label>
                        <div class="mt-2">
                          <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input id="stnk_alamat" name="stnk_alamat" type="text" placeholder="Alamat ..." required
                        class="w-full rounded-md bg-white/10 border border-white/20 input-field
                                    px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>                    
                        </div>
                    </div>


                    <!-- Provinsi -->
                    <div>
                        <label for="stnk_provinsi" class="block text-sm font-medium text-white">Provinsi</label>
                        <div class="mt-2">
                          <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input id="stnk_provinsi" name="stnk_provinsi" type="text" placeholder="Provinsi ..." required
                        class="w-full rounded-md bg-white/10 border border-white/20
                                    px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>                    
                        </div>
                    </div>


                    <!-- Kota -->
                    <div>
                        <label for="stnk_kota" class="block text-sm font-medium text-white">Kota</label>
                        <div class="mt-2">
                          <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input id="stnk_kota" name="stnk_kota" type="text" placeholder="Kota ..." required
                        class="w-full rounded-md bg-white/10 border border-white/20
                                    px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>                    
                        </div>
                    </div>


                    <!-- Kecamatan -->
                    <div>
                        <label for="stnk_kecamatan" class="block text-sm font-medium text-white">Kecamatan</label>
                        <div class="mt-2">
                          <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input id="stnk_kecamatan" name="stnk_kecamatan" type="text" placeholder="Kecamatan ..." required
                        class="w-full rounded-md bg-white/10 border border-white/20
                                    px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>                    
                        </div>
                    </div>


                    <!-- Kelurahan -->
                    <div class="mb-4">
                        <label for="stnk_kelurahan" class="block text-sm font-medium text-white">Kelurahan</label>
                        <div class="mt-2">
                          <div class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input id="stnk_kelurahan" name="stnk_kelurahan" type="text" placeholder="Kelurahan ..." required
                        class="w-full rounded-md bg-white/10 border border-white/20
                                    px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>                    
                        </div>
                    </div>
                </div>

      
                  <div class="mt-6 ml-4">
                      <label class="flex items-center text-sm text-white">
                          <input type="checkbox" class="mr-2" require id="identitas">
                          Apakah Data Identitas Pembeli Sama Dengan Identitas Pemilik?
                      </label>
                  </div>
                  
                  <div class="mt-6 ml-4">
                      <label class="flex items-center text-sm text-white">
                          <input type="checkbox" class="mr-2" id="relet" require>
                          Mengizinkan PT YIMM untuk menggunakan informasi di atas dan menghubungi Saya melalui email dan/atau telepon atau sarana komunikasi pribadi lainnya untuk kegiatan pelayanan kepada customer.
                      </label>
                  </div>

                  <button
                    type="button"
                    id="openPrivacyModal"
                    class="text-center m-4 bg-[#162861] text-white py-3 rounded-lg font-bold hover:opacity-90 transition"
                    style="width: 95%">
                    SUBMIT
                </button>
                </form>
            </div>
    
            <!-- PRODUK -->
            <div>
              <div class="bg-black/60 rounded-xl text-center" style="height: 22rem">
                <h3 class="text-white font-bold text-lg mb-6 bg-[#CB3A31] border-b border-red-900 p-3 rounded-xl">
                    PRODUK YANG ANDA PILIH
                </h3>
    
                <img src="storage/{{ $varian->img }}" class="mx-auto h-40 object-contain">
    
                <h4 class="text-white font-bold mt-4 text-2xl">{{ $varian->produk->name }}</h4>
                <p class="text-gray-300 text-xl">{{ $varian->name }}</p>
    
                <div class="text-white font-bold text-left mb-6 bg-[#CB3A31] border-b border-red-900 p-3 rounded-xl text-xl mt-4">
                    <p>
                    Dp : {{ 'Rp.' . number_format($varian->dp, 0,',','.') }}
                    </p>
                    <p>
                    Harga : {{ 'Rp.' . number_format($varian->price, 0,',','.') }}
                    </p>
                </div>
            </div>

            <!-- FAQ SECTION -->
            <div class="max-w-7xl mx-auto px-6 py-20">
                <div class="bg-black/60 rounded-xl overflow-hidden">
                    <h2 class="text-white font-bold text-lg bg-[#CB3A31] p-4">
                        FAQ – ORDER ONLINE
                    </h2>

                    <div class="divide-y divide-white/20">
                        
                        <details class="group p-4 cursor-pointer">
                            <summary class="flex justify-between items-center text-white font-semibold">
                                Apa itu layanan Order Online?
                                <span class="transition group-open:rotate-180">⌄</span>
                            </summary>
                            <p class="mt-2 text-gray-300 text-sm">
                                Layanan pemesanan kendaraan secara digital melalui website resmi tanpa harus datang ke dealer.
                            </p>
                        </details>

                        <details class="group p-4 cursor-pointer">
                            <summary class="flex justify-between items-center text-white font-semibold">
                                Bagaimana cara melakukan pemesanan unit?
                                <span class="transition group-open:rotate-180">⌄</span>
                            </summary>
                            <p class="mt-2 text-gray-300 text-sm">
                                Pilih unit → isi data Anda → pilih dealer & metode pembayaran (Virtual Account) → konfirmasi pesanan.
                            </p>
                        </details>

                        <details class="group p-4 cursor-pointer">
                            <summary class="flex justify-between items-center text-white font-semibold">
                                Berapa lama proses setelah transaksi?
                                <span class="transition group-open:rotate-180">⌄</span>
                            </summary>
                            <p class="mt-2 text-gray-300 text-sm">
                                Tergantung ketersediaan stok dan lokasi. Estimasi waktu akan diinformasikan setelah pesanan dikonfirmasi.
                            </p>
                        </details>

                        <details class="group p-4 cursor-pointer">
                            <summary class="flex justify-between items-center text-white font-semibold">
                                Apakah layanan tersedia di seluruh Indonesia?
                                <span class="transition group-open:rotate-180">⌄</span>
                            </summary>
                            <p class="mt-2 text-gray-300 text-sm">
                                Tersedia di banyak wilayah, namun cakupan dapat berbeda sesuai jaringan dealer di area Anda.
                            </p>
                        </details>

                        <details class="group p-4 cursor-pointer">
                            <summary class="flex justify-between items-center text-white font-semibold">
                                Bisakah memilih dealer tertentu?
                                <span class="transition group-open:rotate-180">⌄</span>
                            </summary>
                            <p class="mt-2 text-gray-300 text-sm">
                                Ya, Anda dapat memilih dealer yang tersedia di daerah Anda saat proses pemesanan.
                            </p>
                        </details>

                        <details class="group p-4 cursor-pointer">
                            <summary class="flex justify-between items-center text-white font-semibold">
                                Bagaimana mengetahui status order?
                                <span class="transition group-open:rotate-180">⌄</span>
                            </summary>
                            <p class="mt-2 text-gray-300 text-sm">
                                Pantau melalui akun Anda di website maxi25.com dengan login menggunakan akun yang dikirimkan melalui email.
                            </p>
                        </details>

                        <details class="group p-4 cursor-pointer">
                            <summary class="flex justify-between items-center text-white font-semibold">
                                Apakah data saya aman?
                                <span class="transition group-open:rotate-180">⌄</span>
                            </summary>
                            <p class="mt-2 text-gray-300 text-sm">
                                Ya, data Anda dilindungi dengan sistem keamanan resmi dan enkripsi standar industri.
                            </p>
                        </details>

                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Privacy Modal -->
<div id="privacyModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60">
    <div class="bg-white max-w-3xl w-full mx-4 rounded-xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-bold text-gray-900">
                KEBIJAKAN PRIVASI
            </h2>
        </div>

        <!-- Content -->
        <div class="px-6 py-4 max-h-[60vh] overflow-y-auto text-sm text-gray-700 space-y-3">
            <p>
                PT Yamaha Indonesia Motor Manufacturing (“Kami”) akan mengumpulkan, melakukan pemrosesan
                dan melindungi Data Pribadi pelanggan (“Anda”) yang diberikan maupun terekam otomatis.
            </p>

            <p>
                Data Pribadi meliputi Nama Lengkap, Nomor Telepon, Nomor KTP, dan Alamat Surel.
            </p>

            <p>
                Data digunakan untuk verifikasi identitas, pengelolaan produk dan layanan, pemasaran,
                penelitian dan pengembangan, kepentingan hukum, serta komunikasi dengan Anda.
            </p>

            <p>
                Data disimpan selama diperlukan dan dapat dibagikan kepada pihak terkait sesuai hukum.
            </p>

            <p>
                Anda dapat menarik persetujuan atau memperbarui data dengan menghubungi:
                <br><strong>021-24575555</strong> /
                <strong>contact_center@yamaha-motor.co.id</strong>
            </p>

            <div class="pt-4 space-y-2 text-xs font-semibold text-gray-800">
                <p>✓ Saya telah membaca dan memahami Kebijakan Privasi ini</p>
                <p>✓ Saya memberikan data pribadi dengan sadar dan tanpa paksaan</p>
                <p>✓ Saya menyetujui penggunaan data sesuai tujuan yang dijelaskan</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 border-t flex justify-end gap-3">
            <button
                id="cancelPrivacy"
                class="px-4 py-2 text-sm rounded-md border hover:bg-gray-100">
                Batal
            </button>

            <button
                id="agreePrivacy"
                class="px-5 py-2 text-sm rounded-md bg-[#162861] text-white hover:opacity-90">
                Setuju & Lanjutkan
            </button>
        </div>

    </div>
</div>

    
</section>
@endsection

@push('scripts')

<script>
$(document).ready(function () {

    $('#noktp').on('input blur', function () {
        let nik = $(this).val();
        let errorEl = $('#ktpError');

        // Reset
        errorEl.addClass('hidden');
        $(this).removeClass('border-red-500');

        // 1️⃣ Panjang harus 16
        if (nik.length !== 16) {
            showError('NIK harus 16 digit');
            return;
        }

    // ✅ Valid
    $(this).addClass('border-green-500');

        function showError(message) {
            errorEl.text(message).removeClass('hidden');
            $('#noktp').addClass('border-red-500');
        }
    });

    $('#stnk_no_ktp').on('input blur', function () {
        let nik = $(this).val();
        let errorEl = $('#ktpErrortnk');

        // Reset
        errorEl.addClass('hidden');
        $(this).removeClass('border-red-500');

        // 1️⃣ Panjang harus 16
        if (nik.length !== 16) {
            showError('NIK harus 16 digit');
            return;
        }

    // ✅ Valid
    $(this).addClass('border-green-500');

        function showError(message) {
            errorEl.text(message).removeClass('hidden');
            $('#stnk_no_ktp').addClass('border-red-500');
        }
    });

    // Buka popup
    $('#openPrivacyModal').on('click', function () {
        let allFilled = true;

        // cek semua input yang wajib diisi
        $('#myForm .input-field').each(function() {
            if($(this).val().trim() === '') {
                allFilled = false;
                $(this).addClass('border-red-500'); // highlight
            } else {
                $(this).removeClass('border-red-500');
            }
        });

        let isChecked = $('#relet').is(':checked');

            if (!isChecked) {
                alert('Anda harus menyetujui Privacy Policy terlebih dahulu!');
                return;
            }
            if(allFilled) {
                // semua field terisi → tampilkan popup
                $('#privacyModal')
                    .removeClass('hidden')
                    .addClass('flex');
            } else {
                alert('Semua field wajib diisi sebelum lanjut!');
            }
        });

        let nik = $('#noktp').val();

        if (nik.length !== 16) {
            e.preventDefault();
            $('#ktpError').text('NIK wajib 16 digit').removeClass('hidden');
            return false;
        }

        let nike = $('#ktpErrortnk').val();

        if (nike.length !== 16) {
            e.preventDefault();
            $('#ktpErrortnk').text('NIK wajib 16 digit').removeClass('hidden');
            return false;
        }
    });

// Tutup popup (Batal)
    $('#cancelPrivacy').on('click', function () {
        $('#privacyModal')
            .addClass('hidden')
            .removeClass('flex');
    });

    // Setuju & Submit
    $('#agreePrivacy').on('click', function () {
        $('#privacyModal')
            .addClass('hidden')
            .removeClass('flex');

        $('form').submit(); // 🔥 submit form
    });

$(document).ready(function() {
    $('#identitas').change(function() {
        if ($(this).is(':checked')) {
            $('#formIdentitas').slideUp(); // tampilkan form
            $('#stnk_nama_pemakai').removeClass('input-field');            
            $('#stnk_no_ktp').removeClass('input-field');
            $('#stnk_tempat_lahir').removeClass('input-field');
            $('#stnk_tanggal_lahir').removeClass('input-field');
            $('#stnk_alamat').removeClass('input-field');

        } else {
            $('#formIdentitas').slideDown();   // sembunyikan form
            $('#stnk_nama_pemakai').addClass('input-field');            
            $('#stnk_no_ktp').addClass('input-field');
            $('#stnk_tempat_lahir').addClass('input-field');
            $('#stnk_tanggal_lahir').addClass('input-field');
            $('#stnk_alamat').addClass('input-field');

        }
    });

    let typingTimer;
    const delay = 500;

    $('#email').on('keyup', function () {
        clearTimeout(typingTimer);

        const email = $(this).val();

        if (email.length === 0) {
            $('#email-error').addClass('hidden');
            return;
        }

        typingTimer = setTimeout(function () {
            $.ajax({
                url: "{{ route('check.email') }}",
                type: "POST",
                data: {
                    email: email,
                    _token: '{{ csrf_token() }}',
                },
                success: function (res) {
                    if (res.exists) {
                        $('#email-error').removeClass('hidden');
                        $('#email').addClass('border-red-500');
                    } else {
                        $('#email-error').addClass('hidden');
                        $('#email').removeClass('border-red-500');
                    }
                }
            });
        }, delay);
    });
});

let today = new Date();
let maxDate = new Date(
    today.getFullYear() - 17,
    today.getMonth(),
    today.getDate()
);

$('#tgllahir').flatpickr({
    dateFormat: "d-m-Y",
    maxDate: maxDate // 🔥 minimal umur 17 tahun
});stnk_tanggal_lahir

$('#stnk_tanggal_lahir').flatpickr({
    dateFormat: "d-m-Y",
    maxDate: maxDate // 🔥 minimal umur 17 tahun
});
$(function () {

    $('.js-example-basic-single').select2();

    let id = {{ $varian->id }};
    
    // LOAD PROVINSI
    $.get(`/ajax/provinsi/${id}`, function (data) {
        data.forEach(item => {
            $('#provinsi').append(
                `<option value="${item.code}">${item.name}</option>`
            );
            $('#stnk_provinsi').append(
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
    
    $('#stnk_provinsi').on('change', function () {
        let code = $(this).val();

        $('#stnk_kota').html('<option value="">Loading...</option>');
        $('#stnk_kecamatan').html('<option value="">Pilih Kecamatan</option>');

        $.get(`/ajax/kota/${code}`, function (data) {
            $('#stnk_kota').html('<option value="">Pilih Kota</option>');
            data.forEach(item => {
                $('#stnk_kota').append(
                    `<option value="${item.code}">${item.name}</option>`
                );
            });
        });
    });

    // LOAD KECAMATAN
    $('#kota').on('change', function () {
        let code = $(this).val();
        let codie = $(this).val() + '|' + id;
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

     $('#stnk_kota').on('change', function () {
        let code = $(this).val();
        $('#stnk_kecamatan').html('<option value="">Loading...</option>');

        $.get(`/ajax/kecamatan/${code}`, function (data) {
            $('#stnk_kecamatan').html('<option value="">Pilih Kecamatan</option>');
            data.forEach(item => {
                $('#stnk_kecamatan').append(
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
    });

    $('#stnk_kecamatan').on('change', function () {
        let code = $(this).val();
        $('#stnk_kelurahan').html('<option value="">Loading...</option>');

        $.get(`/ajax/kelurahan/${code}`, function (data) {
            $('#stnk_kelurahan').html('<option value="">Pilih Kelurahan</option>');
            data.forEach(item => {
                $('#stnk_kelurahan').append(
                    `<option value="${item.code}">${item.name}</option>`
                );
            });
        });
    });

    $('#dealer').html('<option value="">Loading...</option>');

    $.get(`/ajax/dealer`, function (data) {
        $('#dealer').html('<option value="">Pilih Dealer</option>');
        
        $('#dealer').append(
            `<option value="0">Pilihkan Saya Dealer Rekomendasi</option>`
        );
        data.forEach(item => {
            $('#dealer').append(
                `<option value="${item.code}">${item.namedelear}</option>`
            );
        });
        $('#dealer').append(
            `<option value="0">Pilihkan Saya Dealer Rekomendasi</option>`
        );
    });

});
</script>

@endpush