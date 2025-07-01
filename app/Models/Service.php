<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    public function order()
    {
        return $this->belongsToMany(Service::class , 'order_services')->withTimestamps();
    }
    public function discount()
    {
        return $this->belongsToMany(discount::class , 'service_discount')->withTimestamps();
    }
    public function category()
    {
        return $this->belongsToMany(Category::class,'service_categories')->withTimestamps();
    }
    public function wishlist()
    {
        return $this->belongsTo(wishlist::class);
    }
    public function booking()
    {
        return $this->belongsToMany(booking::class,'booking_services')->withTimestamps();

    }
    public function cart()
    {
        return $this->belongsToMany(cart::class,'cart_services')->withTimestamps();
    }

}
