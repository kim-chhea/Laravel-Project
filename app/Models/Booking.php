<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Testing\FileFactory;
// use Symfony\Component\HttpFoundation\FileBag;

class booking extends Model
{
    // 
    protected $fillable = ['user_id'];
    public function services()
    {
        return $this->belongsToMany(Service::class,'booking_services')->withTimestamps()->withPivot(['booking_date', 'time_slot', 'status']);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
