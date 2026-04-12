{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-6 rounded-xl shadow">

        <!-- Title -->
        <h2 class="text-2xl font-bold text-center mb-6">
            🔑 Forgot Password
        </h2>

        <!-- Status Message -->
        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif

        <!-- Errors -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Info -->
        <p class="text-sm text-gray-600 mb-4 text-center">
            Enter your email and we’ll send you a password reset link.
        </p>

        <!-- Form -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Button -->
            <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition duration-200">
                Send Reset Link
            </button>

        </form>

        <!-- Back to Login -->
        <p class="text-center text-sm mt-4">
            Remember your password?
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                Login
            </a>
        </p>

    </div>

</body>

</html>
