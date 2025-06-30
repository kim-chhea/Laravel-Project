<?php

namespace Database\Seeders;

use App\Models\cartService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $cartServices = [
            ['cart_id' => 1, 'service_id' => 2],
            ['cart_id' => 1, 'service_id' => 3],
            ['cart_id' => 2, 'service_id' => 4],
            ['cart_id' => 3, 'service_id' => 1],
            ['cart_id' => 4, 'service_id' => 5],
            ['cart_id' => 5, 'service_id' => 6],
            ['cart_id' => 6, 'service_id' => 7],
            ['cart_id' => 7, 'service_id' => 8],
            ['cart_id' => 8, 'service_id' => 9],
            ['cart_id' => 9, 'service_id' => 10],
        ];

        foreach ($cartServices as $item) {
            cartService::create($item);
        }
    }
}
