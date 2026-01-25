<footer class="bg-[linear-gradient(180deg,#1A1A1A_54%,#21222B_89%)]
               shadow-[0_4px_4px_rgba(0,0,0,0.25)]">
    
    <nav class="max-w-7xl mx-auto px-4 py-6
                flex flex-col sm:flex-row
                items-center sm:justify-between gap-4">

        <!-- Logo -->
        <img src="{{ asset('img/logo.png') }}" alt="Yamaha" class="h-12">

        <!-- Help Center Button -->
        <div class="p-4 flex flex-col sm:flex-row items-center gap-2 bg-blue-900 hover:bg-blue-700
            text-white px-5 py-3 rounded-2xl shadow-lg">
    
            <div class="font-semibold text-sm tracking-wide">
                HELP CENTER
            </div>

            <div class="flex flex-col sm:flex-row gap-2 text-xs sm:text-sm font-semibold">
                <!-- Phone -->
                <div class="flex items-center gap-2 bg-white/15 px-3 py-1.5 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h2.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-1.257.629a11.042 11.042 0 005.516 5.516l.629-1.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>021 2457 5555</span>
                </div>

                <!-- Email -->
                <div class="flex items-center gap-2 bg-white/15 px-3 py-1.5 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18a2 2 0 002-2V8a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                    </svg>
                    <span>contact_center@yamaha-motor.co.id</span>
                </div>
            </div>
        </div>


        <!-- Right -->
        <div class="flex flex-col sm:items-end items-center gap-2 text-center sm:text-right">
            <a href="https://www.yamaha-motor.co.id/privacy-policy/general.html"
               class="text-gray-400 hover:text-white text-xs sm:text-sm transition">
                General Privacy
            </a>

            <div class="text-white text-xs sm:text-sm leading-relaxed">
                © 2026 PT Yamaha Indonesia Motor Manufacturing<br class="sm:hidden">
                All Rights Reserved
            </div>
        </div>

    </nav>
</footer>

  