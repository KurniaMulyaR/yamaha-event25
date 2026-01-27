@extends('layouts.appuser')

@section('title', 'Pilih Motor')

@section('content')
<section>
    <div class="w-full bg-black py-6">
        <div class="max-w-3xl mx-auto flex items-center justify-between text-white text-sm">
    
            <!-- STEP 1 -->
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center font-bold text-xl">
                    1
                </div>
                <span class="font-medium text-xl">Pilih Model</span>
            </div>
    
            <!-- LINE -->
            <div class="flex-1 h-[2px] bg-white/30 mx-4"></div>
    
            <!-- STEP 2 -->
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 rounded-full bg-white text-black flex items-center justify-center text-xl">
                    2
                </div>
                <span class="opacity-80 text-xl">Informasi Konsumen</span>
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

    <div class="min-h-screen bg-[url('/img/bg-bike.png')] bg-cover bg-center bg-no-repeat" x-data="modelSlider()">

        <div 
        x-data="productViewer()"
        x-init="init()"
            class="relative z-20 min-h-screen px-4 py-6
                    flex flex-col lg:flex-row gap-6 items-center">


            <!-- LEFT PANEL -->
            <div class="w-full lg:w-1/4 order-2 lg:order-1">
                <div class="bg-black/60 backdrop-blur-md rounded-xl p-4 text-white border border-white/20">
                    <h3 class="text-sm mb-3">PILIH MODEL</h3>

                    <template x-for="m in models" :key="m.key">
                        <button
                            @click="setModel(m)"
                            class="w-full py-2 my-1 rounded text-sm transition"
                            :class="activeModel?.key === m.key
                                ? 'bg-red-600 text-white'
                                : 'bg-white text-black hover:bg-gray-200'"
                            x-text="m.title"
                        ></button>
                    </template>
                </div>
            </div>

            <!-- BIKE IMAGE -->
            <div class="w-full lg:flex-1 order-1 lg:order-2 flex justify-center relative min-h-[280px] sm:min-h-[360px]">

                <!-- GAMBAR MODEL -->
                <img
                    x-show="mode === 'model'"
                    x-transition.opacity.duration.500ms
                    :src="activeModel?.image"
                    :alt="activeModel?.title"
                    class="absolute max-h-[260px] sm:max-h-[360px] lg:max-h-[420px] object-contain drop-shadow-2xl"
                >

                <!-- VARIANT IMAGE -->
                <img
                    x-show="mode === 'varian' && activeVarian?.img"
                    x-transition.opacity.duration.500ms
                    :src="activeVarian.img"
                    :alt="activeVarian?.name"
                    class="absolute max-h-[260px] sm:max-h-[360px] lg:max-h-[420px]
                        object-contain drop-shadow-2xl"
                >
            </div>


            <!-- RIGHT PANEL -->
            <div class="w-full lg:w-1/4 order-3">
                <h3 class="text-white text-sm mb-2">
                    Tentukan Varian & Warna Pilihan Anda
                </h3>

                <!-- VARIANT -->
                <div class="bg-black/60 backdrop-blur-md rounded-xl p-4 text-white border border-white/20">
                    <h3 class="text-xs mb-2">PILIH VARIANT</h3>

                    <div class="space-y-2">
                        <template x-for="v in activeModel?.varians ?? []" :key="v.id">
                            <button
                                @click="setVarian(v)"
                                class="w-full py-2 rounded text-sm transition"
                                :class="activeVarian?.id === v.id
                                    ? 'bg-red-600 text-white'
                                    : 'bg-white text-black hover:bg-gray-200'"
                                x-text="v.name"
                            ></button>
                        </template>
                    </div>
                </div>

                <!-- STOCK -->
                <div class="bg-black/60 backdrop-blur-md rounded-xl p-4 text-white border border-white/20 mt-2">
                    <div class="flex justify-between text-xs">
                        <span>Stok</span>
                        <!-- <span x-text="activeVarian ? activeVarian.jmlunit + ' unit' : '-'"></span> -->
                    </div>

                    <div class="h-2 bg-white/20 rounded overflow-hidden mt-1">
                        <span x-show="activeVarian && activeVarian.jmlunit = 87">
                                <div
                            class="h-full bg-red-600 transition-all duration-500"
                            style="width:92%"
                        ></div>
                            </span>

                        <span x-show="activeVarian && activeVarian.jmlunit <= 0">
                            <div
                                class="h-full bg-red-600 transition-all duration-500"
                                style="width:100%"
                            ></div>
                        </span>
                        
                    </div>
                </div>

                <!-- WARNA -->
                <div class="bg-black/60 backdrop-blur-md rounded-xl p-4 text-white border border-white/20 mt-2">
                    <h3 class="text-xs mb-2">
                        PILIH WARNA -
                        <span x-text="activeVarian?.colour ?? '-'"></span>
                    </h3>

                    <button
                        class="w-10 h-10 rounded-full border border-white/40 flex items-center justify-center"
                        :style="`background-color:${activeVarian?.colour === '⁠Crystal Graphite'
                                ? '#8F8F8E'
                                : (activeVarian?.colour ?? '#333')}`"
                    ></button>
                </div>

                <!-- PRICE & CTA -->
                <div class="bg-black/60 backdrop-blur-md rounded-xl p-4 text-white border border-white/20 mt-2">
                    <div class="space-y-4 my-2">
                        <p class="text-lg font-bold">
                            DP : <span class="font-semibold text-white" x-text="activeVarian?.dp"></span>
                        </p>
                        <p class="text-lg font-bold mt-0">
                            Harga : <span class="font-semibold text-white" x-text="activeVarian?.price"></span>
                        </p>
                    </div>

                    <form method="POST" action="{{ route('booking.store') }}">
                        @csrf
                        <input type="hidden" name="produk_id"
                            :value="models.find(m => m.key === active)?.id">

                        <input type="hidden" name="varian_id"
                            :value="activeVarian?.id">

                        <button
                            type="submit"
                            class="w-full py-2 rounded font-semibold transition"
                            :class="(activeVarian && activeVarian.jmlunit > 0)
                                ? 'bg-red-600 hover:bg-red-800 cursor-pointer'
                                : 'bg-gray-500 cursor-not-allowed opacity-60'"
                            :disabled="!activeVarian || activeVarian.jmlunit <= 0"
                        >
                            <span x-show="activeVarian && activeVarian.jmlunit > 0">
                                BUY NOW
                            </span>

                            <span x-show="activeVarian && activeVarian.jmlunit <= 0">
                                STOK HABIS
                            </span>
                    </form>
                </div>
            </div>

        </div>
    </div>
    
</section>
@endsection

@push('scripts')
<script>
function modelSlider() {
    return {
        active: 'produk-1',
        activeVarian: null,
        models: @json($produk),

        init() {
            if (this.models.length > 0) {
                this.active = this.models[0].key
            }
        },

        setModel(key) {
            this.active = key
        },

        get currentModel() {
            return this.models.find(m => m.key === this.active)
        },

        get currentPrice() {
            return this.currentModel ? this.currentModel.price : 0
        },

        get soldUnit() {
            return this.currentModel ? this.currentModel.sold : 0
        },

        get totalUnit() {
            return this.currentModel ? this.currentModel.ttlunit : 0
        },

        get product() {
            return this.models.find(m => m.key === this.active)
        },

        get stockPercent() {
            if (!this.currentModel) return 0
            return Math.min(
                100,
                Math.round((this.soldUnit / this.totalUnit) * 100)
            )
        }
    }
}

function productViewer() {
    return {
        models: @json($produk),

        activeModel: null,
        activeVarian: null,
        mode: 'model', // model | varian

        init() {
            this.activeModel = this.models[0]
            this.activeVarian = this.activeModel.varians[0] ?? null
        },

        setModel(model) {
            this.activeModel = model
            this.activeVarian = model.varians[0] ?? null
            this.mode = 'model'
        },

        setVarian(varian) {
            this.activeVarian = varian
            this.mode = 'varian'
        }
    }
}

</script>
@endpush