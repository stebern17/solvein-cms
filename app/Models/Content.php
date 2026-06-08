<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Content extends Model
{
    protected $table = 'content';

    protected $fillable = [
        'hero_section',
        'about_solvein',
    ];

    protected $casts = [
        'hero_section' => 'array',
        'about_solvein' => 'array',
    ];    
}
