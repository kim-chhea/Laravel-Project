<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    // 
    protected $fillable = ['booking_id','price','payment_method','transaction_id','status'];
    public function booking()
    {
        return $this->belongsTo(booking::class);
    }
}
