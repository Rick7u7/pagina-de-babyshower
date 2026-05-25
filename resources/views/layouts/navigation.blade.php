<nav class="bg-pink-500 shadow">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('events.index') }}" class="text-white text-2xl font-bold">
                    Baby Shower Planner
                </a>
            </div>

            <!-- Usuario Desktop -->
            <div class="hidden sm:flex items-center gap-4">
                @auth
                    <span class="text-white font-semibold">
                        {{ Auth::user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="bg-white text-pink-500 px-4 py-2 rounded-lg font-semibold hover:bg-pink-100 transition">
                            Cerrar Sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-pink-500 px-4 py-2 rounded-lg font-semibold hover:bg-pink-100 transition">
                        Iniciar Sesión / Registrarse
                    </a>
                @endauth
            </div>

            <!-- Mobile Button -->
            <div class="sm:hidden">
                <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')"
                        class="text-white text-2xl">
                    ☰
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden sm:hidden bg-pink-400 px-6 py-4">
        <div class="flex flex-col gap-4">
            <a href="{{ route('events.index') }}" class="text-white font-semibold">
                Eventos
            </a>

            @auth
                <span class="text-white">{{ Auth::user()->name }}</span>
                <span class="text-pink-100 text-sm">{{ Auth::user()->email }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="bg-white text-pink-500 px-4 py-2 rounded-lg font-semibold">
                        Cerrar Sesión
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-white text-pink-500 px-4 py-2 rounded-lg font-semibold">
                    Iniciar Sesión / Registrarse
                </a>
            @endauth
        </div>
    </div>
</nav>
