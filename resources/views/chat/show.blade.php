<x-app-layout>

    <x-slot name="header">

    <div class="relative overflow-hidden
                rounded-3xl
                bg-gradient-to-r from-blue-600 via-blue-600 to-indigo-700
                shadow-sm">

        {{-- Decorative background shapes --}}
        <div class="absolute -top-12 -right-12
                    w-40 h-40
                    rounded-full
                    bg-white/10">
        </div>

        <div class="absolute -bottom-16 right-24
                    w-32 h-32
                    rounded-full
                    bg-white/5">
        </div>

        <div class="absolute top-8 right-1/3
                    w-5 h-5
                    rounded-full
                    bg-white/20">
        </div>

        <div class="absolute bottom-6 right-12
                    w-3 h-3
                    rounded-full
                    bg-white/30">
        </div>


        {{-- Main header content --}}
        <div class="relative
                    px-5 py-5
                    sm:px-7 sm:py-6">

            <div class="flex items-center
                        justify-between
                        gap-5">


                {{-- Left side --}}
                <div class="flex items-center gap-4 min-w-0">


                    {{-- Back button --}}
                    <a
                        href="{{ auth()->user()->role === 'student'
                            ? route('student.dashboard')
                            : route('tutor.dashboard') }}"
                        class="flex-shrink-0
                               w-11 h-11
                               rounded-2xl
                               bg-white/15
                               hover:bg-white/25
                               border border-white/20
                               text-white
                               flex items-center justify-center
                               text-xl
                               transition
                               backdrop-blur-sm"
                        title="Back to Dashboard"
                    >
                        ←
                    </a>


                    {{-- Chat illustration --}}
                    <div class="hidden sm:flex
                                relative
                                flex-shrink-0
                                w-16 h-16
                                rounded-2xl
                                bg-white
                                items-center justify-center
                                shadow-lg">

                        {{-- Chat bubble --}}
                        <div class="relative
                                    w-9 h-7
                                    rounded-xl
                                    bg-blue-600">

                            <div class="absolute
                                        left-2 bottom-1
                                        w-2 h-2
                                        bg-blue-600
                                        rotate-45">
                            </div>

                            {{-- Message dots --}}
                            <div class="absolute
                                        inset-0
                                        flex items-center
                                        justify-center
                                        gap-1">

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


                        {{-- Small floating bubble --}}
                        <div class="absolute
                                    -top-2 -right-2
                                    w-7 h-7
                                    rounded-full
                                    bg-indigo-500
                                    border-2 border-white
                                    flex items-center justify-center
                                    text-xs">

                            💬

                        </div>

                    </div>


                    {{-- Title and participant --}}
                    <div class="min-w-0">

                        <div class="flex items-center gap-2">

                            <span class="text-xs sm:text-sm
                                         font-bold
                                         text-blue-100
                                         uppercase
                                         tracking-[0.15em]">

                                Messages

                            </span>

                            <span class="hidden sm:inline-block
                                         w-1.5 h-1.5
                                         rounded-full
                                         bg-emerald-300">
                            </span>

                            <span class="hidden sm:inline
                                         text-xs
                                         text-blue-100">

                                Active conversation

                            </span>

                        </div>


                        <h2 class="text-2xl sm:text-3xl lg:text-4xl
                                   font-bold
                                   text-white
                                   mt-1
                                   truncate">

                            {{ auth()->id() === $conversation->student_id
                                ? $conversation->studentTutor->name
                                : $conversation->student->name }}

                        </h2>


                        <p class="text-sm sm:text-base
                                  text-blue-100
                                  mt-1">

                            Discussion about your submitted solution

                        </p>

                    </div>

                </div>


                {{-- Participant avatar --}}
                <div class="hidden sm:flex
                            flex-shrink-0
                            items-center
                            justify-center">

                    <div class="relative">

                        <div class="w-14 h-14
                                    rounded-full
                                    bg-white
                                    text-blue-700
                                    flex items-center justify-center
                                    text-xl
                                    font-bold
                                    shadow-lg
                                    border-4
                                    border-white/30">

                            {{ strtoupper(substr(
                                auth()->id() === $conversation->student_id
                                    ? $conversation->studentTutor->name
                                    : $conversation->student->name,
                                0,
                                1
                            )) }}

                        </div>


                        {{-- Active indicator --}}
                        <span class="absolute
                                     bottom-0 right-0
                                     w-4 h-4
                                     rounded-full
                                     bg-emerald-400
                                     border-2
                                     border-white">
                        </span>

                    </div>

                </div>

            </div>


            {{-- Bottom decorative message line --}}
            <div class="hidden sm:flex
                        items-center gap-2
                        mt-5
                        text-xs
                        text-blue-100/80">

                <span class="w-8 h-px bg-white/30"></span>

                <span>
                    Ask questions, clarify the solution, and communicate with your tutor.
                </span>

            </div>

        </div>

    </div>

