<?php

namespace Database\Seeders;

use App\Models\orderService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $orderServices = [
            ['order_id' => 1, 'service_id' => 3],
            ['order_id' => 1, 'service_id' => 5],
            ['order_id' => 2, 'service_id' => 1],
            ['order_id' => 3, 'service_id' => 2],
            ['order_id' => 4, 'service_id' => 4],
            ['order_id' => 5, 'service_id' => 7],
            ['order_id' => 6, 'service_id' => 6],
            ['order_id' => 7, 'service_id' => 8],
            ['order_id' => 8, 'service_id' => 9],
            ['order_id' => 9, 'service_id' => 10],
        ];

        foreach ($orderServices as $orderService) {
            orderService::create($orderService);
        }
    }
}
