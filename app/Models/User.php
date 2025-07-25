<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'location_id',
    ];
    //relatioship of the user
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function review()
    {
        return $this->hasMany(review::class);
    }
    public function cart() {
        return $this->hasOne(cart::class);
    }
    public function wishlist()
    {
    return $this->hasOne(Wishlist::class);
    }
    public function booking()
    {
        return $this->hasMany(booking::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
