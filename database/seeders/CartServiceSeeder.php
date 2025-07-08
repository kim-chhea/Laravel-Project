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
            ['cart_id' => 1, 'service_id' => 2,"quantity" => 2],
            ['cart_id' => 1, 'service_id' => 3,"quantity" => 5],
            ['cart_id' => 2, 'service_id' => 4,"quantity" => 11],
            ['cart_id' => 3, 'service_id' => 1,"quantity" => 1],
            ['cart_id' => 4, 'service_id' => 5,"quantity" => 1],
            ['cart_id' => 5, 'service_id' => 6,"quantity" => 1],
            ['cart_id' => 6, 'service_id' => 7,"quantity" => 3],
            ['cart_id' => 7, 'service_id' => 8,"quantity" => 2],
            ['cart_id' => 8, 'service_id' => 9,"quantity" => 1],
            ['cart_id' => 9, 'service_id' => 10,"quantity" => 2,]
        ];

        foreach ($cartServices as $item) {
            cartService::create($item);
        }
    }
}
