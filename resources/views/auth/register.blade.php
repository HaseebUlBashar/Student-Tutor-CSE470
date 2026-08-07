<x-guest-layout>

<div class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-10">

    <div class="w-full max-w-xl">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/2.png') }}"
                 alt="ST Platform Logo"
                 class="w-36 h-36 object-contain">
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">

            <h1 class="text-5xl font-extrabold text-center">
                <span class="text-gray-900">ST</span>
                <span class="text-blue-500">Platform</span>
            </h1>

            <p class="text-center text-gray-600 mt-4 text-lg">
                Create your Student or Tutor account
            </p>

            <div class="flex justify-center mt-3">
                <span class="bg-blue-50 text-blue-700 px-5 py-2 rounded-full text-sm">
                    Join the Student Tutor Platform
                </span>
            </div>

            <form method="POST"
                  action="{{ route('register') }}"
                  class="mt-8">

                @csrf

                <!-- Name -->

                <div>
                    <label class="font-semibold text-gray-700">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus

                        class="mt-2 w-full rounded-xl border-gray-300
                               focus:border-blue-500
                               focus:ring-blue-500
                               px-5 py-4 text-lg"

                        placeholder="Enter your full name">

                    <x-input-error
                        :messages="$errors->get('name')"
                        class="mt-2" />
                </div>

                <!-- Email -->

                <div class="mt-6">

                    <label class="font-semibold text-gray-700">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required

                        class="mt-2 w-full rounded-xl border-gray-300
                               focus:border-blue-500
                               focus:ring-blue-500
                               px-5 py-4 text-lg"

                        placeholder="you@example.com">

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="mt-2" />

                </div>

                <!-- Role -->

                <div class="mt-6">

                    <label class="font-semibold text-gray-700">
                        Register As
                    </label>

                    <select
                        name="role"
                        required
                        class="mt-2 w-full rounded-xl border-gray-300
                               focus:border-blue-500
                               focus:ring-blue-500
                               px-5 py-4 text-lg">

                        <option value="">Choose your role</option>

                        <option value="student">
                            Student
                        </option>

                        <option value="student_tutor">
                            Student Tutor
                        </option>

                    </select>

                    <x-input-error
                        :messages="$errors->get('role')"
                        class="mt-2"/>

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

                        class="mt-2 w-full rounded-xl border-gray-300
                               focus:border-blue-500
                               focus:ring-blue-500
                               px-5 py-4 text-lg"

                        placeholder="Create a password">

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2"/>

                </div>

                <!-- Confirm Password -->

                <div class="mt-6">

                    <label class="font-semibold text-gray-700">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        required

                        class="mt-2 w-full rounded-xl border-gray-300
                               focus:border-blue-500
                               focus:ring-blue-500
                               px-5 py-4 text-lg"

                        placeholder="Confirm password">

                </div>

                <!-- Button -->

                <button
                    class="w-full mt-8 bg-blue-500 hover:bg-blue-600
                           text-white py-4 rounded-xl
                           text-xl font-bold transition">

                    Create Account

                </button>

            </form>

            <div class="border-t mt-8 pt-6 text-center">

                <span class="text-gray-600">
                    Already have an account?
                </span>

                <a href="{{ route('login') }}"
                   class="text-blue-600 font-semibold hover:underline">

                    Sign In

                </a>

            </div>

        </div>

    </div>

</div>

</x-guest-layout>
