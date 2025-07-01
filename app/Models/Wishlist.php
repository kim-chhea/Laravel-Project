<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    //
    public function service()
    {
        return $this->hasMany(Service::class);
    }
}
