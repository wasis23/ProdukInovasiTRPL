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
     * Accessor to get parsed video embed URL (YouTube or TikTok).
     */
    public function getVideoEmbedUrlAttribute(): string
    {
        $url = $this->youtube_url;
        if (!$url) {
            return '';
        }

        // Check if TikTok
        if (stripos($url, 'tiktok.com') !== false) {
            // Check for vm/vt/v short links
            if (preg_match('/(?:vm|vt|v)\.tiktok\.com\/([A-Za-z0-9]+)/i', $url, $match)) {
                $cacheKey = 'tiktok_resolved_' . md5($url);
                $resolvedUrl = cache()->remember($cacheKey, now()->addDays(30), function () use ($url) {
                    try {
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_HEADER, true);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_NOBODY, true);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
                        curl_exec($ch);
                        $redirectUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
                        curl_close($ch);
                        return $redirectUrl ?: $url;
                    } catch (\Exception $e) {
                        return $url;
                    }
                });
                $url = $resolvedUrl;
            }

            // Extract TikTok video ID
            if (preg_match('/\/video\/(\d+)/i', $url, $match)) {
                return "https://www.tiktok.com/embed/v2/" . $match[1];
            }
            if (preg_match('/\/v\/(\d+)/i', $url, $match)) {
                return "https://www.tiktok.com/embed/v2/" . $match[1];
            }
            return $url;
        }

        $videoId = '';
        // Match YouTube video ID from various URL patterns (watch, share, shorts, embed)
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^"&?/ ]{11})%i', $url, $match)) {
            $videoId = $match[1];
        }

        return $videoId ? "https://www.youtube.com/embed/{$videoId}?autoplay=1&enablejsapi=1" : $url;
    }

    /**
     * Accessor to get parsed YouTube embed URL (compatibility).
     */
    public function getYoutubeEmbedUrlAttribute(): string
    {
        return $this->video_embed_url;
    }
}
