<div class="w-full divide-y divide-gray-100 dark:divide-gray-600">
  @foreach ($items as $item)
    <article class="flex flex-col items-start justify-between mb-8 pt-8">
    <div class="flex gap-y-1 text-xs gap-x-2">
      <p class="font-semibold text-gray-900 dark:text-gray-50">
      {{ $item->creator }}
      </p>
      <time datetime="2020-03-16"
      class="text-gray-500">{{ Carbon\Carbon::parse($item->pub_date)->diffForHumans() }}</time>
    </div>
    <div class="group relative">
      <h3 class="mt-4 text-lg font-semibold leading-6 text-gray-900 dark:text-gray-50 group-hover:text-gray-600">
      <a href="{{ $item->link }}" target="_blank">
        {{ $item->title }}
      </a>
      </h3>

      <div
      class="feed-item mt-2 text-sm leading-6 text-gray-600 dark:text-gray-300 prose-sm {{ isset($feed) && $feed->setting_show_truncated ? 'line-clamp-3' : '' }}">
      @if (isset($feed) && $feed->setting_show_html)
      {!! $item->description !!}
    @else
      <p>
      {{$item->description }}
      </p>
    @endif
      </div>
    </div>
    <div class="mt-6">
      <a href="{{ $item->link }}"
      class="text-sm rounded border border-gray-900 dark:border-gray-50 text-gray-900 dark:text-gray-50 hover:bg-gray-800 hover:text-gray-100 transition-all px-3 py-2"
      target="_blank">Read Article</a>
    </div>
    </article>
  @endforeach
</div>
@if (method_exists($items, "items"))
  <div class="border-t border-t-gray-100 dark:border-t-gray-600 pt-4 mt-4">
    {{ $items->links() }}
  </div>
@endif

<style>
  .feed-item img {
    height: 200px;
    width: auto;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    overflow: hidden;
  }
</style>
