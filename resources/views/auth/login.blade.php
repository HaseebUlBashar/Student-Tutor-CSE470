<x-guest-layout>

<div class="min-h-screen bg-red-100 flex items-center justify-center px-4">

    <div class="w-full max-w-lg">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/pngwing.com.png') }}"
                 class="w-36 h-36 object-contain"
                 alt="ST Platform Logo">
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">

            <!-- Heading -->
            <h1 class="text-5xl font-extrabold text-center">
                <span class="text-gray-900">ST</span>
                <span class="text-blue-500">Platform</span>
            </h1>

            <p class="text-center text-gray-600 mt-4 text-lg">
                This is where you STaph to solve your doubts
            </p>

            <div class="flex justify-center mt-3">
                <span
                    class="bg-blue-50 text-blue-700 px-5 py-2 rounded-full text-sm">
                    Sign in to access your Student, Tutor or Admin portal
                </span>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 mt-6"
                                   :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="mt-8">

                @csrf

                <!-- Email -->

                <div>

                    <label class="font-semibold text-gray-700">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"

                        class="mt-2 w-full rounded-xl border-gray-300
                               focus:border-blue-500
                               focus:ring-blue-500
                               px-5 py-4 text-lg"

                        placeholder="admin@example.test">

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="mt-2" />

                </div>

                <!-- Password -->

                <div class="mt-6">

                    <label class="font-semibold text-gray-700">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"

                        class="mt-2 w-full rounded-xl border-gray-300
                               focus:border-blue-500
                               focus:ring-blue-500
                               px-5 py-4 text-lg"

                        placeholder="••••••••">

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2" />

                </div>

                <!-- Remember -->

                <div class="flex justify-between items-center mt-6">

                    <label class="flex items-center">

                        <input
                            type="checkbox"
                            name="remember"
                            class="rounded border-gray-300">

                        <span class="ml-2 text-gray-600">
                            Remember me
                        </span>

                    </label>

                    @if (Route::has('password.request'))

                        <a href="{{ route('password.request') }}"
                           class="text-blue-600 hover:underline">

                            Forgot password?

                        </a>

                    @endif

                </div>

                <!-- Button -->

                <button
                    class="w-full mt-8 bg-blue-500 hover:bg-blue-600
                           text-white py-4 rounded-xl
                           text-xl font-bold
                           transition">

                    Log In

                </button>

            </form>

            <div class="border-t mt-8 pt-6 text-center">

                <span class="text-gray-600">

                    Don't have an account?

                </span>

                <a href="{{ route('register') }}"
                   class="text-blue-600 font-semibold hover:underline">

                    Register as Student or Tutor

                </a>

            </div>

        </div>

    </div>

</div>

</x-guest-layout>
