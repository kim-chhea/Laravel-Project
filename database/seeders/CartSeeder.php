<?php

namespace Database\Seeders;

use App\Models\cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $carts = [
            ['user_id' => 1],
            ['user_id' => 2],
            ['user_id' => 3 ],
            ['user_id' => 4 ],
            ['user_id' => 5],
            ['user_id' => 6],
            ['user_id' => 7 ],
            ['user_id' => 8 ],
            ['user_id' => 9 ],
            ['user_id' => 10] ,
        ];

        foreach ($carts as $cart) {
            cart::create($cart);
        }
    }
}
