<x-app-layout>

    <x-slot name="header">

        <h2 class="text-2xl font-bold text-slate-900">
            Edit Problem
        </h2>

    </x-slot>

    <div class="min-h-screen bg-slate-50">

        <div class="max-w-4xl mx-auto px-4 py-10">

            <div class="bg-white rounded-2xl border border-slate-200
                        shadow-sm p-8">

                <h1 class="text-2xl font-bold text-slate-900 mb-6">
                    Edit Problem #{{ $problem->id }}
                </h1>

                @if($errors->any())

                    <div class="bg-red-50 text-red-700 rounded-xl p-4 mb-6">

                        <ul class="list-disc list-inside">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form method="POST"
                      action="{{ route('admin.problems.update', $problem) }}">

                    @csrf
                    @method('PUT')


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                        <div>

                            <label class="block text-sm font-semibold
                                          text-slate-700 mb-2">

                                Department

                            </label>

                            <input type="text"
                                   name="department"
                                   value="{{ old('department', $problem->department) }}"
                                   required
                                   class="w-full rounded-xl border-slate-300">

                        </div>


                        <div>

                            <label class="block text-sm font-semibold
                                          text-slate-700 mb-2">

                                Course

                            </label>

                            <input type="text"
                                   name="course"
                                   value="{{ old('course', $problem->course) }}"
                                   required
                                   class="w-full rounded-xl border-slate-300">

                        </div>


                        <div>

                            <label class="block text-sm font-semibold
                                          text-slate-700 mb-2">

                                Chapter

                            </label>

                            <input type="text"
                                   name="chapter"
                                   value="{{ old('chapter', $problem->chapter) }}"
                                   required
                                   class="w-full rounded-xl border-slate-300">

                        </div>


                        <div>

                            <label class="block text-sm font-semibold
                                          text-slate-700 mb-2">

                                Difficulty

                            </label>

                            <select name="difficulty"
                                    required
                                    class="w-full rounded-xl border-slate-300">

                                @foreach(['Easy', 'Medium', 'Hard'] as $difficulty)

                                    <option value="{{ $difficulty }}"
                                        @selected(old('difficulty', $problem->difficulty) === $difficulty)>

                                        {{ $difficulty }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div>

                            <label class="block text-sm font-semibold
                                          text-slate-700 mb-2">

                                Reward

                            </label>

                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="reward"
                                   value="{{ old('reward', $problem->reward) }}"
                                   required
                                   class="w-full rounded-xl border-slate-300">

                        </div>


                        <div>

                            <label class="block text-sm font-semibold
                                          text-slate-700 mb-2">

                                Deadline

                            </label>

                            <input type="date"
                                   name="deadline"
                                   value="{{ old('deadline', $problem->deadline) }}"
                                   required
                                   class="w-full rounded-xl border-slate-300">

                        </div>


                        <div>

                            <label class="block text-sm font-semibold
                                          text-slate-700 mb-2">

                                Status

                            </label>

                            <select name="status"
                                    required
                                    class="w-full rounded-xl border-slate-300">

                                @foreach(['Open', 'In Progress', 'Solved'] as $status)

                                    <option value="{{ $status }}"
                                        @selected(old('status', $problem->status) === $status)>

                                        {{ $status }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>


                    <div class="mt-5">

                        <label class="block text-sm font-semibold
                                      text-slate-700 mb-2">

                            Title

                        </label>

                        <input type="text"
                               name="title"
                               value="{{ old('title', $problem->title) }}"
                               required
                               class="w-full rounded-xl border-slate-300">

                    </div>


                    <div class="mt-5">

                        <label class="block text-sm font-semibold
                                      text-slate-700 mb-2">

                            Description

                        </label>

                        <textarea name="description"
                                  rows="8"
                                  required
                                  class="w-full rounded-xl border-slate-300">{{ old('description', $problem->description) }}</textarea>

                    </div>


                    <div class="flex justify-end gap-3 mt-8">

                        <a href="{{ route('admin.users.show', $problem->user_id) }}"
                           class="px-5 py-3 rounded-xl
                                  bg-slate-100 text-slate-700
                                  font-semibold">

                            Cancel

                        </a>

                        <button type="submit"
                                class="px-5 py-3 rounded-xl
                                       bg-blue-600 text-white
                                       font-semibold hover:bg-blue-700">

                            Save Changes

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
