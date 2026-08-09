<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            Submit Your Solution
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8 px-4">

        <div class="bg-white shadow-lg rounded-xl p-8">

            <div class="mb-8">

                <h1 class="text-2xl font-bold text-gray-900">
                    {{ $problem->title }}
                </h1>

                <p class="text-gray-500 mt-2">
                    Reward:
                    <strong>
                        ৳ {{ number_format($problem->reward, 2) }}
                    </strong>
                </p>

            </div>


            @if($errors->any())

                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">

                    <ul class="list-disc list-inside">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('tutor.solutions.submit', $solution->id) }}"
                enctype="multipart/form-data">

                @csrf


                {{-- Solution description --}}

                <div class="mb-6">

                    <label
                        for="description"
                        class="block font-semibold text-gray-800 mb-2">

                        Describe Your Solution

                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="10"
                        required
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Explain your solution clearly...">{{ old('description', $solution->description) }}</textarea>

                </div>


                {{-- Solution attachment --}}

                <div class="mb-8">

                    <label
                        for="attachment"
                        class="block font-semibold text-gray-800 mb-2">

                        Upload Solution File

                    </label>

                    <input
                        id="attachment"
                        type="file"
                        name="attachment"
                        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                        class="block w-full border rounded-lg p-3">

                    <p class="text-sm text-gray-500 mt-2">
                        You may upload a PDF, image, DOC, or DOCX file.
                        Maximum size: 10 MB.
                    </p>

                </div>


                {{-- Submit --}}

                <button
                    type="submit"
                    class="w-full bg-green-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-green-700">

                    Submit Solution

                </button>

            </form>

        </div>

    </div>

</x-app-layout>
