<x-app-layout>

    <!-- Dashboard Header -->
    <x-slot name="header">

        <div class="relative overflow-hidden
                    bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-600
                    rounded-3xl
                    shadow-xl
                    px-8 py-8 md:px-10 md:py-10">

            <!-- Decorative circles -->
            <div class="absolute -top-20 -right-20
                        w-64 h-64
                        bg-white/10
                        rounded-full">
            </div>

            <div class="absolute -bottom-24 -left-16
                        w-48 h-48
                        bg-white/5
                        rounded-full">
            </div>

            <div class="relative flex items-center justify-between">

                <div>

                    <p class="text-sm font-semibold
                              text-blue-100
                              uppercase
                              tracking-widest
                              mb-2">

                        Student Tutor Portal

                    </p>

                    <h2 class="text-3xl md:text-4xl
                               font-extrabold
                               text-white">

                        Student Tutor Dashboard

                    </h2>

                    <p class="mt-3
                              text-blue-100
                              max-w-xl">

                        Find academic problems, help students,
                        and share your knowledge.

                    </p>

                </div>


                <!-- Dashboard Icon -->
                <div class="hidden sm:flex
                            w-20 h-20
                            rounded-2xl
                            bg-white/15
                            backdrop-blur-sm
                            border border-white/20
                            items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-10 h-10 text-white"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.5">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>

                    </svg>

                </div>

            </div>

        </div>

    </x-slot>


    <!-- Dashboard Content -->
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        {{-- ========================================================= --}}
{{-- BOOKMARK DEADLINE NOTIFICATIONS --}}
{{-- ========================================================= --}}

@if($deadlineNotifications->count() > 0)

    <div class="fixed top-24 right-6 z-50 w-full max-w-md space-y-4">

        @foreach($deadlineNotifications as $problem)

            <div class="bg-white rounded-2xl shadow-2xl border border-amber-200
                        overflow-hidden">

                <div class="p-5">

                    <div class="flex items-start gap-4">

                        {{-- Warning Icon --}}
                        <div class="flex-shrink-0
                                    w-11 h-11
                                    rounded-full
                                    bg-amber-100
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6 text-amber-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 9v2m0 4h.01M10.29 3.86l-7.5 13A1 1 0 003.66 18h16.68a1 1 0 00.87-1.5l-7.5-13a1 1 0 00-1.74 0z"/>

                            </svg>

                        </div>

                        {{-- Notification Content --}}
                        <div class="flex-1 min-w-0">

                            <h3 class="font-bold text-amber-700">
                                Deadline Approaching
                            </h3>

                            <p class="mt-1 text-sm text-slate-600">
                                A bookmarked problem is approaching its deadline.
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ $problem->title }}
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                Deadline:
                                <span class="font-semibold text-red-600">
                                    {{ \Carbon\Carbon::parse($problem->deadline)->format('d M Y') }}
                                </span>
                            </p>

                            <div class="mt-4 flex items-center gap-2">

                                {{-- View Problem --}}
                                <a href="{{ route('tutor.problems.show', $problem->id) }}"
                                   class="inline-flex items-center
                                          px-3 py-2
                                          rounded-lg
                                          bg-blue-600
                                          hover:bg-blue-700
                                          text-white
                                          text-sm
                                          font-semibold">

                                    View Problem

                                </a>

                                {{-- Mark Read --}}
                                <form method="POST"
                                      action="{{ route('tutor.bookmarks.read', $problem->id) }}">

                                    @csrf

                                    <button type="submit"
                                            class="inline-flex items-center
                                                   px-3 py-2
                                                   rounded-lg
                                                   bg-slate-100
                                                   hover:bg-slate-200
                                                   text-slate-700
                                                   text-sm
                                                   font-semibold">

                                        Mark Read

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

