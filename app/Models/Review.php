<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    //
    protected $fillable = ["user_id", "service_id","comment", "rating"];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
