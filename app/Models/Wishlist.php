<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    //
    protected $fillable = ['user_id'];
    public function services()
    {
        return $this->belongsToMany(Service::class, 'wishlist_services')->withTimestamps();
    }
    
    public function user()
{
    return $this->belongsTo(User::class);
}
}
