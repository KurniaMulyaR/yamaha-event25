<div 
    x-data="{ open: true }"
    class="flex h-screen bg-gray-900 text-black"
>
    <!-- SIDEBAR -->
    <aside
        :class="open ? 'w-64' : 'w-20'"
        class="transition-all duration-300 bg-white flex flex-col"
    >
        <!-- LOGO -->
        <div class="flex items-center justify-between px-4 py-4 border-b border-white/10">
            <span x-show="open" class="text-xl font-bold tracking-wide">
                Yamaha
            </span>

            <button @click="open = !open">
                ☰
            </button>
        </div>

        <!-- MENU -->
        <nav class="flex-1 px-3 py-4 space-y-2">

            <!-- ADMIN MENU -->
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition">
                    📊 <span x-show="open">Admin Dashboard</span>
                </a>

                <a href="{{ route('admin.produk.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition">
                    🛵 <span x-show="open">Products</span>
                </a>

                <a href="{{ route('admin.pengiriman.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition">
                    📦 <span x-show="open">Bookings</span>
                </a>

                <a href="{{ route('admin.user.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition">
                    👥 <span x-show="open">Users</span>
                </a>

                <a href="{{ route('admin.delear.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition">
                    📦 <span x-show="open">Delear</span>
                </a>

        </nav>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}" class="p-4 border-t border-white/10">
            @csrf
            <button class="w-full flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-red-600 transition">
                🚪 <span x-show="open">Logout</span>
            </button>
        </form>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 bg-gray-100 text-black p-6 overflow-y-auto">
        {{ $slot }}
    </main>
</div>
