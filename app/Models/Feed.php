<?php

namespace App\Models;

use Carbon\Carbon;
use Feed as FeedParser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feed extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'friendly_name',
        'url',
        'last_fetched',
        'setting_show_truncated',
        'setting_show_html',
        'feed_name',
        'feed_description',
        'feed_image'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function feedItems(): HasMany
    {
        return $this->hasMany(FeedItem::class)->orderBy('pub_date', 'desc');
    }

    public function parseFeed(): void
    {
        $rss = FeedParser::loadRss($this->url);
        $latestItem = $this->feedItems()->latest('pub_date')->first();
        $this->update(['last_fetched' => now()]);
        $this->update(['feed_name' => $rss->title]);
        $this->update(['feed_description' => $rss->description]);
        $this->update(['feed_image' => $rss->image->url]);


        foreach ($rss->item as $item) {
            if ($latestItem && Carbon::parse($item->pubDate) <= Carbon::parse($latestItem->pub_date)) {
                break;
            }
            $this->feedItems()->create([
                'title' => $item->title,
                'link' => $item->link,
                'pub_date' => Carbon::parse($item->pubDate),
                'description' => $item->description,
                'content' => $item->children('dc', true)->encoded,
                'creator' => $item->children('dc', true)->creator,
            ]);
        }
    }
}
