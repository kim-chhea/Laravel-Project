<?php

namespace Database\Seeders;

use App\Models\serviceDiscount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceDiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $serviceDiscounts = [
            ['service_id' => 1, 'discount_id' => 3],
            ['service_id' => 2, 'discount_id' => 1],
            ['service_id' => 3, 'discount_id' => 5],
            ['service_id' => 4, 'discount_id' => 2],
            ['service_id' => 5, 'discount_id' => 4],
            ['service_id' => 6, 'discount_id' => 6],
            ['service_id' => 7, 'discount_id' => 8],
            ['service_id' => 8, 'discount_id' => 7],
            ['service_id' => 9, 'discount_id' => 9],
            ['service_id' => 10, 'discount_id' => 10],
        ];

        foreach ($serviceDiscounts as $item) {
            serviceDiscount::create($item);
        }
    }
}