@endif

        <!-- Welcome Section -->
        <div class="mb-8">

            <p class="text-sm font-medium
                      text-slate-500
                      uppercase
                      tracking-wider">

                Welcome back

            </p>

            <h1 class="mt-1 text-3xl font-bold text-slate-900">

                {{ auth()->user()->name }}

                <span class="inline-block">👋</span>

            </h1>

            <p class="mt-2 text-slate-500">

                Here's what's happening in your student tutor portal.

            </p>

        </div>
{{-- ================= BADGE ================= --}}

        @php

            $points = auth()->user()->points ?? 0;

            /*
             * Badge progression:
             *
             * 0 - 999       = Copper
             * 1000 - 1999   = Silver
             * 2000 - 2999   = Gold
             * 3000 - 3999   = Diamond
             * 4000+         = Platinum
             */

            if ($points >= 4000) {

                $badge = 'Platinum';
                $badgeLevel = 5;
                $nextBadgePoints = null;

            } elseif ($points >= 3000) {

                $badge = 'Diamond';
                $badgeLevel = 4;
                $nextBadgePoints = 4000;

            } elseif ($points >= 2000) {

                $badge = 'Gold';
                $badgeLevel = 3;
                $nextBadgePoints = 3000;

            } elseif ($points >= 1000) {

                $badge = 'Silver';
                $badgeLevel = 2;
                $nextBadgePoints = 2000;

            } else {

                $badge = 'Copper';
                $badgeLevel = 1;
                $nextBadgePoints = 1000;

            }

            if ($nextBadgePoints) {
                $pointsToNext = $nextBadgePoints - $points;
                $progress = (($points % 1000) / 1000) * 100;
            } else {
                $pointsToNext = 0;
                $progress = 100;
            }

        @endphp


        <div class="relative overflow-hidden bg-white rounded-3xl shadow-lg border border-slate-100 mb-8">

            {{-- Decorative background --}}
            <div class="absolute -top-20 -right-20 w-64 h-64
                        bg-blue-100 rounded-full opacity-40 blur-3xl">
            </div>

            <div class="absolute -bottom-24 -left-20 w-60 h-60
                        bg-purple-100 rounded-full opacity-30 blur-3xl">
            </div>


            <div class="relative p-6 md:p-8">

                <div class="flex flex-col md:flex-row items-center gap-8">


                    {{-- =========================
                         BADGE LOGO
                    ========================== --}}
                    <div class="flex-shrink-0">

                        @if($badge === 'Copper')

                            {{-- COPPER BADGE --}}
                            <div class="w-36 h-36
                                        rounded-full
                                        bg-gradient-to-br from-orange-300 via-orange-600 to-orange-900
                                        p-2
                                        shadow-xl
                                        shadow-orange-200">

                                <div class="w-full h-full
                                            rounded-full
                                            bg-gradient-to-br from-orange-200 to-orange-700
                                            border-4 border-orange-900
                                            flex items-center justify-center">

                                    <svg viewBox="0 0 100 100"
                                         class="w-24 h-24">

                                        <defs>
                                            <linearGradient id="copperGradient"
                                                            x1="0%"
                                                            y1="0%"
                                                            x2="100%"
                                                            y2="100%">
                                                <stop offset="0%" stop-color="#fed7aa"/>
                                                <stop offset="50%" stop-color="#c2410c"/>
                                                <stop offset="100%" stop-color="#7c2d12"/>
                                            </linearGradient>
                                        </defs>

                                        <path
                                            d="M50 8 L61 20 L78 16 L80 33 L94 43 L83 56 L88 73 L71 76 L62 92 L50 82 L38 92 L29 76 L12 73 L17 56 L6 43 L20 33 L22 16 L39 20 Z"
                                            fill="url(#copperGradient)"
                                            stroke="#7c2d12"
                                            stroke-width="3"/>

                                        <circle
                                            cx="50"
                                            cy="50"
                                            r="24"
                                            fill="#fff7ed"
                                            opacity="0.9"/>

                                        <path
                                            d="M38 50 L46 58 L63 39"
                                            fill="none"
                                            stroke="#9a3412"
                                            stroke-width="6"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"/>

                                    </svg>

                                </div>

                            </div>


                        @elseif($badge === 'Silver')

                            {{-- SILVER BADGE --}}
                            <div class="w-36 h-36
                                        rounded-full
                                        bg-gradient-to-br from-gray-100 via-gray-400 to-gray-700
                                        p-2
                                        shadow-xl
                                        shadow-gray-300">

                                <div class="w-full h-full
                                            rounded-full
                                            bg-gradient-to-br from-gray-200 to-gray-500
                                            border-4 border-gray-700
                                            flex items-center justify-center">

                                    <svg viewBox="0 0 100 100"
                                         class="w-24 h-24">

                                        <defs>
                                            <linearGradient id="silverGradient"
                                                            x1="0%"
                                                            y1="0%"
                                                            x2="100%"
                                                            y2="100%">
                                                <stop offset="0%" stop-color="#ffffff"/>
                                                <stop offset="50%" stop-color="#cbd5e1"/>
                                                <stop offset="100%" stop-color="#64748b"/>
                                            </linearGradient>
                                        </defs>

                                        <path
                                            d="M50 6 L62 18 L79 14 L82 31 L96 42 L85 55 L89 73 L72 77 L62 94 L50 83 L38 94 L28 77 L11 73 L15 55 L4 42 L18 31 L21 14 L38 18 Z"
                                            fill="url(#silverGradient)"
                                            stroke="#475569"
                                            stroke-width="3"/>

                                        <circle
                                            cx="50"
                                            cy="50"
                                            r="25"
                                            fill="#f8fafc"/>

                                        <path
                                            d="M34 50 L44 60 L67 36"
                                            fill="none"
                                            stroke="#475569"
                                            stroke-width="6"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"/>

                                    </svg>

                                </div>

                            </div>


                        @elseif($badge === 'Gold')

                            {{-- GOLD BADGE --}}
                            <div class="w-36 h-36
                                        rounded-full
                                        bg-gradient-to-br from-yellow-200 via-yellow-400 to-yellow-700
                                        p-2
                                        shadow-xl
                                        shadow-yellow-300">

                                <div class="w-full h-full
                                            rounded-full
                                            bg-gradient-to-br from-yellow-200 to-yellow-600
                                            border-4 border-yellow-700
                                            flex items-center justify-center">

                                    <svg viewBox="0 0 100 100"
                                         class="w-24 h-24">

                                        <defs>
                                            <linearGradient id="goldGradient"
                                                            x1="0%"
                                                            y1="0%"
                                                            x2="100%"
                                                            y2="100%">
                                                <stop offset="0%" stop-color="#fef3c7"/>
                                                <stop offset="45%" stop-color="#facc15"/>
                                                <stop offset="100%" stop-color="#a16207"/>
                                            </linearGradient>
                                        </defs>

                                        <path
                                            d="M50 5 L63 19 L82 14 L83 33 L96 45 L82 57 L87 77 L68 78 L57 95 L44 81 L25 87 L24 68 L8 57 L18 42 L12 24 L32 22 Z"
                                            fill="url(#goldGradient)"
                                            stroke="#a16207"
                                            stroke-width="3"/>

                                        <circle
                                            cx="50"
                                            cy="50"
                                            r="25"
                                            fill="#fffbeb"/>

                                        <path
                                            d="M35 50 L45 60 L68 36"
                                            fill="none"
                                            stroke="#ca8a04"
                                            stroke-width="7"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"/>

                                        <circle
                                            cx="72"
                                            cy="25"
                                            r="5"
                                            fill="#ffffff"
                                            opacity="0.8"/>

                                    </svg>

                                </div>

                            </div>


                        @elseif($badge === 'Diamond')

                            {{-- DIAMOND BADGE --}}
                            <div class="w-36 h-36
                                        rounded-full
                                        bg-gradient-to-br from-cyan-200 via-blue-400 to-indigo-700
                                        p-2
                                        shadow-xl
                                        shadow-cyan-300">

                                <div class="w-full h-full
                                            rounded-full
                                            bg-gradient-to-br from-cyan-100 to-blue-600
                                            border-4 border-blue-700
                                            flex items-center justify-center">

                                    <svg viewBox="0 0 100 100"
                                         class="w-24 h-24">

                                        <defs>
                                            <linearGradient id="diamondGradient"
                                                            x1="0%"
                                                            y1="0%"
                                                            x2="100%"
                                                            y2="100%">
                                                <stop offset="0%" stop-color="#ecfeff"/>
                                                <stop offset="45%" stop-color="#67e8f9"/>
                                                <stop offset="100%" stop-color="#2563eb"/>
                                            </linearGradient>
                                        </defs>

                                        <path
                                            d="M50 5 L82 30 L67 78 L50 94 L33 78 L18 30 Z"
                                            fill="url(#diamondGradient)"
                                            stroke="#1d4ed8"
                                            stroke-width="3"/>

                                        <path
                                            d="M18 30 L82 30 L67 50 L33 50 Z"
                                            fill="#ffffff"
                                            opacity="0.45"/>

                                        <path
                                            d="M33 50 L50 94 L67 50"
                                            fill="#ffffff"
                                            opacity="0.2"/>

                                        <path
                                            d="M50 15 L50 85"
                                            stroke="#ffffff"
                                            stroke-width="2"
                                            opacity="0.7"/>

                                        <path
                                            d="M27 30 L50 15 L73 30"
                                            fill="none"
                                            stroke="#ffffff"
                                            stroke-width="2"
                                            opacity="0.8"/>

                                        <path
                                            d="M38 63 L47 72 L65 48"
                                            fill="none"
                                            stroke="#ffffff"
                                            stroke-width="5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"/>

                                    </svg>

                                </div>

                            </div>


                        @else

                            {{-- PLATINUM BADGE --}}
                            <div class="w-36 h-36
                                        rounded-full
                                        bg-gradient-to-br from-slate-200 via-slate-400 to-slate-800
                                        p-2
                                        shadow-xl
                                        shadow-slate-300">

                                <div class="w-full h-full
                                            rounded-full
                                            bg-gradient-to-br from-slate-100 via-slate-400 to-slate-700
                                            border-4 border-slate-800
                                            flex items-center justify-center">

                                    <svg viewBox="0 0 100 100"
                                         class="w-24 h-24">

                                        <defs>
                                            <linearGradient id="platinumGradient"
                                                            x1="0%"
                                                            y1="0%"
                                                            x2="100%"
                                                            y2="100%">
                                                <stop offset="0%" stop-color="#ffffff"/>
                                                <stop offset="35%" stop-color="#e2e8f0"/>
                                                <stop offset="65%" stop-color="#94a3b8"/>
                                                <stop offset="100%" stop-color="#334155"/>
                                            </linearGradient>
                                        </defs>

                                        <path
                                            d="M50 4
                                               L59 16
                                               L75 9
                                               L78 25
                                               L94 27
                                               L87 42
                                               L98 54
                                               L84 62
                                               L89 78
                                               L73 79
                                               L67 95
                                               L52 86
                                               L40 97
                                               L32 82
                                               L15 85
                                               L18 68
                                               L3 60
                                               L14 47
                                               L6 32
                                               L22 27
                                               L25 11
                                               L40 17 Z"
                                            fill="url(#platinumGradient)"
                                            stroke="#334155"
                                            stroke-width="3"/>

                                        <circle
                                            cx="50"
                                            cy="50"
                                            r="27"
                                            fill="#f8fafc"
                                            opacity="0.95"/>

                                        <path
                                            d="M31 51 L43 63 L70 34"
                                            fill="none"
                                            stroke="#334155"
                                            stroke-width="7"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"/>

                                        {{-- Sparkles --}}
                                        <path
                                            d="M76 17 L78 23 L84 25 L78 27 L76 33 L74 27 L68 25 L74 23 Z"
                                            fill="#ffffff"/>

                                        <path
                                            d="M22 63 L24 68 L29 70 L24 72 L22 77 L20 72 L15 70 L20 68 Z"
                                            fill="#ffffff"/>

                                    </svg>

                                </div>

                            </div>

                        @endif

                    </div>



                    {{-- =========================
                         BADGE INFORMATION
                    ========================== --}}
                    <div class="flex-1 text-center md:text-left">

                        <div class="flex flex-col md:flex-row
                                    md:items-center gap-3">

                            <h2 class="text-3xl font-extrabold text-slate-900">
                                {{ $badge }} Tutor
                            </h2>

                            <span class="inline-flex items-center
                                         justify-center
                                         px-3 py-1
                                         rounded-full
                                         text-sm font-bold
                                         bg-blue-100
                                         text-blue-700">

                                Level {{ $badgeLevel }}

                            </span>

                        </div>


                        <p class="mt-2 text-slate-500">
                            Keep solving academic problems to unlock higher badges.
                        </p>


                        {{-- Points --}}
                        <div class="mt-5 flex items-center justify-center md:justify-start gap-3">

                            <div class="text-4xl font-extrabold text-slate-900">
                                {{ number_format($points) }}
                            </div>

                            <div class="text-sm text-slate-500">
                                points
                            </div>

                        </div>


                        {{-- Progress --}}
                        @if($nextBadgePoints)

                            <div class="mt-5">

                                <div class="flex justify-between text-sm mb-2">

                                    <span class="font-medium text-slate-600">
                                        Progress to next badge
                                    </span>

                                    <span class="font-semibold text-slate-800">
                                        {{ number_format($points) }}
                                        /
                                        {{ number_format($nextBadgePoints) }}
                                    </span>

                                </div>


                                <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">

                                    <div
                                        class="h-3 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 transition-all duration-500"
                                        style="width: {{ $progress }}%">
                                    </div>

                                </div>


                                <p class="mt-2 text-xs text-slate-500">

                                    {{ number_format($pointsToNext) }}
                                    more points needed to reach the next badge.

                                </p>

                            </div>

                        @else

                            <div class="mt-5">

                                <div class="bg-gradient-to-r from-purple-50 to-blue-50
                                            border border-purple-100
                                            rounded-xl p-4">

                                    <p class="font-bold text-purple-700">
                                        ✨ Maximum Badge Unlocked!
                                    </p>

                                    <p class="text-sm text-slate-500 mt-1">
                                        You have reached the highest tutor rank.
                                    </p>

                                </div>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- =========================
                     BADGE LEVELS
                ========================== --}}
                <div class="mt-8 pt-6 border-t border-slate-100">

                    <p class="text-sm font-semibold text-slate-500 mb-4">
                        Tutor Badge Progression
                    </p>

                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">


                        {{-- Copper --}}
                        <div class="rounded-xl p-3 text-center
                                    {{ $badgeLevel >= 1
                                        ? 'bg-orange-50 border border-orange-200'
                                        : 'bg-slate-50 border border-slate-100' }}">

                            <div class="text-sm font-bold
                                        {{ $badgeLevel >= 1
                                            ? 'text-orange-700'
                                            : 'text-slate-400' }}">

                                Copper

                            </div>

                            <div class="text-xs text-slate-500 mt-1">
                                0+
                            </div>

                        </div>


                        {{-- Silver --}}
                        <div class="rounded-xl p-3 text-center
                                    {{ $badgeLevel >= 2
                                        ? 'bg-gray-100 border border-gray-300'
                                        : 'bg-slate-50 border border-slate-100' }}">

                            <div class="text-sm font-bold
                                        {{ $badgeLevel >= 2
                                            ? 'text-gray-700'
                                            : 'text-slate-400' }}">

                                Silver

                            </div>

                            <div class="text-xs text-slate-500 mt-1">
                                1,000+
                            </div>

                        </div>


                        {{-- Gold --}}
                        <div class="rounded-xl p-3 text-center
                                    {{ $badgeLevel >= 3
                                        ? 'bg-yellow-50 border border-yellow-200'
                                        : 'bg-slate-50 border border-slate-100' }}">

                            <div class="text-sm font-bold
                                        {{ $badgeLevel >= 3
                                            ? 'text-yellow-700'
                                            : 'text-slate-400' }}">

                                Gold

                            </div>

                            <div class="text-xs text-slate-500 mt-1">
                                2,000+
                            </div>

                        </div>


                        {{-- Diamond --}}
                        <div class="rounded-xl p-3 text-center
                                    {{ $badgeLevel >= 4
                                        ? 'bg-cyan-50 border border-cyan-200'
                                        : 'bg-slate-50 border border-slate-100' }}">

                            <div class="text-sm font-bold
                                        {{ $badgeLevel >= 4
                                            ? 'text-cyan-700'
                                            : 'text-slate-400' }}">

                                Diamond

                            </div>

                            <div class="text-xs text-slate-500 mt-1">
                                3,000+
                            </div>

                        </div>


                        {{-- Platinum --}}
                        <div class="rounded-xl p-3 text-center
                                    {{ $badgeLevel >= 5
                                        ? 'bg-slate-100 border border-slate-300'
                                        : 'bg-slate-50 border border-slate-100' }}">

                            <div class="text-sm font-bold
                                        {{ $badgeLevel >= 5
                                            ? 'text-slate-800'
                                            : 'text-slate-400' }}">

                                Platinum

                            </div>

                            <div class="text-xs text-slate-500 mt-1">
                                4,000+
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Browse Problems Card -->
        <div class="group relative
                    bg-white
                    rounded-3xl
                    border border-slate-200
                    shadow-sm
                    hover:shadow-xl
                    transition-all duration-300
                    overflow-hidden
                    mb-7">

            <!-- Blue accent -->
            <div class="absolute left-0 top-0 bottom-0
                        w-1.5
                        bg-blue-600">
            </div>


            <div class="p-8">

                <div class="flex items-start justify-between gap-6">

                    <div>

                        <!-- Icon -->
                        <div class="w-14 h-14
                                    rounded-2xl
                                    bg-blue-50
                                    flex items-center justify-center
                                    mb-5">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-7 h-7 text-blue-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="1.8">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>

                            </svg>

                        </div>


                        <h2 class="text-2xl font-bold text-slate-900">

                            Browse Academic Problems

                        </h2>


                        <p class="mt-3 text-slate-500 max-w-2xl leading-relaxed">

                            Find academic problems posted by students.
                            Search, filter, sort, bookmark problems,
                            and help students with their questions.

                        </p>


                        <!-- Button -->
                        <div class="mt-6">

                            <a href="{{ route('tutor.problems') }}"
                               class="inline-flex items-center gap-2
                                      bg-blue-600
                                      hover:bg-blue-700
                                      text-white
                                      px-6 py-3
                                      rounded-xl
                                      font-semibold
                                      shadow-md
                                      shadow-blue-200
                                      hover:shadow-lg
                                      transition-all duration-200">

                                Browse Problems

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M13 7l5 5m0 0l-5 5m5-5H6"/>

                                </svg>

                            </a>

                        </div>

                    </div>


                    <!-- Right Side Icon -->
                    <div class="hidden md:flex
                                w-32 h-32
                                rounded-3xl
                                bg-blue-50
                                items-center justify-center
                                shrink-0">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-16 h-16 text-blue-500"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="1.3">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>

                        </svg>

                    </div>

                </div>

            </div>

        </div>
        <br>
{{-- ================================================================ --}}
{{-- ACTIVE CONVERSATIONS + NOTIFICATIONS --}}
{{-- ================================================================ --}}

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">


    {{-- ============================================================ --}}
    {{-- ACTIVE CONVERSATIONS --}}
    {{-- ============================================================ --}}

    <div class="mb-0">

        {{-- ========================================================= --}}
        {{-- SECTION HEADER --}}
        {{-- ========================================================= --}}

        <div class="relative overflow-hidden
                    rounded-3xl
                    bg-gradient-to-r from-blue-600 via-blue-600 to-indigo-700
                    shadow-sm
                    mb-6">

            {{-- Decorative shapes --}}
            <div class="absolute -top-10 -right-10
                        w-32 h-32
                        rounded-full
                        bg-white/10">
            </div>

            <div class="absolute -bottom-12 right-24
                        w-24 h-24
                        rounded-full
                        bg-white/5">
            </div>

            <div class="absolute top-5 right-1/3
                        w-3 h-3
                        rounded-full
                        bg-white/20">
            </div>


            <div class="relative px-6 py-6">

                <div class="flex items-center
                            justify-between
                            gap-5">


                    {{-- Left --}}
                    <div class="flex items-center gap-4">

                        {{-- Chat icon --}}
                        <div class="relative
                                    flex-shrink-0
                                    w-14 h-14
                                    rounded-2xl
                                    bg-white
                                    flex items-center justify-center
                                    shadow-md">

                            <div class="relative
                                        w-8 h-6
                                        rounded-lg
                                        bg-blue-600">

                                {{-- Chat bubble tail --}}
                                <div class="absolute
                                            bottom-0 left-2
                                            w-2.5 h-2.5
                                            bg-blue-600
                                            rotate-45
                                            translate-y-1">
                                </div>

                                {{-- Dots --}}
                                <div class="absolute inset-0
                                            flex items-center
                                            justify-center gap-1">

                                    <span class="w-1.5 h-1.5
                                                 rounded-full
                                                 bg-white">
                                    </span>

                                    <span class="w-1.5 h-1.5
                                                 rounded-full
                                                 bg-white">
                                    </span>

                                    <span class="w-1.5 h-1.5
                                                 rounded-full
                                                 bg-white">
                                    </span>

                                </div>

                            </div>


                            {{-- Floating message icon --}}
                            <span class="absolute
                                         -top-2 -right-2
                                         w-7 h-7
                                         rounded-full
                                         bg-indigo-500
                                         border-2 border-white
                                         flex items-center justify-center
                                         text-xs">

                                💬

                            </span>

                        </div>


                        {{-- Heading --}}
                        <div class="min-w-0">

                            <div class="flex items-center gap-2">

                                <h2 class="text-xl sm:text-2xl
                                           font-bold
                                           text-white">

                                    Active Conversations

                                </h2>


                                @if($conversations->count())

                                    <span class="px-2.5 py-1
                                                 rounded-full
                                                 bg-white/15
                                                 border border-white/20
                                                 text-white
                                                 text-xs
                                                 font-bold">

                                        {{ $conversations->count() }}

                                    </span>

                                @endif

                            </div>


                            <p class="text-sm
                                      text-blue-100
                                      mt-1">

                                Continue your discussions with students.

                            </p>

                        </div>

                    </div>


                    {{-- Right illustration --}}
                    <div class="hidden md:flex
                                items-center
                                justify-center
                                relative
                                w-20 h-16
                                flex-shrink-0">

                        {{-- Decorative chat bubbles --}}
                        <div class="absolute
                                    top-1 right-3
                                    w-11 h-8
                                    rounded-xl
                                    bg-white/20
                                    rotate-6">
                        </div>

                        <div class="absolute
                                    bottom-1 left-2
                                    w-12 h-9
                                    rounded-xl
                                    bg-white/15
                                    -rotate-6">
                        </div>

                        <div class="relative
                                    w-12 h-12
                                    rounded-full
                                    bg-white
                                    flex items-center justify-center
                                    text-xl
                                    shadow-lg">

                            💬

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- CONVERSATIONS --}}
        {{-- ========================================================= --}}

        @forelse($conversations as $conversation)

            @php
                $lastMessage = $conversation->messages->first();

                $studentName = $conversation->student->name;

                $studentInitial = strtoupper(
                    substr($studentName, 0, 1)
                );
            @endphp


            <div class="group
                        bg-white
                        rounded-2xl
                        border border-slate-200
                        shadow-sm
                        hover:shadow-md
                        hover:border-blue-200
                        transition-all duration-200
                        p-5
                        mb-4">


                <div class="flex items-center
                            justify-between
                            gap-4">


                    {{-- ================================================= --}}
                    {{-- STUDENT INFORMATION --}}
                    {{-- ================================================= --}}

                    <div class="flex items-center
                                gap-4
                                min-w-0">


                        {{-- Student avatar --}}
                        <div class="relative flex-shrink-0">

                            <div class="w-12 h-12
                                        rounded-2xl
                                        bg-gradient-to-br
                                        from-blue-500
                                        to-indigo-600
                                        text-white
                                        flex items-center justify-center
                                        text-lg
                                        font-bold
                                        shadow-sm">

                                {{ $studentInitial }}

                            </div>


                            {{-- Active indicator --}}
                            <span class="absolute
                                         -bottom-1
                                         -right-1
                                         w-4 h-4
                                         rounded-full
                                         bg-emerald-500
                                         border-2
                                         border-white">
                            </span>

                        </div>


                        {{-- Conversation details --}}
                        <div class="min-w-0">

                            {{-- Student --}}
                            <div class="flex items-center
                                        flex-wrap
                                        gap-2">

                                <h3 class="text-base
                                           font-bold
                                           text-slate-900
                                           truncate">

                                    {{ $studentName }}

                                </h3>


                                <span class="inline-flex
                                             items-center
                                             gap-1
                                             px-2 py-0.5
                                             rounded-full
                                             bg-emerald-50
                                             text-emerald-700
                                             text-xs
                                             font-semibold">

                                    <span class="w-1.5 h-1.5
                                                 rounded-full
                                                 bg-emerald-500">
                                    </span>

                                    Active

                                </span>

                            </div>


                            {{-- Problem --}}
                            <p class="text-sm
                                      font-semibold
                                      text-slate-700
                                      mt-1
                                      truncate">

                                {{ $conversation->problem->title }}

                            </p>


                            {{-- Last message --}}
                            @if($lastMessage)

                                <div class="flex items-center
                                            gap-1
                                            mt-1
                                            min-w-0">

                                    <span class="text-xs
                                                 font-medium
                                                 text-slate-400
                                                 flex-shrink-0">

                                        {{ $lastMessage->sender_id === auth()->id()
                                            ? 'You:'
                                            : $studentName . ':' }}

                                    </span>


                                    <p class="text-xs
                                              text-slate-500
                                              truncate">

                                        {{ $lastMessage->message }}

                                    </p>

                                </div>


                                <p class="text-[11px]
                                          text-slate-400
                                          mt-0.5">

                                    {{ $lastMessage->created_at->format('d M Y, h:i A') }}

                                </p>

                            @else

                                <p class="text-xs
                                          text-slate-400
                                          mt-1">

                                    No messages yet.

                                </p>

                            @endif

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- OPEN CHAT BUTTON --}}
                    {{-- ================================================= --}}

                    <div class="flex-shrink-0 flex items-center gap-2">

    {{-- Open Chat --}}
    <a
        href="{{ route('chat.show', $conversation->id) }}"
        class="inline-flex
               items-center
               justify-center
               gap-1.5
               px-3
               py-2.5
               rounded-xl
               bg-blue-600
               hover:bg-blue-700
               text-white
               text-sm
               font-semibold
               shadow-sm
               transition"
    >

        <span>
            💬
        </span>

        Open Chat

    </a>


    {{-- Delete Conversation --}}
    <form
        method="POST"
        action="{{ route('chat.destroy', $conversation->id) }}"
        onsubmit="return confirm('Are you sure you want to delete this conversation? All messages will be deleted.');"
    >

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="inline-flex
                   items-center
                   justify-center
                   gap-1.5
                   px-3
                   py-2.5
                   rounded-xl
                   bg-red-50
                   hover:bg-red-100
                   text-red-600
                   text-sm
                   font-semibold
                   transition"
        >

            <span>
                🗑️
            </span>

            Delete

        </button>

    </form>

