<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedRequest;
use App\Http\Requests\UpdateFeedRequest;
use App\Jobs\ParseFeed;
use App\Models\Feed;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feeds = Auth::user()->feeds;

        return view('feeds.index', [
            'feeds' => $feeds,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feeds.create', [
            'feed' => new Feed,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedRequest $request)
    {
        $validated = $request->safe()->only(['friendly_name', 'url', 'setting_show_html', 'setting_show_truncated']);

        $validated['setting_show_html'] = $request->boolean('setting_show_html');
        $validated['setting_show_truncated'] = $request->boolean('setting_show_truncated');

        $feed = Auth::user()->feeds()->create($validated);

        ParseFeed::dispatch($feed);

        return redirect('/feeds');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feed $feed)
    {
        return view('feeds.show', [
            'feed' => $feed,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feed $feed)
    {
        return view('feeds.edit', [
            'feed' => $feed,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedRequest $request, Feed $feed)
    {
        $validated = $request->safe()->only(['friendly_name', 'url', 'setting_show_html', 'setting_show_truncated']);

        $validated['setting_show_html'] = $request->boolean('setting_show_html');
        $validated['setting_show_truncated'] = $request->boolean('setting_show_truncated');

        $feed->update($validated);

        return redirect(route('feeds.show', $feed));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feed $feed)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function parse(Feed $feed)
    {
        ParseFeed::dispatchSync($feed);

        return view('feedItems.list', [
            'items' => $feed->feedItems()->simplePaginate(10),
            'feed' => $feed,
        ]);
    }
}
