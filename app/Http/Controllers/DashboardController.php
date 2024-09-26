<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $items = DB::query()
            ->from('feed_items')
            ->join('feeds', 'feed_items.feed_id', '=', 'feeds.id')
            ->where('feeds.user_id', Auth::id())
            ->simplePaginate();

        return view('dashboard', [
            'items' => $items,
        ]);
    }
}
