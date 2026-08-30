<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between gap-3">

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
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m7-8a4 4 0 100-8 4 4 0 000 8zm7-4a4 4 0 11-2.5 3.464M22 21v-2a4 4 0 00-3-3.874"/>

                    </svg>

                </div>

                <div>

                    <h2 class="text-2xl font-bold text-slate-900">
                        Our Student Tutors
                    </h2>

                    <p class="text-sm text-slate-500">
                        Discover our tutors, their achievements, and what students say about them.
                    </p>

                </div>

            </div>

            <div class="hidden sm:flex items-center gap-2
                        px-4 py-2 rounded-full
                        bg-blue-50 text-blue-700
                        text-sm font-semibold">

                <span>👨‍🏫</span>
                {{ $studentTutors->count() }} Tutors

            </div>

        </div>

    </x-slot>


    <div class="py-10 bg-slate-50 min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- ========================================================= --}}
            {{-- EMPTY STATE --}}
            {{-- ========================================================= --}}

            @if($studentTutors->count() === 0)

                <div class="bg-white rounded-3xl shadow-sm
                            border border-gray-100
                            p-12 text-center">

                    <div class="w-20 h-20 mx-auto rounded-full
                                bg-blue-50
                                flex items-center justify-center
                                text-4xl">

                        👨‍🏫

                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mt-6">
                        No Student Tutors Yet
                    </h3>

                    <p class="text-gray-500 mt-2 max-w-md mx-auto">
                        There are currently no student tutors available.
                        Please check back later.
                    </p>

                </div>


            @else


                {{-- ========================================================= --}}
                {{-- LEADERBOARD HEADER --}}
                {{-- ========================================================= --}}

                <div class="relative overflow-hidden
                            rounded-3xl
                            bg-gradient-to-br from-slate-900
                            via-blue-950 to-indigo-950
                            shadow-xl
                            mb-8">

                    {{-- Decorative background circles --}}

                    <div class="absolute -top-20 -right-20
                                w-64 h-64
                                bg-blue-500/10
                                rounded-full">
                    </div>

                    <div class="absolute -bottom-24 -left-20
                                w-72 h-72
                                bg-indigo-500/10
                                rounded-full">
                    </div>


                    <div class="relative p-8 md:p-10">

                        <div class="flex flex-col md:flex-row
                                    md:items-center
                                    md:justify-between gap-6">

                            <div>

                                <div class="inline-flex items-center gap-2
                                            px-3 py-1.5
                                            rounded-full
                                            bg-white/10
                                            border border-white/10
                                            text-blue-200
                                            text-xs font-bold
                                            uppercase tracking-wider">

                                    🏆 Tutor Leaderboard

                                </div>

                                <h1 class="text-3xl md:text-4xl
                                           font-extrabold
                                           text-white mt-4">

                                    Top Student Tutors

                                </h1>

                                <p class="text-slate-300
                                          mt-2 max-w-2xl
                                          leading-relaxed">

                                    See which student tutors have helped
                                    students successfully solve the most problems.

                                </p>

                            </div>


                            {{-- Ranking explanation --}}

                            <div class="shrink-0
                                        bg-white/10
                                        border border-white/10
                                        rounded-2xl
                                        px-6 py-5
                                        backdrop-blur-sm">

                                <p class="text-xs uppercase
                                          tracking-wider
                                          text-slate-400
                                          font-semibold">

                                    Ranking based on

                                </p>

                                <div class="flex items-center gap-3 mt-2">

                                    <div class="w-10 h-10 rounded-xl
                                                bg-blue-500/20
                                                flex items-center justify-center
                                                text-xl">

                                        ✓

                                    </div>

                                    <div>

                                        <p class="text-white
                                                  font-bold text-lg">

                                            Accepted Solutions

                                        </p>

                                        <p class="text-xs text-slate-400">
                                            Approved by students
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- RANKING --}}
                {{-- ========================================================= --}}

                <div class="bg-white rounded-3xl
                            shadow-sm
                            border border-gray-100
                            overflow-hidden
                            mb-12">

                    <div class="px-6 md:px-8 py-6
                                border-b border-gray-100
                                flex items-center justify-between">

                        <div>

                            <h2 class="text-xl font-bold text-gray-900">
                                Tutor Rankings
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Tutors ranked by accepted solutions.
                            </p>

                        </div>

                        <div class="hidden sm:flex items-center gap-2
                                    text-xs font-semibold
                                    text-gray-400">

                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>

                            Live ranking

                        </div>

                    </div>


                    @php

                        $maxAccepted = max(
                            $studentTutors->max('accepted_solutions_count'),
                            1
                        );

                    @endphp


                    <div class="p-6 md:p-8">

                        <div class="space-y-6">

                            @foreach($studentTutors as $index => $tutor)

                                @php

                                    $rank = $index + 1;

                                    $accepted = $tutor->accepted_solutions_count;

                                    $percentage = $accepted > 0
                                        ? ($accepted / $maxAccepted) * 100
                                        : 0;

                                @endphp


                                <div class="group">


                                    {{-- Tutor information --}}

                                    <div class="flex items-center gap-4">


                                        {{-- Rank number --}}

                                        <div class="shrink-0
                                            w-10 h-10 rounded-xl
                                            flex items-center justify-center
                                            font-extrabold text-sm

                                            {{ $rank === 1
                                                ? 'bg-yellow-100 text-yellow-700 ring-4 ring-yellow-50'
                                                : ($rank === 2
                                                    ? 'bg-slate-100 text-slate-700'
                                                    : ($rank === 3
                                                        ? 'bg-orange-100 text-orange-700'
                                                        : 'bg-blue-50 text-blue-600')) }}">

                                            @if($rank === 1)
                                                🥇
                                            @elseif($rank === 2)
                                                🥈
                                            @elseif($rank === 3)
                                                🥉
                                            @else
                                                {{ $rank }}
                                            @endif

                                        </div>


                                        {{-- Avatar --}}

                                        @if($tutor->profile_picture)

                                            <img
                                                src="{{ asset('storage/' . $tutor->profile_picture) }}"
                                                alt="{{ $tutor->name }}"
                                                class="w-12 h-12 rounded-full
                                                       object-cover
                                                       border-2 border-white
                                                       shadow-sm"
                                            >

                                        @else

                                            <div class="w-12 h-12 rounded-full
                                                        bg-gradient-to-br
                                                        from-blue-500
                                                        to-indigo-600
                                                        flex items-center
                                                        justify-center
                                                        text-white
                                                        font-bold
                                                        shadow-sm">

                                                {{ strtoupper(substr($tutor->name, 0, 1)) }}

                                            </div>

                                        @endif


                                        {{-- Name --}}

                                        <div class="min-w-0 flex-1">

                                            <a
                                                href="{{ route('student-tutors.show', $tutor) }}"
                                                class="font-bold text-gray-900
                                                       group-hover:text-blue-600
                                                       transition-colors">

                                                {{ $tutor->name }}

                                            </a>

                                            @if($tutor->department)

                                                <p class="text-xs text-gray-500 mt-0.5">
                                                    {{ $tutor->department }}
                                                </p>

                                            @else

                                                <p class="text-xs text-gray-400 mt-0.5">
                                                    Student Tutor
                                                </p>

                                            @endif

                                        </div>


                                        {{-- Accepted solutions --}}

                                        <div class="text-right shrink-0">

                                            <p class="text-xl font-extrabold
                                                      text-gray-900">

                                                {{ $accepted }}

                                            </p>

                                            <p class="text-xs text-gray-400">
                                                Accepted
                                            </p>

                                        </div>

                                    </div>


                                    {{-- Progress bar --}}

                                    <div class="ml-14 mt-3">

                                        <div class="h-3 w-full
                                                    bg-slate-100
                                                    rounded-full
                                                    overflow-hidden">

                                            <div
                                                class="h-full
                                                       rounded-full
                                                       bg-gradient-to-r
                                                       from-blue-500
                                                       to-indigo-600
                                                       transition-all
                                                       duration-700
                                                       group-hover:from-blue-600
                                                       group-hover:to-indigo-700"
                                                style="width: {{ $percentage }}%;"
                                            ></div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>
{{-- ========================================================= --}}
{{-- ACCEPTED SOLUTIONS HISTOGRAM --}}
{{-- ========================================================= --}}