</div>

                </div>

            </div>


        @empty

            {{-- ========================================================= --}}
            {{-- EMPTY STATE --}}
            {{-- ========================================================= --}}

            <div class="bg-white
                        rounded-3xl
                        border border-slate-200
                        shadow-sm
                        p-10
                        text-center">


                <div class="relative
                            w-20 h-20
                            mx-auto">

                    <div class="absolute
                                inset-0
                                rounded-3xl
                                bg-blue-50">
                    </div>


                    <div class="absolute
                                inset-0
                                flex items-center
                                justify-center
                                text-3xl">

                        💬

                    </div>


                    <span class="absolute
                                 -top-2 -right-2
                                 w-5 h-5
                                 rounded-full
                                 bg-indigo-100">
                    </span>

                    <span class="absolute
                                 bottom-0 -left-3
                                 w-3 h-3
                                 rounded-full
                                 bg-blue-100">
                    </span>

                </div>


                <h3 class="text-xl
                           font-bold
                           text-slate-800
                           mt-5">

                    No Active Conversations

                </h3>


                <p class="text-sm
                          text-slate-500
                          mt-2
                          leading-relaxed">

                    Conversations will appear here when a student contacts you
                    about one of your submitted solutions.

                </p>


                <div class="mt-4
                            inline-flex
                            items-center
                            gap-2
                            px-4 py-2
                            rounded-full
                            bg-slate-50
                            text-slate-500
                            text-xs">

                    <span>
                        ✨
                    </span>

                    Keep helping students!

                </div>

            </div>

        @endforelse

    </div>



    {{-- ============================================================ --}}
    {{-- NOTIFICATIONS --}}
    {{-- ============================================================ --}}

    <div class="mb-0">

        <div class="bg-white
                    rounded-3xl
                    border border-slate-200
                    shadow-sm
                    overflow-hidden">


            {{-- ===================================================== --}}
            {{-- NOTIFICATION HEADER --}}
            {{-- ===================================================== --}}

            <div class="px-6 py-5
                        border-b border-slate-100
                        flex items-center justify-between">


                <div class="flex items-center gap-3">

                    <div class="w-11 h-11
                                rounded-xl
                                bg-blue-50
                                flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-blue-600"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M15 17h5l-1.405-1.405A2.032
                                     2.032 0 0118 14.158V11a6.002
                                     6.002 0 00-4-5.659V5a2 2 0
                                     10-4 0v.341C7.67 6.165 6
                                     8.388 6 11v3.159c0 .538-.214
                                     1.055-.595 1.436L4 17h5m6
                                     0v1a3 3 0 11-6 0v-1m6 0H9"/>

                        </svg>

                    </div>


                    <div>

                        <h2 class="text-xl
                                   font-bold
                                   text-slate-900">

                            Notifications

                        </h2>


                        <p class="text-sm
                                  text-slate-500">

                            Updates about your submitted solutions

                        </p>

                    </div>

                </div>

            </div>



            {{-- ===================================================== --}}
            {{-- NOTIFICATION LIST --}}
            {{-- ===================================================== --}}

            @forelse($notifications as $notification)

                <div class="px-6 py-5
                            border-b border-slate-100
                            last:border-b-0
                            hover:bg-slate-50
                            transition">

                    <div class="flex items-start
                                gap-4">


                        {{-- Status Icon --}}
                        @if($notification->status === 'accepted')

                            <div class="w-10 h-10
                                        rounded-full
                                        bg-green-100
                                        flex items-center justify-center
                                        shrink-0">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-green-600"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M5 13l4 4L19 7"/>

                                </svg>

                            </div>

                        @else

                            <div class="w-10 h-10
                                        rounded-full
                                        bg-red-100
                                        flex items-center justify-center
                                        shrink-0">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-red-600"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M6 18L18 6M6 6l12 12"/>

                                </svg>

                            </div>

                        @endif



                        {{-- Notification Text --}}
                        <div class="flex-1 min-w-0">

                            @if($notification->status === 'accepted')

                                <h3 class="font-semibold
                                           text-green-700">

                                    Solution Accepted

                                </h3>


                                <p class="mt-1
                                          text-sm
                                          text-slate-600">

                                    Your solution for

                                    <span class="font-semibold
                                                 text-slate-800">

                                        "{{ $notification->problem->title }}"

                                    </span>

                                    was accepted by the student.

                                </p>

                            @else

                                <h3 class="font-semibold
                                           text-red-700">

                                    Solution Rejected

                                </h3>


                                <p class="mt-1
                                          text-sm
                                          text-slate-600">

                                    Your solution for

                                    <span class="font-semibold
                                                 text-slate-800">

                                        "{{ $notification->problem->title }}"

                                    </span>

                                    was not selected by the student.

                                </p>

                            @endif


                            @if($notification->updated_at)

                                <p class="mt-2
                                          text-xs
                                          text-slate-400">

                                    {{ $notification->updated_at->diffForHumans() }}

                                </p>

                            @endif

                        </div>



                        {{-- Status Badge --}}
                        @if($notification->status === 'accepted')

                            <span class="hidden sm:inline-flex
                                         px-3 py-1
                                         rounded-full
                                         bg-green-100
                                         text-green-700
                                         text-xs
                                         font-semibold
                                         flex-shrink-0">

                                Accepted

                            </span>

                        @else

                            <span class="hidden sm:inline-flex
                                         px-3 py-1
                                         rounded-full
                                         bg-red-100
                                         text-red-700
                                         text-xs
                                         font-semibold
                                         flex-shrink-0">

                                Rejected

                            </span>

                        @endif

                                        @if($notification->status === 'accepted')

                        @php
                            $myReview = $notification->reviews
                                ->firstWhere('reviewer_id', auth()->id());
                        @endphp

                        <div class="mt-4 pt-4 border-t border-slate-200">

                            @if($myReview)

                                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">

                                    <h4 class="font-semibold text-slate-900 mb-2">
                                        Your Review of the Student
                                    </h4>

                                    <div class="text-yellow-500 text-xl mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            {{ $i <= $myReview->rating ? '★' : '☆' }}
                                        @endfor
                                    </div>

                                    @if($myReview->comment)
                                        <p class="text-sm text-slate-700">
                                            {{ $myReview->comment }}
                                        </p>
                                    @endif

                                </div>

                            @else

                                <h4 class="font-semibold text-slate-900 mb-3">
                                    Rate & Review This Student
                                </h4>

                                <form method="POST"
                                      action="{{ route('reviews.store', $notification->id) }}">

                                    @csrf

                                    <select name="rating"
                                            required
                                            class="w-full rounded-xl border-slate-300 mb-3">

                                        <option value="">Select rating</option>
                                        <option value="5">★★★★★ - 5</option>
                                        <option value="4">★★★★☆ - 4</option>
                                        <option value="3">★★★☆☆ - 3</option>
                                        <option value="2">★★☆☆☆ - 2</option>
                                        <option value="1">★☆☆☆☆ - 1</option>

                                    </select>

                                    <textarea name="comment"
                                              rows="3"
                                              maxlength="1000"
                                              class="w-full rounded-xl border-slate-300"
                                              placeholder="Write your review..."></textarea>

                                    <button type="submit"
                                            class="mt-3 bg-blue-600 hover:bg-blue-700
                                                   text-white px-5 py-2.5 rounded-xl
                                                   font-semibold transition">

                                        Submit Review

                                    </button>

                                </form>

                            @endif

                        </div>

                    @endif

                

                </div>


            @empty

                {{-- ================================================= --}}
                {{-- NO NOTIFICATIONS --}}
                {{-- ================================================= --}}

                <div class="px-6 py-10
                            text-center">

                    <div class="w-14 h-14
                                mx-auto
                                rounded-full
                                bg-slate-100
                                flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-7 h-7 text-slate-400"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="1.8">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M15 17h5l-1.405-1.405A2.032
                                     2.032 0 0118 14.158V11a6.002
                                     6.002 0 00-4-5.659V5a2 2 0
                                     10-4 0v.341C7.67 6.165
                                     6 8.388 6 11v3.159c0
                                     .538-.214 1.055-.595
                                     1.436L4 17h5"/>

                        </svg>

                    </div>


                    <p class="mt-4
                              font-semibold
                              text-slate-700">

                        No notifications yet

                    </p>


                    <p class="mt-1
                              text-sm
                              text-slate-500">

                        You will see updates here when a student reviews your solution.

                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>



        {{-- ================= REPORT UPDATES ================= --}}

        <div class="mt-8 mb-8">

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- Report Update Header --}}
                <div class="px-6 py-5 border-b border-slate-100
                            flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl
                                bg-amber-50
                                flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-amber-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v2m0 4h.01M10.29 3.86l-7.5 13A1 1 0 003.66 18h16.68a1 1 0 00.87-1.5l-7.5-13a1 1 0 00-1.74 0z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-xl font-bold text-slate-900">
                            Report Updates
                        </h2>

                        <p class="text-sm text-slate-500">
                            Updates about the reports you submitted
                        </p>

                    </div>

                </div>


                {{-- Report Update List --}}

                @forelse($reportUpdates as $report)

                    <div class="px-6 py-5
                                border-b border-slate-100
                                last:border-b-0
                                hover:bg-slate-50
                                transition">

                        <div class="flex items-start gap-4">

                            {{-- Status Icon --}}

                            @if($report->status === 'dismissed')

                                <div class="w-10 h-10 rounded-full
                                            bg-slate-100
                                            flex items-center justify-center
                                            shrink-0">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-slate-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 18L18 6M6 6l12 12"/>

                                    </svg>

                                </div>

                            @else

                                <div class="w-10 h-10 rounded-full
                                            bg-green-100
                                            flex items-center justify-center
                                            shrink-0">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-green-600"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 13l4 4L19 7"/>

                                    </svg>

                                </div>

                            @endif


                            {{-- Report Information --}}

                            <div class="flex-1">

                                @if($report->status === 'dismissed')

                                    <h3 class="font-semibold text-slate-700">
                                        Report Dismissed
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-600">
                                        Your report has been reviewed and dismissed by an administrator.
                                    </p>

                                @else

                                    <h3 class="font-semibold text-green-700">
                                        Action Taken
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-600">
                                        Your report has been reviewed and appropriate action has been taken.
                                    </p>

                                @endif


                                @if($report->reported_content_title)

                                    <p class="mt-2 text-sm text-slate-500">

                                        Reported:
                                        <span class="font-semibold text-slate-700">
                                            "{{ $report->reported_content_title }}"
                                        </span>

                                    </p>

                                @endif


                                @if($report->updated_at)

                                    <p class="mt-2 text-xs text-slate-400">
                                        {{ $report->updated_at->diffForHumans() }}
                                    </p>

                                @endif

                            </div>


                            {{-- Status Badge --}}

                            @if($report->status === 'dismissed')

                                <span class="hidden sm:inline-flex
                                            px-3 py-1
                                            rounded-full
                                            bg-slate-100
                                            text-slate-600
                                            text-xs
                                            font-semibold">

                                    Dismissed

                                </span>

                            @else

                                <span class="hidden sm:inline-flex
                                            px-3 py-1
                                            rounded-full
                                            bg-green-100
                                            text-green-700
                                            text-xs
                                            font-semibold">

                                    Action Taken

                                </span>

                            @endif

                        </div>

                    </div>

                @empty

                    {{-- No Report Updates --}}

                    <div class="px-6 py-10 text-center">

                        <div class="w-14 h-14
                                    mx-auto
                                    rounded-full
                                    bg-slate-100
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-7 h-7 text-slate-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01M10.29 3.86l-7.5 13A1 1 0 003.66 18h16.68a1 1 0 00.87-1.5l-7.5-13a1 1 0 00-1.74 0z"/>

                            </svg>

                        </div>

                        <p class="mt-4 font-semibold text-slate-700">
                            No Report Updates
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            You will see updates here when your reports are reviewed.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>
        {{-- ================= WARNINGS ================= --}}

        <div class="mt-8 mb-8">

            <div class="bg-white rounded-2xl border border-slate-200
                        shadow-sm overflow-hidden">

                {{-- Warning Header --}}
                <div class="px-6 py-5 border-b border-slate-200
                            flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl
                                bg-red-50
                                flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-red-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v2m0 4h.01M10.29 3.86l-7.5 13A1 1 0 003.66 18h16.68a1 1 0 00.87-1.5l-7.5-13a1 1 0 00-1.74 0z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Warnings
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Warnings issued to your account by an administrator.
                        </p>

                    </div>

                </div>


                {{-- Warning List --}}

                @forelse($warnings as $warning)

                    <div class="px-6 py-5
                                border-b border-slate-100
                                last:border-b-0
                                hover:bg-slate-50
                                transition">

                        <div class="flex items-start gap-4">

                            {{-- Warning Icon --}}

                            <div class="w-10 h-10 rounded-full
                                        bg-red-100
                                        flex items-center justify-center
                                        shrink-0">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-red-600"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01M10.29 3.86l-7.5 13A1 1 0 003.66 18h16.68a1 1 0 00.87-1.5l-7.5-13a1 1 0 00-1.74 0z"/>

                                </svg>

                            </div>


                            {{-- Warning Information --}}

                            <div class="flex-1">

                                @if(
                                    $warning->report &&
                                    $warning->report->reported_content_title
                                )

                                    <h3 class="font-semibold text-red-700">
                                        Content Removed & Warning Issued
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-600">
                                        After reviewing a report concerning your account,
                                        the reported content was removed and a warning
                                        has been issued. For more information, please contact the support team and check the report details.
                                    </p>

                                @else

                                    <h3 class="font-semibold text-red-700">
                                        Warning Issued
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-600">
                                        After reviewing a report concerning your account,
                                        a warning has been issued. For more information, please contact the support team and check the report details.
                                    </p>

                                @endif


                                @if($warning->created_at)

                                    <p class="mt-2 text-xs text-slate-400">
                                        {{ $warning->created_at->diffForHumans() }}
                                    </p>

                                @endif

                            </div>


                            {{-- Badge --}}

                            <span class="hidden sm:inline-flex
                                        px-3 py-1
                                        rounded-full
                                        bg-red-100
                                        text-red-700
                                        text-xs
                                        font-semibold">

                                Warning

                            </span>

                        </div>

                    </div>

                @empty

                    {{-- No Warnings --}}

                    <div class="px-6 py-10 text-center">

                        <div class="w-14 h-14
                                    mx-auto
                                    rounded-2xl
                                    bg-slate-100
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-7 h-7 text-slate-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01M10.29 3.86l-7.5 13A1 1 0 003.66 18h16.68a1 1 0 00.87-1.5l-7.5-13a1 1 0 00-1.74 0z"/>

                            </svg>

                        </div>

                        <h3 class="mt-4 font-semibold text-slate-900">
                            No Warnings
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            You currently have no warnings.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>
