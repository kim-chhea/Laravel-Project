<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name'];
    public function service()
    {
        return $this->belongsToMany(Service::class,'service_categories')->withTimestamps();
    }
}
