<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatWeDo extends Model
{
    protected $fillable = [
        'title_1',
        'image_1',
        'description_1',
        'title_2',
        'image_2',
        'description_2',
        'title_3',
        'image_3',
        'description_3',
    ];

    protected $casts = [
        'description_1' => 'array',
        'description_2' => 'array',
        'description_3' => 'array',
    ];
    
}
