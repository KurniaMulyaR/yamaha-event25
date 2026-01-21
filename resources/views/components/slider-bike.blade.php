@props(['produk'])
<section
    x-data="sliderike()"
    x-init="int()"
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
        <div class="flex justify-center items-center gap-3 mt-8">
            <template x-for="(slide, index) in slides" :key="index">
                <button
                    @click="current = index"
                    type="button"
                    class="w-3 h-3 rounded-full transition-all duration-300 focus:outline-none"
                    :class="current === index 
                        ? 'bg-white scale-125' 
                        : 'bg-gray-500 opacity-60 hover:opacity-100'"
                ></button>
            </template>
        </div>

    </div>
</section>

<script>
function sliderike() {
    return {
        current: 0,
        slides: @json($produk),
        int() {
            console.log(this.slides.length);
            if (this.slides.length > 1) {
                
                setInterval(() => {
                    this.current = (this.current + 1) % this.slides.length
                }, 4000)
            }
        }
    }
}
</script>

