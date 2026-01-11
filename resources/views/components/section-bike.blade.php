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

    <div class="h-screen bg-[url('/img/bg-bike.png')] bg-cover bg-center bg-no-repeat" x-data="modelSlider()">
        <!-- OVERLAY -->
        <div class="absolute inset-0 z-10"></div>

        <!-- CONTENT -->
        <div class="relative z-20 h-full flex items-center px-10">

            <!-- LEFT PANEL -->
            <div class="w-1/3">
                <div class="bg-black/50 backdrop-blur-md rounded-xl p-6 text-white border border-white/20">
                    <h3 class="text-xl mb-3">PILIH MODEL</h3>

                    <template x-for="item in models" :key="item.key">
                        <button
                            @click="setModel(item.key)"
                            class="w-[256px] py-2 my-2 rounded transition"
                            :class="active === item.key
                                ? 'bg-red-600'
                                : 'bg-white text-black hover:bg-gray-200'"
                            x-text="item.name"
                        ></button>
                    </template>
                </div>

                <div class="text-xl bg-black/50 backdrop-blur-md rounded-xl p-6 text-white border border-white/20 mt-2">
                    Stock <span class="float-right">30/50</span>
                    <div class="h-1 bg-white/30 mt-1">
                        <div class="h-1 bg-red-600 w-3/5"></div>
                    </div>
                </div>

                <button class="w-[256px] p-2 my-3 mx-4 rounded bg-white text-black hover:bg-gray-200 text-left">
                    Lihat Spesifikasi
                </button>
            </div>

            <!-- BIKE IMAGE -->
            <div class="flex-1 flex justify-center z-30">
                <template x-for="item in models" :key="item.key">
                    <img
                        x-show="active === item.key"
                        x-transition.opacity.duration.500ms
                        :src="item.image"
                        class="max-h-[420px] drop-shadow-2xl"
                        alt=""
                    >
                </template>
            </div>

            <!-- RIGHT PANEL -->
            <div class="w-1/3">
                <h3 class="text-sm">
                    Tentukan Varian & Warna Pilihan Anda  
                </h3>
                <div class="bg-black/50 backdrop-blur-md rounded-xl p-6 text-white border border-white/20">
                    <h3 class="text-sm mb-2">PILIH VARIANT</h3>
    
                    <button class="w-[256px] bg-blue-600 py-2 rounded mb-2">
                        TECHMAX SPECIAL LIVERY
                    </button>
                    <button class="w-[256px] bg-white text-black py-2 rounded">
                        TECHMAX
                    </button>
                </div>

                <div class="text-xs bg-black/50 backdrop-blur-md rounded-xl p-6 text-white border border-white/20 mt-2">
                    <h3 class="text-sm mb-2">PILIH WARNA - ELIXIR DARK SILVER</h3>

                    <div x-data="{ active: 1 }" class="flex gap-3">
    
                        <template x-for="i in 2" :key="i">
                            <button
                                @click="active = i"
                                class="w-10 h-10 rounded-full flex items-center justify-center transition"
                                :class="active === i ? 'border border-white hover:bg-gray-200' : 'border border-white/40 hover:bg-gray-600'"
                            >
                                <div
                                    class="w-8 h-8 rounded-full"
                                    :class="active === i ? 'bg-gray-200' : 'bg-gray-600'"
                                ></div>
                            </button>
                        </template>
                    
                    </div>
                </div>

                <div class="text-xs bg-black/50 backdrop-blur-md rounded-xl p-6 text-white border border-white/20 mt-2">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold">Rp. 100.000.000</span>
                        <button class="bg-blue-600 px-4 py-2 rounded">
                            BUY NOW
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
</section>

<script>
function modelSlider() {
    return {
        active: 'xmax',

        models: [
            {
                key: 'tmax',
                name: 'TMAX',
                image: '/img/tmax.png',
                price: 'Rp 350.000.000'
            },
            {
                key: 'xmax',
                name: 'XMAX',
                image: '/img/xmax.png',
                price: 'Rp 100.000.000'
            },
            {
                key: 'nmax',
                name: 'NMAX',
                image: '/img/nmax.png',
                price: 'Rp 35.000.000'
            },
        ],

        setModel(key) {
            this.active = key
        },

        get currentPrice() {
            return this.models.find(m => m.key === this.active).price
        }
    }
}
</script>