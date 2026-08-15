<nav x-data="{ open: false }"
     class="bg-slate-900 border-b border-slate-700 shadow-lg">

    <!-- Primary Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-[72px]">

            <!-- LEFT SIDE -->
            <div class="flex items-center">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">

                    @php
                        $dashboardRoute = match(auth()->user()->role) {
                            'student' => route('student.dashboard'),
                            'student_tutor' => route('tutor.dashboard'),
                            'admin' => route('admin.dashboard'),
                            default => route('dashboard'),
                        };
                    @endphp

                    <a href="{{ $dashboardRoute }}"
                       class="flex items-center group">

                        <div class="p-2 rounded-xl
                                    bg-white/10
                                    group-hover:bg-white/20
                                    transition-all duration-200">

                            <x-application-logo
                                class="block h-9 w-auto fill-current text-white"
                            />

                        </div>

                    </a>

                </div>


                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:gap-2 sm:ms-10">

                    <!-- Dashboard -->
                    <a href="{{ $dashboardRoute }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                              text-sm font-semibold
                              transition-all duration-200

                              {{ request()->url() === $dashboardRoute
                                    ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/40'
                                    : 'text-slate-300 hover:text-white hover:bg-white/10' }}">

                        <!-- Home Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10"/>

                        </svg>

                        Dashboard

                    </a>

                    {{-- Wallet --}}

<a href="{{ route('wallet.index') }}"
   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
          text-sm font-semibold
          transition-all duration-200

          {{ request()->routeIs('wallet.index')
                ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/40'
                : 'text-slate-300 hover:text-white hover:bg-white/10' }}">

    <svg xmlns="http://www.w3.org/2000/svg"
         class="w-5 h-5"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor"
         stroke-width="2">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M3 7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>

        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M16 12h3"/>

    </svg>

    Wallet

</a>


                    <!-- Bookmarks -->
                    @if(auth()->user()->role === 'student_tutor')

                        <a href="{{ route('tutor.bookmarks') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                                  text-sm font-semibold
                                  transition-all duration-200

                                  {{ request()->routeIs('tutor.bookmarks')
                                        ? 'bg-yellow-500 text-white shadow-lg shadow-yellow-900/30'
                                        : 'text-slate-300 hover:text-white hover:bg-white/10' }}">

                            <!-- Bookmark Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="{{ request()->routeIs('tutor.bookmarks') ? 'currentColor' : 'none' }}"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z"/>

                            </svg>

                            Bookmarks

                        </a>

                    @endif

                </div>

            </div>


            <!-- RIGHT SIDE -->
            <div class="hidden sm:flex sm:items-center sm:gap-4">

                <!-- Role Badge -->

                @php
                    $roleName = match(auth()->user()->role) {
                        'student' => 'Student',
                        'student_tutor' => 'Student Tutor',
                        'admin' => 'Administrator',
                        default => 'User',
                    };
                @endphp

                <div class="hidden md:flex items-center gap-2
                            px-3 py-1.5 rounded-full
                            bg-white/10 border border-white/10">

                    <div class="w-2 h-2 rounded-full bg-green-400"></div>

                    <span class="text-xs font-medium text-slate-300">
                        {{ $roleName }}
                    </span>

                </div>


                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center gap-3
                                   px-3 py-2
                                   rounded-xl
                                   text-sm font-medium
                                   text-slate-200
                                   hover:bg-white/10
                                   transition-all duration-200
                                   focus:outline-none">

                            <!-- User Avatar -->
                            <div class="w-9 h-9 rounded-full
                                        bg-gradient-to-br from-blue-500 to-indigo-600
                                        flex items-center justify-center
                                        text-white font-bold text-sm
                                        shadow-md">

                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                            </div>

                            <div class="hidden md:block text-left">

                                <div class="font-semibold text-white">
                                    {{ Auth::user()->name }}
                                </div>

                                <div class="text-xs text-slate-400">
                                    {{ $roleName }}
                                </div>

                            </div>


                            <!-- Arrow -->
                            <svg class="w-4 h-4 text-slate-400"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20"
                                 fill="currentColor">

                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd" />

                            </svg>

                        </button>

                    </x-slot>


                    <!-- Dropdown Content -->
                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>


                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                         this.closest('form').submit();">

                                {{ __('Log Out') }}

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center
                           p-2 rounded-xl
                           text-slate-300
                           hover:bg-white/10
                           hover:text-white
                           transition">

                    <svg class="h-6 w-6"
                         stroke="currentColor"
                         fill="none"
                         viewBox="0 0 24 24">

                        <path
                            :class="{'hidden': open, 'inline-flex': ! open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path
                            :class="{'hidden': ! open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>


    <!-- MOBILE MENU -->
    <div
        :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden bg-slate-900 border-t border-slate-700">

        <div class="px-4 pt-4 pb-4 space-y-2">

            <!-- Dashboard -->
            <a href="{{ $dashboardRoute }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl
                      font-semibold text-sm
                      transition
                      {{ request()->url() === $dashboardRoute
                            ? 'bg-blue-600 text-white'
                            : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10"/>

                </svg>

                Dashboard

            </a>


            <!-- Bookmarks -->
            @if(auth()->user()->role === 'student_tutor')

                <a href="{{ route('tutor.bookmarks') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          font-semibold text-sm
                          transition
                          {{ request()->routeIs('tutor.bookmarks')
                                ? 'bg-yellow-500 text-white'
                                : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z"/>

                    </svg>

                    Bookmarks

                </a>

            @endif


            <!-- User Info -->
            <div class="border-t border-slate-700 mt-4 pt-4">

                <div class="px-4">

                    <div class="font-semibold text-white">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="text-sm text-slate-400">
                        {{ Auth::user()->email }}
                    </div>

                </div>


                <div class="mt-3 space-y-1">

                    <x-responsive-nav-link
                        :href="route('profile.edit')">

                        {{ __('Profile') }}

                    </x-responsive-nav-link>


                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <x-responsive-nav-link
                            :href="route('logout')"
                            onclick="event.preventDefault();
                                     this.closest('form').submit();">

                            {{ __('Log Out') }}

                        </x-responsive-nav-link>

                    </form>

                </div>

            </div>

        </div>

    </div>

</nav>
