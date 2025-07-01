<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    //
    public function service()
    {
        return $this->belongsToMany(Service::class,'booking_services')->withTimestamps();
    }
}
