<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center gap-3">

            <a href="{{ route('student-tutors.index') }}"
            class="text-gray-500 hover:text-blue-600 text-lg">

                ←

            </a>

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
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"/>

                </svg>

            </div>

            <div>

                <h2 class="text-2xl font-bold text-slate-900">
                    {{ $studentTutor->name }}
                </h2>

                <p class="text-sm text-slate-500">
                    Student Tutor Profile
                </p>

            </div>

        </div>

    </x-slot>


    <div class="py-10">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">


            <!-- Tutor Profile Card -->

            <div class="bg-blue-100 rounded-2xl shadow-sm
                        border border-gray-100 p-8">

                <div class="flex flex-col md:flex-row
                            items-center md:items-start gap-6">

                    <!-- Profile Picture -->

                    @if($studentTutor->profile_picture)

                        <img
                            src="{{ asset('storage/' . $studentTutor->profile_picture) }}"
                            alt="{{ $studentTutor->name }}"
                            class="w-28 h-28 rounded-full object-cover
                                   border-4 border-blue-50"
                        >

                    @else

                        <div class="w-28 h-28 rounded-full
                                    bg-gradient-to-br from-blue-500 to-indigo-600
                                    flex items-center justify-center
                                    text-white text-4xl font-bold">

                            {{ strtoupper(substr($studentTutor->name, 0, 1)) }}

                        </div>

                    @endif


                    <!-- Information -->

                    <div class="flex-1 text-center md:text-left">

                        <h1 class="text-3xl font-bold text-gray-900">
                            {{ $studentTutor->name }}
                        </h1>

                        <p class="text-blue-600 font-medium mt-1">
                            Student Tutor
                        </p>

                        @if($studentTutor->department)

                            <p class="text-gray-500 mt-3">
                                {{ $studentTutor->department }}
                            </p>

                        @endif


                        <div class="flex flex-wrap justify-center
                                    md:justify-start gap-6 mt-5">

                            <!-- Rating -->

                            <div>

                                <div class="flex items-center gap-2">

                                    <span class="text-yellow-500 text-2xl">
                                        ★
                                    </span>

                                    <span class="text-2xl font-bold">
                                        {{ number_format($averageRating, 1) }}
                                    </span>

                                    <span class="text-gray-500">
                                        / 5
                                    </span>

                                </div>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $studentTutor->reviewsReceived->count() }}
                                    {{ Str::plural('review', $studentTutor->reviewsReceived->count()) }}
                                </p>

                            </div>


                            <!-- Points -->

                            <div>

                                <p class="text-sm text-gray-500">
                                    Points
                                </p>

                                <p class="text-xl font-bold text-gray-900">
                                    {{ $studentTutor->points }}
                                </p>

                            </div>


                            <!-- Badge -->

                            <div>

                                <p class="text-sm text-gray-500">
                                    Badge
                                </p>

                                <p class="text-xl font-bold text-blue-600">
                                    {{ $studentTutor->badgeName() }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Reviews -->

            <div class="mt-8">

                <div class="flex items-center justify-between mb-5">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-900">
                            Student Reviews
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Reviews submitted by students who worked with this tutor.
                        </p>

                    </div>

                    <div class="text-sm font-semibold text-gray-500">
                        {{ $studentTutor->reviewsReceived->count() }}
                        total
                    </div>

                </div>


                @if($studentTutor->reviewsReceived->count() === 0)

                    <div class="bg-white rounded-2xl shadow-sm
                                border border-gray-100 p-10 text-center">

                        <div class="text-gray-300 text-5xl mb-4">
                            ★
                        </div>

                        <h3 class="font-semibold text-gray-800 text-lg">
                            No Reviews Yet
                        </h3>

                        <p class="text-gray-500 mt-2">
                            This student tutor has not received any reviews yet.
                        </p>

                    </div>

                @else

                    <div class="space-y-4">

                        @foreach($studentTutor->reviewsReceived->sortByDesc('created_at') as $review)

                            <div class="bg-white rounded-2xl
                                        shadow-sm border border-gray-100
                                        p-6">

                                <div class="flex items-start justify-between">

                                    <div class="flex items-center gap-3">

                                        @if($review->reviewer && $review->reviewer->profile_picture)

                                            <img
                                                src="{{ asset('storage/' . $review->reviewer->profile_picture) }}"
                                                alt="{{ $review->reviewer->name }}"
                                                class="w-11 h-11 rounded-full object-cover"
                                            >

                                        @else

                                            <div class="w-11 h-11 rounded-full
                                                        bg-gray-200
                                                        flex items-center justify-center
                                                        text-gray-600 font-bold">

                                                {{ strtoupper(substr(
                                                    $review->reviewer->name ?? 'S',
                                                    0,
                                                    1
                                                )) }}

                                            </div>

                                        @endif


                                        <div>

                                            <p class="font-semibold text-gray-900">
                                                {{ $review->reviewer->name ?? 'Student' }}
                                            </p>

                                            <p class="text-xs text-gray-400">
                                                {{ $review->created_at->format('M d, Y') }}
                                            </p>

                                        </div>

                                    </div>


                                    <!-- Stars -->

                                    <div class="flex gap-1">

                                        @for($i = 1; $i <= 5; $i++)

                                            <span class="{{ $i <= $review->rating
                                                ? 'text-yellow-400'
                                                : 'text-gray-300' }}">
                                                ★
                                            </span>

                                        @endfor

                                    </div>

                                </div>


                                <!-- Review Text -->

                                @if($review->comment)

                                    <p class="mt-5 text-gray-700 leading-relaxed">
                                        {{ $review->comment }}
                                    </p>

                                @else

                                    <p class="mt-5 text-gray-400 italic">
                                        No written comment was provided.
                                    </p>

                                @endif

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
