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


        <!-- Browse Problems Card -->
        <div class="group relative
                    bg-white
                    rounded-3xl
                    border border-slate-200
                    shadow-sm
                    hover:shadow-xl
                    transition-all duration-300
                    overflow-hidden">

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

    </div>

</x-app-layout>
