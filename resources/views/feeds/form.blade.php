<form method="POST" action="{{ $feed->id ? route('feeds.update', $feed) : route('feeds.store') }}">
	@csrf
	<!-- Start basic settings -->
	<h2 class="text-base font-semibold leading-7 text-gray-900">Feed Information</h2>
	<p class="mt-1 text-sm leading-6 text-gray-600 mb-8">Settings for fetching the RSS feed.</p>
	<div class="flex flex-col gap-8">
		<!-- Feed friendly name input -->
		<div class="max-w-2xl w-full">
			<label for="friendly_name" class="block text-sm font-medium leading-6 text-gray-900">Feed Name</label>
			<div class="mt-2">
				<input type="text" name="friendly_name" id="friendly_name"
					value="{{ old('friendly_name', $feed->friendly_name) }}"
					class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
					placeholder="Alex's blog RSS feed" aria-describedby="friendly_name-description">
			</div>
			<p class="mt-2 text-sm text-gray-500" id="friendly_name-description">Enter a name for this RSS feed.</p>
			@error('friendly_name')
				<div class="mt-2 text-sm text-red-600">{{ $message }}</div>
			@enderror
		</div>

		<!-- Feed URL input -->
		<div class="max-w-2xl w-full">
			<label for="url" class="block text-sm font-medium leading-6 text-gray-900">Link</label>
			<div class="mt-2">
				<input type="url" name="url" id="url" value="{{ old('url', $feed->url) }}"
					class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
					placeholder="https://alexwhite.fyi/blog/rss.xml" aria-describedby="url-description">
			</div>
			<p class="mt-2 text-sm text-gray-500" id="url-description">URL to the RSS feed.</p>
			@error('url')
				<div class="mt-2 text-sm text-red-600">{{ $message }}</div>
			@enderror
		</div>
	</div>
	<!-- End basic settings -->

	<!-- Start UI settings -->
	<h2 class="text-base font-semibold leading-7 text-gray-900 mt-16">UI Settings</h2>
	<p class="mt-1 text-sm leading-6 text-gray-600 mb-8">Customize how the feeed appears in FeederRSS.</p>
	<div class="flex flex-col gap-8">
		<!-- Show HTML -->
		<div class="relative flex items-start">
			<div class="flex h-6 items-center">
				<input id="setting_show_html" aria-describedby="setting_show_html-description" name="setting_show_html"
					value="1" {{ old('setting_show_html', $feed->setting_show_html) == 1 ? 'checked' : '' }}
					type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
			</div>
			<div class="ml-3 text-sm leading-6">
				<label for="setting_show_html" class="font-medium text-gray-900">Show HTML</label>
				<p id="setting_show_html-description" class="text-gray-500">If enabled, rich HTML content will be
					displayed.
					Otherwise, only text content will be shown.</p>
			</div>
		</div>
		<!-- Show Truncated -->
		<div class="relative flex items-start">
			<div class="flex h-6 items-center">
				<input id="setting_show_truncated" aria-describedby="setting_show_truncated-description"
					name="setting_show_truncated" value="1" {{ old('setting_show_truncated', $feed->setting_show_truncated) == 1 ? 'checked' : '' }} type="checkbox"
					class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
			</div>
			<div class="ml-3 text-sm leading-6">
				<label for="setting_show_truncated" class="font-medium text-gray-900">Trunacte Content</label>
				<p id="setting_show_truncated-description" class="text-gray-500">When enabled, content will be truncated
					to 3
					lines,
					providing a cleaner looking feed.</p>
			</div>
		</div>
	</div>
	<!-- End UI settings -->

	<div class="flex flex-row gap-4 mt-8">
		<button type="submit"
			class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $feed->id ? __('Update') : __('Add Feed') }}</button>
		<a href="{{ route('feeds.index') }}"
			class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cancel</a>
	</div>
</form>