<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-blue-600
                        flex items-center justify-center text-white">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 12c0 5.591 3.824 10.29 9 11.622C17.176 22.29 21 17.591 21 12c0-1.018-.127-2.007-.364-2.95"/>

                </svg>

            </div>

            <div>

                <h2 class="text-2xl font-bold text-slate-900">
                    Account Status
                </h2>

                <p class="text-sm text-slate-500">
                    View your current account status and information
                </p>

            </div>

        </div>

    </x-slot>

    <div class="max-w-2xl mx-auto py-12 px-4">

        <div class="bg-amber-50 rounded-2xl shadow-sm border border-slate-200 p-8 text-center">

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

        </div>

    </div>

</x-app-layout>