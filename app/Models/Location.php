<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $fillable = ['address' ,'city' ,'postal_code'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
