<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
    ];

    protected $casts = [
        'description' => 'array',
    ];

    public function points()
    {
        return $this->hasMany(ServicePoint::class);
    }
}