<div class="bg-amber-50 rounded-3xl
            shadow-sm
            border border-gray-100
            overflow-hidden
            mb-12">

    <div class="px-6 md:px-8 py-6
                border-b border-gray-100">

        <h2 class="text-xl font-bold text-gray-900">
            Accepted Solutions by Tutor
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Number of solutions accepted by students for each tutor.
        </p>

    </div>


    @php
        $maxAccepted = max(
            $studentTutors->max('accepted_solutions_count'),
            1
        );
    @endphp


    <div class="p-6 md:p-8">

        {{-- Chart --}}

        <div class="relative">

            {{-- Y-axis labels --}}

            <div class="flex">

                <div class="w-10 shrink-0
                            h-80
                            flex flex-col
                            justify-between
                            text-xs text-gray-400
                            text-right pr-2">

                    <span>{{ $maxAccepted }}</span>

                    <span>{{ round($maxAccepted * .75) }}</span>

                    <span>{{ round($maxAccepted * .50) }}</span>

                    <span>{{ round($maxAccepted * .25) }}</span>

                    <span>0</span>

                </div>


                {{-- Chart area --}}

                <div class="flex-1">

                    <div class="relative
                                h-80
                                border-l
                                border-b
                                border-gray-200">

                        {{-- Horizontal grid lines --}}

                        <div class="absolute inset-x-0 top-0
                                    border-t border-gray-100">
                        </div>

                        <div class="absolute inset-x-0 top-1/4
                                    border-t border-gray-100">
                        </div>

                        <div class="absolute inset-x-0 top-1/2
                                    border-t border-gray-100">
                        </div>

                        <div class="absolute inset-x-0 top-3/4
                                    border-t border-gray-100">
                        </div>


                        {{-- Bars --}}

                        <div class="absolute inset-0
                                    flex items-end
                                    justify-around
                                    gap-2 px-3">

                            @foreach($studentTutors as $index => $tutor)

                                @php
                                    $accepted = $tutor->accepted_solutions_count;

                                    $barHeight = $accepted > 0
                                        ? ($accepted / $maxAccepted) * 100
                                        : 2;
                                @endphp


                                <div class="h-full
                                            flex-1
                                            max-w-24
                                            flex flex-col
                                            justify-end
                                            items-center
                                            group">

                                    {{-- Count --}}

                                    <div class="mb-2
                                                text-sm
                                                font-bold
                                                text-gray-700
                                                opacity-0
                                                group-hover:opacity-100
                                                transition">

                                        {{ $accepted }}

                                    </div>


                                    {{-- Bar --}}

                                    <a
                                        href="{{ route('student-tutors.show', $tutor) }}"
                                        class="w-full
                                               max-w-16
                                               rounded-t-xl
                                               bg-gradient-to-t
                                               from-blue-600
                                               to-indigo-500
                                               hover:from-blue-700
                                               hover:to-indigo-600
                                               transition-all
                                               duration-300
                                               shadow-sm
                                               group-hover:shadow-lg"
                                        style="height: {{ $barHeight }}%;"
                                        title="{{ $tutor->name }}: {{ $accepted }} accepted solutions"
                                    >
                                    </a>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    {{-- Tutor names --}}

                    <div class="flex
                                justify-around
                                gap-2
                                px-3
                                mt-3">

                        @foreach($studentTutors as $tutor)

                            <div class="flex-1
                                        max-w-24
                                        text-center">

                                <a
                                    href="{{ route('student-tutors.show', $tutor) }}"
                                    class="text-xs
                                           sm:text-sm
                                           font-semibold
                                           text-gray-600
                                           hover:text-blue-600
                                           transition
                                           block
                                           truncate"
                                    title="{{ $tutor->name }}"
                                >

                                    {{ $tutor->name }}

                                </a>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>


        {{-- Chart explanation --}}

        <div class="mt-6
                    flex items-center gap-2
                    text-xs text-gray-400">

            <span class="w-3 h-3
                         rounded-sm
                         bg-blue-600">
            </span>

            Accepted solutions

            <span class="ml-2">
                • Hover over a bar to see the exact count
            </span>

        </div>

    </div>

