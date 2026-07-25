<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    protected $fillable = [
        'image_path',
        'focus_x',
        'focus_y',
        'title',
        'description'
    ];
}
