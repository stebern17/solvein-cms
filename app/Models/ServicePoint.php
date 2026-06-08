<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePoint extends Model
{
    protected $table ='service_points';

    protected $fillable = [
        'service_id',
        'title',
        'order',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
