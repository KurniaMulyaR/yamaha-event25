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
        
            <form method="POST" action="{{ route('metpem') }}">
                  @csrf
                  <input id="produk_id" name="produk_id" value="{{ $produk->id }}" hidden />
                  <input id="user_id" name="user_id" value="{{ $user->id }}" hidden />
                  <input id="pesanan_id" name="pesanan_id" value="{{ $pesanan->id }}" hidden />
                <!-- LEFT -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- VIRTUAL ACCOUNT -->
                    <div class="rounded-xl p-6 bg-white/5 backdrop-blur mt-4"
                        :class="payment === 'va' ? 'border-red-500' : 'border-white/10'">
                        <label class="flex items-center gap-3 cursor-pointer text-white font-bold text-lg bg-[#CB3A31] p-3 rounded-xl">
                            <input type="radio" value="va" x-model="payment">
                            VIRTUAL ACCOUNT
                        </label>
                    </div>
        
                    <!-- BUTTON -->
                    <button
                        @click="pay()"
                        class="mt-6 w-full bg-green-600 text-white py-3 rounded-xl font-bold">
                        BOOKING NOW
                    </button>
                </div>
        
                <!-- RIGHT -->
                <div class="rounded-xl bg-white/5 backdrop-blur p-6 border border-white/10">
                    <h3 class="text-white font-bold text-lg mb-6 bg-[#CB3A31] border-b border-red-900 p-3 rounded-xl">
                        PRODUK YANG ANDA PILIH
                    </h3>
        
                    <img src="storage/{{ $produk->img }}" alt="XMAX"
                        class="w-full object-contain mb-4">
        
                    <h2 class="text-center font-bold text-lg">
                        {{ $produk->name }} {{ $produk->type }}
                    </h2>
        
                    <div class="mt-6 flex items-center justify-between bg-red-700/80 px-4 py-3 rounded-lg">
                        <span class="font-semibold">Booking Fee</span>
                        <span class="font-bold">{{ 'Rp.' . number_format($produk->price, 0,',','.') }}</span>
                    </div>
                </div>
            </form>
        
            </div>
        </div>
        
    </div>
</section>
@endsection

@push('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>
    <script>
        function pay() {
            event.preventDefault();
            var metode_pembayaran = document.querySelector('input[x-model="payment"]:checked').value;
            console.log(metode_pembayaran);

            // Kirim data ke server untuk mendapatkan snap token
            fetch('{{ route('metped') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    pesanan_id: {{ $pesanan->id }},
                    metodpem: metode_pembayaran
                })
            })
            .then(response => response.json())
            .then(data => {
                // Panggil Midtrans Snap dengan snap token yang diterima dari server
                snap.pay(data.snap_token, {
                    onSuccess: function(result){
                        console.log('success');
                        window.location.href = '/booking'; // Redirect setelah pembayaran sukses
                    },
                    onPending: function(result){
                        console.log('pending');
                        window.location.href = '/booking'; // Redirect setelah pembayaran pending
                    },
                    onError: function(result){
                        console.log('error');
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
@endpush