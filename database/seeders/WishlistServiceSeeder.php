<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        $wishlistServices = [
            ['wishlist_id' => 1, 'service_id' => 1],
            ['wishlist_id' => 1, 'service_id' => 2],
            ['wishlist_id' => 2, 'service_id' => 1],
            ['wishlist_id' => 2, 'service_id' => 3],
            ['wishlist_id' => 3, 'service_id' => 2],
            ['wishlist_id' => 3, 'service_id' => 4],
            ['wishlist_id' => 4, 'service_id' => 1],
            ['wishlist_id' => 5, 'service_id' => 3],
            ['wishlist_id' => 6, 'service_id' => 2],
            ['wishlist_id' => 7, 'service_id' => 4],
        ];

        DB::table('wishlist_services')->insert($wishlistServices);
    }
    }

