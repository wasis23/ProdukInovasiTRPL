<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['instagram_url', 'tiktok_url'];

    public static function getSolo()
    {
        return static::firstOrCreate(['id' => 1], [
            'instagram_url' => 'https://instagram.com/trpl_innovation',
            'tiktok_url' => 'https://tiktok.com/@trpl_innovation',
        ]);
    }
}
