<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class discount extends Model
{
    //
    protected $fillable = ['title' , 'dscriptions' , 'percentage'];

    public function service()
    {
        return $this->belongsToMany(Service::class ,'service_discount')->withTimestamps();
    }    
} 
