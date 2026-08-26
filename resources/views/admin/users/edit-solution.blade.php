<x-app-layout>

    <x-slot name="header">

        <h2 class="text-2xl font-bold text-slate-900">
            Edit Solution
        </h2>

    </x-slot>


    <div class="min-h-screen bg-slate-50">

        <div class="max-w-4xl mx-auto px-4 py-10">

            <div class="bg-white rounded-2xl
                        border border-slate-200
                        shadow-sm p-8">

                <h1 class="text-2xl font-bold text-slate-900 mb-2">
                    Edit Solution #{{ $solution->id }}
                </h1>

                <p class="text-sm text-slate-500 mb-8">

                    Submitted for:

                    <span class="font-semibold text-slate-700">
                        {{ $solution->problem->title }}
                    </span>

                </p>


                @if($errors->any())

                    <div class="bg-red-50 text-red-700
                                rounded-xl p-4 mb-6">

                        <ul class="list-disc list-inside">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ route('admin.solutions.update', $solution) }}"
                >

                    @csrf
                    @method('PUT')


                    {{-- Solution Description --}}
                    <div class="mb-6">

                        <label
                            for="description"
                            class="block text-sm font-semibold
                                   text-slate-700 mb-2"
                        >

                            Solution

                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="10"
                            required
                            class="w-full rounded-xl border-slate-300
                                   focus:border-blue-500
                                   focus:ring-blue-500"
                        >{{ old('description', $solution->description) }}</textarea>

                    </div>


                    {{-- Reward --}}
                    <div class="mb-6">

                        <label
                            for="reward"
                            class="block text-sm font-semibold
                                   text-slate-700 mb-2"
                        >

                            Reward

                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            id="reward"
                            name="reward"
                            value="{{ old('reward', $solution->reward) }}"
                            required
                            class="w-full rounded-xl border-slate-300"
                        >

                    </div>


                    {{-- Status --}}
                    <div class="mb-8">

                        <label
                            for="status"
                            class="block text-sm font-semibold
                                   text-slate-700 mb-2"
                        >

                            Status

                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                            class="w-full rounded-xl border-slate-300"
                        >

                            <option
                                value="submitted"
                                @selected(old('status', $solution->status) === 'submitted')
                            >
                                Submitted
                            </option>

                            <option
                                value="accepted"
                                @selected(old('status', $solution->status) === 'accepted')
                            >
                                Accepted
                            </option>

                            <option
                                value="rejected"
                                @selected(old('status', $solution->status) === 'rejected')
                            >
                                Rejected
                            </option>

                        </select>

                    </div>


                    {{-- Existing Attachment --}}
                    @if($solution->attachment)

                        <div class="mb-8">

                            <p class="text-sm font-semibold text-slate-700 mb-2">
                                Existing Attachment
                            </p>

                            <a
                                href="{{ route('admin.solutions.attachment', $solution) }}"
                                target="_blank"
                                class="inline-flex items-center gap-2
                                    text-blue-600 hover:text-blue-700
                                    font-semibold"
                            >

                                📎 View Solution Attachment

                            </a>

                        </div>

                    @endif


                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3">

                        <a
                            href="{{ route('admin.users.show', $solution->student_tutor_id) }}"
                            class="px-5 py-3 rounded-xl
                                   bg-slate-100 text-slate-700
                                   font-semibold"
                        >

                            Cancel

                        </a>


                        <button
                            type="submit"
                            class="px-5 py-3 rounded-xl
                                   bg-blue-600 text-white
                                   font-semibold
                                   hover:bg-blue-700"
                        >

                            Save Changes

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
