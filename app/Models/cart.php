<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    //
    protected $fillable = ['user_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class,'cart_services')->withTimestamps()->withPivot('quantity');
    }
}
