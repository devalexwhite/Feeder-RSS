<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between w-full items-center">
            <div class="flex flex-row items-center gap-4">
                @if ($feed->feed_image)
                    <img src="{{ $feed->feed_image }}" alt="{{ $feed->friendly_name }}"
                        class="h-16 w-16 rounded-full object-cover">
                @endif
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight capitalize">
                    {{ $feed->friendly_name }}
                </h2>
            </div>

            <div class="flex flex-row gap-4 items-center">
                <a href="{{ route('feeds.edit', $feed) }}"
                    class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Edit</a>


                <button type="button" hx-get="{{ route('feeds.parse', $feed) }}" hx-target="#feed-items"
                    hx-swap="innerHTML"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Refresh
                    feed</button>
            </div>
        </div>

        <div class="mt-8">
            <div>
                @include('feeds.feed', ['feed' => $feed])
            </div>
        </div>
    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="py-4 px-8" id="feed-items">
                @include('feedItems.list', ['items' => $feed->feedItems()->simplePaginate(5), 'feed' => $feed])
            </div>
        </div>
    </div>
</x-app-layout>