</x-slot>


    <div class="min-h-screen bg-slate-50">

        <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">


            {{-- ========================================================= --}}
            {{-- PROBLEM INFORMATION --}}
            {{-- ========================================================= --}}

            <div class="bg-white rounded-2xl
                        border border-slate-200
                        shadow-sm
                        p-6 mb-6">

                <div class="flex items-start gap-4">

                    <div class="w-14 h-14 flex-shrink-0
                                rounded-2xl
                                bg-blue-50
                                text-blue-600
                                flex items-center justify-center
                                text-2xl">

                        📚

                    </div>


                    <div class="min-w-0">

                        <p class="text-sm font-semibold
                                  text-slate-400
                                  uppercase tracking-wide">

                            Discussion about

                        </p>


                        <h1 class="text-2xl md:text-3xl
                                   font-bold text-slate-900
                                   mt-1 leading-tight">

                            {{ $problem->title }}

                        </h1>


                        <div class="flex flex-wrap items-center gap-3 mt-3">

                            <span class="px-3 py-1.5
                                         rounded-lg
                                         bg-slate-100
                                         text-slate-700
                                         text-sm font-semibold">

                                {{ $problem->course }}

                            </span>


                            <span class="text-slate-300">
                                |
                            </span>


                            <span class="text-base text-slate-500">

                                {{ $problem->chapter }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- CHAT CONTAINER --}}
            {{-- ========================================================= --}}

            <div class="bg-white rounded-2xl
                        border border-slate-200
                        shadow-sm
                        overflow-hidden">


                {{-- ===================================================== --}}
                {{-- CHAT HEADER --}}
                {{-- ===================================================== --}}

                <div class="px-6 py-5
                            border-b border-slate-200
                            flex items-center justify-between">

                    <div class="flex items-center gap-4">

                        <div
                            class="w-12 h-12
                                   flex-shrink-0
                                   rounded-full
                                   bg-blue-600
                                   text-white
                                   flex items-center justify-center
                                   text-lg font-bold"
                        >

                            {{ strtoupper(substr(
                                auth()->id() === $conversation->student_id
                                    ? $conversation->studentTutor->name
                                    : $conversation->student->name,
                                0,
                                1
                            )) }}

                        </div>


                        <div>

                            <p class="text-lg font-bold text-slate-900">

                                {{ auth()->id() === $conversation->student_id
                                    ? $conversation->studentTutor->name
                                    : $conversation->student->name }}

                            </p>


                            <p class="text-sm text-slate-500">
                                Solution discussion
                            </p>

                        </div>

                    </div>


                    <div
                        class="hidden sm:flex
                               items-center gap-2
                               px-3 py-1.5
                               rounded-full
                               bg-emerald-50
                               text-emerald-700
                               text-sm font-semibold"
                    >

                        <span
                            class="w-2.5 h-2.5
                                   rounded-full
                                   bg-emerald-500"
                        ></span>

                        Active

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- MESSAGES --}}
                {{-- ===================================================== --}}

                <div
                    id="chat-messages"
                    class="px-5 sm:px-7 py-7
                           min-h-[420px]
                           max-h-[600px]
                           overflow-y-auto
                           bg-white"
                >

                    @forelse($messages as $message)

                        @if($message->sender_id === auth()->id())

                            {{-- ================================================= --}}
                            {{-- MY MESSAGE --}}
                            {{-- ================================================= --}}

                            <div class="w-full flex justify-end mb-5">

                                <div
                                    class="flex flex-col items-end
                                           max-w-[85%] sm:max-w-[70%]"
                                >

                                    {{-- Message bubble --}}
                                    <div
                                        class="bg-blue-600
                                               text-white
                                               rounded-2xl
                                               rounded-br-md
                                               px-4 py-3
                                               shadow-sm
                                               w-fit
                                               max-w-full"
                                        style="
                                            width: fit-content;
                                            max-width: 100%;
                                        "
                                    >

                                        <div
                                            class="text-base
                                                   leading-6
                                                   font-medium
                                                   whitespace-pre-wrap
                                                   break-words"
                                            style="
                                                text-align: left !important;
                                                text-align-last: left !important;
                                                direction: ltr;
                                                width: auto;
                                            "
                                        >{{ $message->message }}</div>

                                    </div>


                                    {{-- Time --}}
                                    <span
                                        class="text-xs
                                               text-slate-400
                                               mt-1.5"
                                    >

                                        {{ $message->created_at->format('d M, h:i A') }}

                                    </span>

                                </div>

                            </div>


                        @else

                            {{-- ================================================= --}}
                            {{-- OTHER PERSON'S MESSAGE --}}
                            {{-- ================================================= --}}

                            <div class="w-full flex justify-start mb-5">

                                <div
                                    class="flex flex-col items-start
                                           max-w-[85%] sm:max-w-[70%]"
                                >

                                    {{-- Sender --}}
                                    <div class="flex items-center gap-2 mb-1.5">

                                        <div
                                            class="w-7 h-7
                                                   flex-shrink-0
                                                   rounded-full
                                                   bg-indigo-100
                                                   text-indigo-700
                                                   flex items-center justify-center
                                                   text-xs
                                                   font-bold"
                                        >

                                            {{ strtoupper(substr(
                                                $message->sender->name,
                                                0,
                                                1
                                            )) }}

                                        </div>


                                        <span
                                            class="text-sm
                                                   font-semibold
                                                   text-slate-500"
                                        >

                                            {{ $message->sender->name }}

                                        </span>

                                    </div>


                                    {{-- Message bubble --}}
                                    <div
                                        class="bg-slate-100
                                               border border-slate-200
                                               text-slate-800
                                               rounded-2xl
                                               rounded-bl-md
                                               px-4 py-3
                                               shadow-sm
                                               w-fit
                                               max-w-full"
                                        style="
                                            width: fit-content;
                                            max-width: 100%;
                                        "
                                    >

                                        <div
                                            class="text-base
                                                   leading-6
                                                   font-medium
                                                   whitespace-pre-wrap
                                                   break-words"
                                            style="
                                                text-align: left !important;
                                                text-align-last: left !important;
                                                direction: ltr;
                                                width: auto;
                                            "
                                        >{{ $message->message }}</div>

                                    </div>


                                    {{-- Time --}}
                                    <span
                                        class="text-xs
                                               text-slate-400
                                               mt-1.5"
                                    >

                                        {{ $message->created_at->format('d M, h:i A') }}

                                    </span>

                                </div>

                            </div>

                        @endif


                    @empty

                        {{-- ================================================= --}}
                        {{-- EMPTY STATE --}}
                        {{-- ================================================= --}}

                        <div
                            class="flex items-center
                                   justify-center
                                   min-h-[360px]"
                        >

                            <div class="text-center">

                                <div
                                    class="w-20 h-20 mx-auto
                                           rounded-2xl
                                           bg-blue-50
                                           text-blue-600
                                           flex items-center justify-center
                                           text-4xl"
                                >

                                    💬

                                </div>


                                <h3
                                    class="text-2xl
                                           font-bold
                                           text-slate-800
                                           mt-5"
                                >

                                    Start the conversation

                                </h3>


                                <p
                                    class="text-base
                                           text-slate-500
                                           mt-2"
                                >

                                    Send a message to discuss the submitted
                                    solution.

                                </p>

                            </div>

                        </div>

                    @endforelse

                </div>


                {{-- ===================================================== --}}
                {{-- MESSAGE COMPOSER --}}
                {{-- ===================================================== --}}

                <div
                    class="border-t border-slate-200
                           bg-slate-50
                           p-5 sm:p-6"
                >

                    <form
                        method="POST"
                        action="{{ route('chat.send', $conversation->id) }}"
                        class="flex items-end gap-3"
                    >

                        @csrf


                        <div class="flex-1">

                            <label
                                for="message"
                                class="sr-only"
                            >
                                Write a message
                            </label>


                            <textarea
                                id="message"
                                name="message"
                                rows="2"
                                placeholder="Write your message..."
                                required
                                maxlength="5000"
                                autocomplete="off"
                                class="w-full
                                       rounded-xl
                                       border-slate-300
                                       bg-white
                                       px-4 py-3
                                       text-base
                                       text-slate-800
                                       placeholder-slate-400
                                       resize-none
                                       focus:border-blue-500
                                       focus:ring-blue-500
                                       shadow-sm
                                       transition"
                            ></textarea>

                        </div>


                        <button
                            type="submit"
                            class="flex-shrink-0
                                   inline-flex items-center
                                   justify-center
                                   gap-2
                                   bg-blue-600
                                   hover:bg-blue-700
                                   active:bg-blue-800
                                   text-white
                                   px-6 py-3.5
                                   rounded-xl
                                   text-base
                                   font-bold
                                   shadow-sm
                                   transition"
                        >

                            <span>
                                Send
                            </span>

                            <span class="text-lg">
                                ➤
                            </span>

                        </button>

                    </form>


                    @error('message')

                        <p
                            class="text-red-600
                                   text-sm
                                   font-medium
                                   mt-2"
                        >

                            {{ $message }}

                        </p>

                    @enderror


                    <div
                        class="flex flex-col sm:flex-row
                               sm:items-center
                               sm:justify-between
                               gap-1
                               mt-2"
                    >

                        <p class="text-xs text-slate-400">

                            Press <strong>Enter</strong> to send.
                            <strong>Shift + Enter</strong> for a new line.

                        </p>


                        <p class="text-xs text-slate-400">

                            Maximum 5,000 characters

                        </p>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- BACK TO DASHBOARD --}}
            {{-- ========================================================= --}}

            <div class="mt-5">

                <a
                    href="{{ auth()->user()->role === 'student'
                        ? route('student.dashboard')
                        : route('tutor.dashboard') }}"
                    class="inline-flex items-center gap-2
                           text-base
                           font-semibold
                           text-slate-500
                           hover:text-blue-600
                           transition"
                >

                    <span class="text-lg">
                        ←
                    </span>

                    Back to Dashboard

                </a>

            </div>

        </div>

    </div>


    {{-- ================================================================ --}}
    {{-- CHAT JAVASCRIPT --}}
    {{-- ================================================================ --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const chatMessages = document.getElementById('chat-messages');
            const messageBox = document.getElementById('message');

            /*
             * Scroll to the newest message.
             */
            if (chatMessages) {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }


            /*
             * Enter = Send
             * Shift + Enter = New line
             */
            if (messageBox) {

                messageBox.addEventListener('keydown', function (event) {

                    if (event.key === 'Enter' && !event.shiftKey) {

                        event.preventDefault();

                        if (this.value.trim() !== '') {
                            this.form.requestSubmit();
                        }

                    }

                });

            }

        });

    </script>

</x-app-layout>
