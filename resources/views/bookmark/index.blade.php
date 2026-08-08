<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bookmarked Problems') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('message'))
                <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @forelse($bookmarks as $bookmark)
                    <div class="border-b py-4 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold">{{ $bookmark->problem->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $bookmark->problem->department }} | {{ $bookmark->problem->course }}</p>
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mt-1">
                                Reward: ${{ $bookmark->problem->reward }}
                            </span>
                        </div>
                        <div>
                            <form action="{{ route('bookmarks.toggle', $bookmark->problem->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                    Remove Bookmark
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">You haven't bookmarked any problems yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>