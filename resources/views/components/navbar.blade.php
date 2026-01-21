<header class="bg-[linear-gradient(180deg,#1A1A1A_54%,#21222B_89%)] shadow-[0_4px_4px_rgba(0,0,0,0.25)]">
    <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
      
      <!-- Logo -->
      <div class="text-white text-2xl font-bold">
        <img 
            src="{{ asset('img/logo.png') }}" 
            alt="Yamaha" 
            class="h-8 w-auto"
        >
      </div>
  
      <!-- Menu Desktop -->
      <ul class="md:flex space-x-8 text-white z-20">
        <li>
          <div x-data="{ openLogin: false }">
            
          <button
            id="btnlogin"
            @click="openLogin = true"
            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded font-semibold"
          >
              LOGIN
          </button>

      <!-- LOGIN MODAL -->
      <div
          x-show="openLogin"
          x-transition
          id="modalLogin"
          class="fixed inset-0 z-50 flex items-center justify-center hidden"
      >
          <!-- OVERLAY -->
          <div
              class="absolute inset-0 bg-black/60"
              @click="openLogin = false"
          ></div>

          <!-- MODAL BOX -->
          <div class="relative bg-white text-black rounded-xl w-full max-w-md p-6 z-10">
              <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>

              <form method="POST" action="{{ route('login') }}">
                  @csrf

                  <!-- EMAIL -->
                  <div class="mb-4">
                      <label class="block mb-1 font-medium">Email</label>
                      <input
                          type="email"
                          name="email"
                          required
                          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-red-500"
                      >
                  </div>

                  <!-- PASSWORD -->
                  <div class="mb-4">
                      <label class="block mb-1 font-medium">Password</label>
                      <input
                          type="password"
                          name="password"
                          required
                          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-red-500"
                      >
                  </div>

                  <!-- ACTION -->
                  <div class="flex justify-between items-center">
                      <button
                          type="submit"
                          class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded"
                      >
                          Login
                      </button>

                      <button
                          id="cncellogin"
                          type="button"
                          @click="openLogin = false"
                          class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded hover:underline"
                      >
                          Batal
                      </button>
                  </div>
              </form>
          </div>
      </div>
        </li>
      </ul>
  
      <!-- Button -->
      <a href="#" class="hidden md:block bg-white text-black px-4 py-2 rounded font-semibold hover:bg-gray-200">
        Login
      </a>
  
    </nav>

    

  </div>

  @if ($errors->any())
  <script>
      document.addEventListener('alpine:init', () => {
          Alpine.store('login', { open: true })
      })
  </script>
  @endif

<script>
    // OPEN MODAL
        $('#btnlogin').on('click', function () {
            $('#modalLogin').removeClass('hidden').addClass('flex');
        });

        // CLOSE MODAL
        $('#cncellogin').on('click', function () {
            $('#modalLogin').addClass('hidden').removeClass('flex');
        });
</script>

  </header>
  