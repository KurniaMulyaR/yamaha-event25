<div
    x-data="{
        current: 0,
        slides: [
            { title: 'Order Online Mulai', value: '25 Januari', subtitle: 'Mulai Pukul 19.00 WIB' },
            { title: 'Waktu pembelian hanya', value: '25 MENIT', subtitle: 'Mulai Pukul 19.00 WIB' },
        ]
    }"
    class="w-full flex items-center justify-center py-5"
>

    <!-- LEFT -->
    <button
        @click="current = (current - 1 + slides.length) % slides.length"
        class="w-14 h-[9rem] rounded-l-xl flex items-center justify-center text-white text-2xl shadow-lg"
    >
        ‹
    </button>

    <!-- SLIDER WRAPPER -->
    <div class="mx-4 w-[320px] overflow-hidden">
        <div
            class="flex transition-transform duration-500 ease-in-out"
            :style="`transform: translateX(-${current * 100}%);`"
        >
            <template x-for="slide in slides">
                <div
                    class="min-w-full bg-red-600 rounded-xl text-white text-center py-6 shadow-[0_8px_20px_rgba(0,0,0,0.4)]"
                >
                    <p class="text-sm opacity-90" x-text="slide.title"></p>
                    <p class="text-3xl font-extrabold my-2" x-text="slide.value"></p>
                    <p class="text-sm opacity-90" x-text="slide.subtitle"></p>
                </div>
            </template>
        </div>
    </div>

    <!-- RIGHT -->
    <button
        @click="current = (current + 1) % slides.length"
        class="w-14 h-[9rem] rounded-r-xl flex items-center justify-center text-white text-2xl shadow-lg"
    >
        ›
    </button>

</div>