</div>


                {{-- ========================================================= --}}
                {{-- ALL TUTORS --}}
                {{-- ========================================================= --}}

                <div class="mb-6">

                    <div class="flex flex-col sm:flex-row
                                sm:items-end
                                sm:justify-between gap-3">

                        <div>

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-xl
                                            bg-blue-100
                                            flex items-center
                                            justify-center
                                            text-xl">

                                    👨‍🏫

                                </div>

                                <h2 class="text-2xl font-extrabold
                                           text-gray-900">

                                    All Student Tutors

                                </h2>

                            </div>

                            <p class="text-sm text-gray-500 mt-2">
                                Explore tutor profiles and read reviews from students.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- TUTOR CARDS --}}
                {{-- ========================================================= --}}

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">


                    @foreach($studentTutors as $tutor)

                        @php

                            $averageRating =
                                $tutor->reviewsReceived->avg('rating') ?? 0;

                            $reviewCount =
                                $tutor->reviewsReceived->count();

                        @endphp


                        <a
                            href="{{ route('student-tutors.show', $tutor) }}"
                            class="group bg-blue-100
                                   rounded-3xl
                                   border border-gray-100
                                   shadow-sm
                                   overflow-hidden
                                   hover:shadow-xl
                                   hover:-translate-y-1
                                   transition-all duration-300"
                        >


                            {{-- Card top section --}}

                            <div class="p-6">


                                <div class="flex items-center gap-4">


                                    {{-- Avatar --}}

                                    @if($tutor->profile_picture)

                                        <img
                                            src="{{ asset('storage/' . $tutor->profile_picture) }}"
                                            alt="{{ $tutor->name }}"
                                            class="w-16 h-16
                                                   rounded-2xl
                                                   object-cover
                                                   border-4
                                                   border-blue-50"
                                        >

                                    @else

                                        <div class="w-16 h-16
                                                    rounded-2xl
                                                    bg-gradient-to-br
                                                    from-blue-500
                                                    to-indigo-600
                                                    flex items-center
                                                    justify-center
                                                    text-white
                                                    text-xl
                                                    font-bold
                                                    shadow-md">

                                            {{ strtoupper(substr($tutor->name, 0, 1)) }}

                                        </div>

                                    @endif


                                    <div class="min-w-0 flex-1">

                                        <h3 class="font-bold
                                                   text-lg
                                                   text-gray-900
                                                   group-hover:text-blue-600
                                                   transition-colors
                                                   truncate">

                                            {{ $tutor->name }}

                                        </h3>

                                        <p class="text-sm text-blue-600
                                                  font-medium mt-0.5">

                                            Student Tutor

                                        </p>

                                    </div>


                                    {{-- Arrow --}}

                                    <div class="w-9 h-9 rounded-full
                                                bg-slate-50
                                                group-hover:bg-blue-50
                                                flex items-center
                                                justify-center
                                                text-gray-400
                                                group-hover:text-blue-600
                                                transition">

                                        →

                                    </div>

                                </div>


                                {{-- Department --}}

                                @if($tutor->department)

                                    <div class="mt-6
                                                px-4 py-3
                                                rounded-xl
                                                bg-slate-50">

                                        <p class="text-[11px]
                                                  uppercase
                                                  tracking-wider
                                                  font-bold
                                                  text-gray-400">

                                            Department

                                        </p>

                                        <p class="text-sm
                                                  font-semibold
                                                  text-gray-700 mt-1">

                                            {{ $tutor->department }}

                                        </p>

                                    </div>

                                @endif


                                {{-- Statistics --}}

                                <div class="grid grid-cols-2 gap-3 mt-4">


                                    {{-- Rating --}}

                                    <div class="rounded-xl
                                                bg-yellow-50
                                                p-4">

                                        <div class="flex items-center gap-1">

                                            <span class="text-yellow-500">
                                                ★
                                            </span>

                                            <span class="font-extrabold
                                                         text-gray-900">

                                                {{ number_format($averageRating, 1) }}

                                            </span>

                                        </div>

                                        <p class="text-xs text-gray-500 mt-1">

                                            {{ $reviewCount }}
                                            {{ Str::plural('review', $reviewCount) }}

                                        </p>

                                    </div>


                                    {{-- Accepted solutions --}}

                                    <div class="rounded-xl
                                                bg-blue-50
                                                p-4">

                                        <p class="font-extrabold
                                                  text-blue-700
                                                  text-lg">

                                            {{ $tutor->accepted_solutions_count }}

                                        </p>

                                        <p class="text-xs text-gray-500 mt-1">
                                            Accepted solutions
                                        </p>

                                    </div>

                                </div>


                                {{-- View profile --}}

                                <div class="mt-5
                                            flex items-center
                                            justify-between
                                            text-sm">

                                    <span class="font-semibold
                                                 text-gray-500">

                                        View profile & reviews

                                    </span>

                                    <span class="font-bold
                                                 text-blue-600
                                                 group-hover:translate-x-1
                                                 transition-transform">

                                        →
                                    </span>

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>


            @endif

        </div>

    </div>

</x-app-layout>
