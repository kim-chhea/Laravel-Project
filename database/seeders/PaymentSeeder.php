<?php

namespace Database\Seeders;

use App\Models\payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $payments = [
            ['order_id' => 1, 'price' => 500, 'status' => 'paid'],
            ['order_id' => 2, 'price' => 150, 'status' => 'pending'],
            ['order_id' => 3, 'price' => 300, 'status' => 'paid'],
            ['order_id' => 4, 'price' => 200, 'status' => 'failed'],
            ['order_id' => 5, 'price' => 100, 'status' => 'paid'],
            ['order_id' => 6, 'price' => 50,  'status' => 'pending'],
            ['order_id' => 7, 'price' => 120, 'status' => 'paid'],
            ['order_id' => 8, 'price' => 80,  'status' => 'failed'],
            ['order_id' => 9, 'price' => 250, 'status' => 'pending'],
            ['order_id' => 10, 'price' => 75,  'status' => 'paid'],
        ];

        foreach ($payments as $payment) {
            payment::create($payment);
        }
    }
}
