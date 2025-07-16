<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['user_id','total_price','status','payment_id'];
    public function service()
    {
        return $this->belongsToMany(Service::class , 'order_services')->withTimestamps();
    }
    public function payment()
    {
        return $this->belongsTo(payment::class);
    }
}
