<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-900">
            Account Status
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-12 px-4">

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center">

            @if(auth()->user()->account_status === 'suspended')

                <h1 class="text-2xl font-bold text-amber-600 mb-4">
                    Your Account is Suspended!!
                </h1>

                <p class="text-slate-600 mb-4">
                    Your account has temporarily been suspended by an Administrator.
                </p>

                @if(auth()->user()->suspended_until)
                    <p class="text-slate-700 font-semibold">
                        Suspension ends:
                        {{ auth()->user()->suspended_until->format('F j, Y \a\t g:i A') }}
                    </p>
                @endif

                <p class="text-sm text-slate-500 mt-4">
                    You will regain access automatically when your suspension ends.
                </p>

            @elseif(auth()->user()->account_status === 'banned')

                <h1 class="text-2xl font-bold text-red-600 mb-4">
                    Your Account is Permanently Banned!!
                </h1>

                <p class="text-slate-600">
                    Your account has been permanently banned by an Administrator.
                    You cannot access the platform.
                </p>

            @else

                <h1 class="text-2xl font-bold text-green-600 mb-4">
                    Your Account is Active!!
                </h1>

                <p class="text-slate-600">
                    Your account currently has no restrictions.
                </p>

            @endif

            <form method="POST" action="{{ route('logout') }}" class="mt-8">
                @csrf

                <button
                    type="submit"
                    class="bg-slate-800 hover:bg-slate-900
                           text-white px-6 py-2.5
                           rounded-xl font-semibold transition">

                    Log Out

                </button>
            </form>

        </div>

    </div>

</x-app-layout>