<?php

namespace Database\Seeders;

use App\Models\wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $wishlists = [
            ['user_id' => 1, 'service_id' => 3],
            ['user_id' => 2, 'service_id' => 5],
            ['user_id' => 3, 'service_id' => 2],
            ['user_id' => 4, 'service_id' => 7],
            ['user_id' => 5, 'service_id' => 1],
            ['user_id' => 6, 'service_id' => 4],
            ['user_id' => 7, 'service_id' => 8],
            ['user_id' => 8, 'service_id' => 6],
            ['user_id' => 9, 'service_id' => 10],
            ['user_id' => 10, 'service_id' => 9],
        ];

        foreach ($wishlists as $wishlist) {
            wishlist::create($wishlist);
        }
    }
}
