<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    //
    public function service()
    {
        return $this->belongsToMany(Service::class,'cart_services')->withTimestamps();
    }
}
