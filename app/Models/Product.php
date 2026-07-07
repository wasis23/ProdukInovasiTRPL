<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'youtube_url',
        'live_preview_url'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Accessor to get parsed YouTube embed URL.
     */
    public function getYoutubeEmbedUrlAttribute(): string
    {
        $url = $this->youtube_url;
        if (!$url) {
            return '';
        }

        $videoId = '';
        // Match YouTube video ID from various URL patterns (watch, share, shorts, embed)
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^"&?/ ]{11})%i', $url, $match)) {
            $videoId = $match[1];
        }

        return $videoId ? "https://www.youtube.com/embed/{$videoId}?autoplay=1&enablejsapi=1" : $url;
    }
}
