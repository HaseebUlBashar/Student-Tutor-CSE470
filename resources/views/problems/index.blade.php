<x-app-layout>

    {{-- =========================
         HEADER
    ========================== --}}
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
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332-.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332-.477-4.5 1.253"/>

                </svg>

            </div>

            <div>

                <h2 class="text-2xl font-bold text-slate-900">
                    My Academic Problems
                </h2>

                <p class="text-sm text-slate-500">
                    Manage the academic problems you have posted
                </p>

            </div>

        </div>

    </x-slot>


    {{-- =========================
         MAIN CONTENT
    ========================== --}}
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">


        {{-- =========================
             TOP SECTION
        ========================== --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

            <div>

                <h1 class="text-2xl font-bold text-slate-900">
                    Your Problems
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    View and manage all the academic problems you have posted.
                </p>

            </div>


            {{-- Post New Problem Button --}}
            <a href="{{ route('problems.create') }}"
               class="inline-flex items-center justify-center gap-2
                      bg-blue-600 hover:bg-blue-700
                      text-white font-semibold
                      px-5 py-3
                      rounded-xl
                      shadow-sm hover:shadow-md
                      transition-all duration-200">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 4v16m8-8H4"/>

                </svg>

                Post New Problem

            </a>

        </div>


        {{-- =========================
             SUCCESS MESSAGE
        ========================== --}}
        @if(session('success'))

            <div class="mb-6 flex items-center gap-3
                        bg-green-50 border border-green-200
                        text-green-700
                        px-5 py-4
                        rounded-xl">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6 flex-shrink-0"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>

                </svg>

                <span class="font-medium">
                    {{ session('success') }}
                </span>

            </div>

        @endif


        {{-- =========================
             ERROR MESSAGE
        ========================== --}}
        @if(session('error'))

            <div class="mb-6 flex items-center gap-3
                        bg-red-50 border border-red-200
                        text-red-700
                        px-5 py-4
                        rounded-xl">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6 flex-shrink-0"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>

                </svg>

                <span class="font-medium">
                    {{ session('error') }}
                </span>

            </div>

        @endif


        {{-- =========================
             PROBLEMS TABLE
        ========================== --}}
        <div class="bg-blue-100 rounded-2xl shadow-sm border border-slate-200 overflow-hidden">


            {{-- Table Header --}}
            <div class="px-6 py-5 border-b border-slate-200">

                <div class="flex items-center justify-between">

                    <div>

                        <h2 class="text-xl font-bold text-slate-900">
                            Posted Problems
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Keep track of your academic questions and their progress.
                        </p>

                    </div>

                    <div class="hidden sm:flex items-center justify-center
                                w-10 h-10
                                rounded-xl
                                bg-blue-50">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-blue-600"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                        </svg>

                    </div>

                </div>

            </div>


            {{-- Responsive Table --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[900px]">

                    {{-- =========================
                         TABLE HEAD
                    ========================== --}}
                    <thead class="bg-slate-50 border-b border-slate-200">

                        <tr>

                            <th class="px-6 py-4 text-left
                                       text-xs font-bold text-slate-500
                                       uppercase tracking-wider">
                                Problem
                            </th>

                            <th class="px-6 py-4 text-left
                                       text-xs font-bold text-slate-500
                                       uppercase tracking-wider">
                                Course
                            </th>

                            <th class="px-6 py-4 text-left
                                       text-xs font-bold text-slate-500
                                       uppercase tracking-wider">
                                Reward
                            </th>

                            <th class="px-6 py-4 text-left
                                       text-xs font-bold text-slate-500
                                       uppercase tracking-wider">
                                Deadline
                            </th>

                            <th class="px-6 py-4 text-left
                                       text-xs font-bold text-slate-500
                                       uppercase tracking-wider">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center
                                       text-xs font-bold text-slate-500
                                       uppercase tracking-wider">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    {{-- =========================
                         TABLE BODY
                    ========================== --}}
                    <tbody class="divide-y divide-slate-100">

                    @forelse($problems as $problem)

                        <tr class="hover:bg-slate-50 transition-colors duration-150">


                            {{-- Problem --}}
                            <td class="px-6 py-5">

                                <div>

                                    <p class="font-semibold text-slate-900">
                                        {{ $problem->title }}
                                    </p>

                                    <p class="text-sm text-slate-500 mt-1">
                                        {{ $problem->department }}
                                    </p>

                                </div>

                            </td>


                            {{-- Course --}}
                            <td class="px-6 py-5">

                                <span class="inline-flex items-center
                                             px-3 py-1
                                             rounded-lg
                                             bg-blue-50
                                             text-blue-700
                                             text-sm
                                             font-semibold">

                                    {{ $problem->course }}

                                </span>

                            </td>


                            {{-- Reward --}}
                            <td class="px-6 py-5">

                                <span class="font-semibold text-slate-800">
                                    ৳ {{ number_format($problem->reward, 2) }}
                                </span>

                            </td>


                            {{-- Deadline --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-2 text-slate-600">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-4 h-4"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         stroke-width="2">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                                    </svg>

                                    <span class="text-sm">
                                        {{ \Carbon\Carbon::parse($problem->deadline)->format('d M Y') }}
                                    </span>

                                </div>

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-5">

                                @if($problem->status === 'Open')

                                    <span class="inline-flex items-center gap-2
                                                 px-3 py-1.5
                                                 rounded-full
                                                 bg-green-50
                                                 text-green-700
                                                 text-sm
                                                 font-semibold">

                                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>

                                        Open

                                    </span>

                                @elseif($problem->status === 'In Progress')

                                    <span class="inline-flex items-center gap-2
                                                 px-3 py-1.5
                                                 rounded-full
                                                 bg-yellow-50
                                                 text-yellow-700
                                                 text-sm
                                                 font-semibold">

                                        <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>

                                        In Progress

                                    </span>

                                @elseif($problem->status === 'Solved')

                                    <span class="inline-flex items-center gap-2
                                                 px-3 py-1.5
                                                 rounded-full
                                                 bg-purple-50
                                                 text-purple-700
                                                 text-sm
                                                 font-semibold">

                                        <span class="w-2 h-2 bg-purple-500 rounded-full"></span>

                                        Solved

                                    </span>

                                @elseif($problem->status === 'Expired')
                                
                                    <span class="inline-flex items-center gap-2
                                                 px-3 py-1.5
                                                 rounded-full
                                                 bg-red-50
                                                 text-red-700
                                                 text-sm
                                                 font-semibold">

                                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>

                                        Expired

                                    </span>

                                @else

                                    <span class="inline-flex items-center
                                                 px-3 py-1.5
                                                 rounded-full
                                                 bg-gray-100
                                                 text-gray-600
                                                 text-sm
                                                 font-semibold">

                                        {{ $problem->status }}

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ route('problems.solutions', $problem->id) }}"
                                    class="inline-flex items-center gap-1.5
                                            px-3 py-2
                                            rounded-lg
                                            text-sm font-semibold
                                            text-purple-600
                                            bg-purple-50
                                            hover:bg-purple-100
                                            transition">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-4 h-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M8 10h8M8 14h5m6-9H5a2 2 0 00-2 2v14l4-4h12a2 2 0 002-2V7a2 2 0 00-2-2z"/>

                                        </svg>

                                        Solutions
                                    </a>
                                    {{-- Edit --}}
                                    <a href="{{ route('problems.edit', $problem->id) }}"
                                       class="inline-flex items-center gap-1.5
                                              px-3 py-2
                                              rounded-lg
                                              text-sm font-semibold
                                              text-blue-600
                                              bg-blue-50
                                              hover:bg-blue-100
                                              transition">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-4 h-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-8.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 8.5-8.5z"/>

                                        </svg>

                                        Edit

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route('problems.destroy', $problem->id) }}"
                                          method="POST"
                                          class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Are you sure you want to delete this problem?')"
                                            class="inline-flex items-center gap-1.5
                                                   px-3 py-2
                                                   rounded-lg
                                                   text-sm font-semibold
                                                   text-red-600
                                                   bg-red-50
                                                   hover:bg-red-100
                                                   transition">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-4 h-4"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor"
                                                 stroke-width="2">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"/>

                                            </svg>

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        {{-- Empty State --}}
                        <tr>

                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-16 h-16
                                                rounded-2xl
                                                bg-blue-50
                                                flex items-center justify-center
                                                mb-4">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-8 h-8 text-blue-500"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="1.8">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                                        </svg>

                                    </div>

                                    <h3 class="text-lg font-bold text-slate-900">
                                        No problems posted yet
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500 max-w-md">
                                        You haven't posted any academic problems.
                                        Create your first problem and get help from student tutors.
                                    </p>

                                    <a href="{{ route('problems.create') }}"
                                       class="mt-5 inline-flex items-center gap-2
                                              bg-blue-600 hover:bg-blue-700
                                              text-white
                                              font-semibold
                                              px-5 py-2.5
                                              rounded-xl
                                              transition">

                                        + Post Your First Problem

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>
