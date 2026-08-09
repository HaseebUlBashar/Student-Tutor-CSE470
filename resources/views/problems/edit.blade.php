<x-app-layout>

    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900">
            Edit Academic Problem
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-8">

        <div class="bg-white rounded-2xl shadow-xl p-8">

            <form method="POST"
                  action="{{ route('problems.update', $problem->id) }}"
                  enctype="multipart/form-data"
                  class="space-y-6">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-6">

                    <!-- Department -->

                    <div>
                        <label class="block font-semibold mb-2">
                            Department
                        </label>

                        <input
                            type="text"
                            name="department"
                            value="{{ old('department', $problem->department) }}"
                            class="w-full rounded-lg border-gray-300">

                        @error('department')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- Course -->

                    <div>
                        <label class="block font-semibold mb-2">
                            Course
                        </label>

                        <input
                            type="text"
                            name="course"
                            value="{{ old('course', $problem->course) }}"
                            class="w-full rounded-lg border-gray-300">

                        @error('course')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- Chapter -->

                    <div>
                        <label class="block font-semibold mb-2">
                            Chapter
                        </label>

                        <input
                            type="text"
                            name="chapter"
                            value="{{ old('chapter', $problem->chapter) }}"
                            class="w-full rounded-lg border-gray-300">

                        @error('chapter')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- Difficulty -->

                    <div>
                        <label class="block font-semibold mb-2">
                            Difficulty
                        </label>

                        <select
                            name="difficulty"
                            class="w-full rounded-lg border-gray-300">

                            <option value="Easy"
                                {{ old('difficulty', $problem->difficulty) == 'Easy' ? 'selected' : '' }}>
                                Easy
                            </option>

                            <option value="Medium"
                                {{ old('difficulty', $problem->difficulty) == 'Medium' ? 'selected' : '' }}>
                                Medium
                            </option>

                            <option value="Hard"
                                {{ old('difficulty', $problem->difficulty) == 'Hard' ? 'selected' : '' }}>
                                Hard
                            </option>

                        </select>

                        @error('difficulty')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- Reward -->

                    <div>
                        <label class="block font-semibold mb-2">
                            Reward (BDT)
                        </label>

                        <input
                            type="number"
                            name="reward"
                            step="0.01"
                            min="0"
                            value="{{ old('reward', $problem->reward) }}"
                            class="w-full rounded-lg border-gray-300">

                        @error('reward')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- Deadline -->

                    <div>
                        <label class="block font-semibold mb-2">
                            Deadline
                        </label>

                        <input
                            type="date"
                            name="deadline"
                            value="{{ old('deadline', $problem->deadline) }}"
                            class="w-full rounded-lg border-gray-300">

                        @error('deadline')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>


                <!-- Title -->

                <div>
                    <label class="block font-semibold mb-2">
                        Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $problem->title) }}"
                        class="w-full rounded-lg border-gray-300">

                    @error('title')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <!-- Description -->

                <div>
                    <label class="block font-semibold mb-2">
                        Description
                    </label>

                    <textarea
                        rows="6"
                        name="description"
                        class="w-full rounded-lg border-gray-300">{{ old('description', $problem->description) }}</textarea>

                    @error('description')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <!-- Existing attachment -->

                <div>

                    <label class="block font-semibold mb-2">
                        Current Attachment
                    </label>

                    @if($problem->attachment)

                        <p class="text-gray-600 mb-2">
                            Current file:
                            {{ basename($problem->attachment) }}
                        </p>

                        <a
                            href="{{ asset('storage/' . $problem->attachment) }}"
                            target="_blank"
                            class="text-blue-600 hover:underline">

                            View Current Attachment

                        </a>

                    @else

                        <p class="text-gray-500">
                            No attachment uploaded.
                        </p>

                    @endif

                </div>


                <!-- New attachment -->

                <div>

                    <label class="block font-semibold mb-2">
                        Replace Attachment
                    </label>

                    <input
                        type="file"
                        name="attachment"
                        class="block w-full">

                    <p class="text-sm text-gray-500 mt-1">
                        Leave this empty if you want to keep the current attachment.
                    </p>

                    @error('attachment')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Buttons -->

                <div class="flex gap-4">

                    <button
                        type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold">

                        Update Problem

                    </button>

                    <a
                        href="{{ route('problems.index') }}"
                        class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 rounded-xl font-semibold">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
