<div>
  <dl class="divide-y divide-gray-100 dark:divide-gray-600">
    <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
      <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-50">Feed name</dt>
      <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
        {{ $feed->feed_name ?? $feed->friendly_name }}
      </dd>
    </div>
    <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
      <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-50">Last fetched</dt>
      <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
        {{ \Carbon\Carbon::parse($feed->last_fetched)->diffForHumans() }}
      </dd>
    </div>
    <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
      <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-50">URL</dt>
      <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">{{ $feed->url }}</dd>
    </div>
    <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
      <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-50">Description</dt>
      <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
        {{ $feed->feed_description ?? __('Not Available') }}
      </dd>
    </div>
  </dl>
</div>
