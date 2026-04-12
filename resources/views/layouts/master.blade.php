<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ps' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>ToDo App</title>

    <!-- Tailwind CDN (for now) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/heroicons@2.0.18/dist/24/outline/index.js"></script>
</head>

<body class="{{ app()->getLocale() == 'ps' ? 'text-right' : 'text-left' }} bg-gray-100">


    <!-- 🔝 Navbar -->
    <nav class="top-0 left-0 w-full bg-white shadow-md z-50">
        <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">

            <!-- Left: Logo -->
            <h1 class="font-bold text-lg">ToDo App</h1>

            <!-- Center: Language dropdown -->
            <div class="relative inline-block text-left">

                <!-- Button -->
                <button onclick="toggleLangMenu()"
                    class="bg-gray-200 px-3 py-2 rounded-lg flex items-center gap-2 hover:bg-gray-300 transition">

                    🌐 {{ app()->getLocale() == 'ps' ? 'پښتو' : 'EN' }}
                </button>

                <!-- Dropdown -->
                <div id="langMenu" class="hidden absolute mt-2 w-32 bg-white border rounded-lg shadow-lg">

                    <a href="{{ route('lang.change', ['lang' => 'en']) }}" class="block px-4 py-2 hover:bg-gray-100">
                        EN
                    </a>

                    <a href="{{ route('lang.change', ['lang' => 'ps']) }}" class="block px-4 py-2 hover:bg-gray-100">
                        پښتو
                    </a>

                </div>

            </div>

            <!-- Right: User + Logout -->
            <div class="flex items-center gap-3">
                <span class="text-gray-600">
                    {{ auth()->user()->name ?? '' }}
                </span>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-red-500 text-white px-3 py-1 rounded">
                            {{ __('messages.logout') }}
                        </button>
                    </form>
                @endauth
            </div>

        </div>
    </nav>

    <hr>

    {{-- Flash messages --}}
    @if (session('success'))
        <div id="flashMessage" class="max-w-4xl mx-auto mb-4 transition-opacity duration-500 pt-2">
            <div
                class="bg-green-100 text-green-700 px-4 py-3 rounded shadow flex justify-between items-center transition duration-500">

                <span>{{ session('success') }}</span>

                <button onclick="this.parentElement.remove()" class="font-bold">
                    ✖
                </button>

            </div>
        </div>
    @endif

    <!-- 📦 Page Content -->
    <div class="max-w-4xl mx-auto">
        @yield('content')
    </div>

    <script>
        setTimeout(() => {
            const flash = document.getElementById('flashMessage');
            if (flash) {
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500); // smooth fade
            }
        }, 3000); // 3 seconds
    </script>

    <script>
        function toggleLangMenu() {
            document.getElementById('langMenu').classList.toggle('hidden');
        }

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            const menu = document.getElementById('langMenu');
            if (!e.target.closest('.relative')) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
