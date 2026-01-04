<section
    x-data="{
        current: 0,
        slides: [
            { image: '{{ asset('img/nmax.png') }}', title: 'NMAX' },
            { image: '{{ asset('img/xmax.png') }}', title: 'XMAX' },
            { image: '{{ asset('img/tmax.png') }}', title: 'TMAX' },
        ]
    }"
    x-init="setInterval(() => current = (current + 1) % slides.length, 4000)"
    class="w-full py-20 overflow-hidden bg-black text-white"
>
    <div class="max-w-5xl mx-auto text-center">

        <!-- IMAGE -->
        <div class="relative h-[320px] flex items-center justify-center">
            <template x-for="(slide, index) in slides" :key="index">
                <img
                    x-show="current === index"
                    x-transition.opacity.duration.500ms
                    :src="slide.image"
                    :alt="slide.title"
                    class="absolute h-full object-contain"
                >
            </template>
        </div>

        <!-- BUTTON -->
        <div class="mt-6">
            <button
                class="bg-red-600 hover:bg-red-700 transition text-white font-bold px-10 py-3 rounded-lg text-lg shadow-lg"
                x-text="slides[current].title"
            ></button>
        </div>

        <!-- DOTS -->
        <div class="flex justify-center gap-3 mt-8">
            <template x-for="(_, index) in slides" :key="index">
                <button
                    @click="current = index"
                    class="w-3 h-3 rounded-full"
                    :class="current === index ? 'bg-white' : 'bg-gray-500'"
                ></button>
            </template>
        </div>

    </div>
</section>
