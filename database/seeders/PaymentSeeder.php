<?php

namespace Database\Seeders;

use App\Models\payment;
use Illuminate\Support\Str;
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
            ['booking_id' => 1, 'price' => 500.00, 'status' => 'paid',    'payment_method' => 'PayWay', 'transaction_id' => 'TXN-' . strtoupper(Str::random(10))],
            ['booking_id' => 2, 'price' => 150.00, 'status' => 'pending', 'payment_method' => 'ABA',    'transaction_id' => 'TXN-' . strtoupper(Str::random(10))],
            ['booking_id' => 3, 'price' => 300.00, 'status' => 'paid',    'payment_method' => 'Wing',   'transaction_id' => 'TXN-' . strtoupper(Str::random(10))],
            ['booking_id' => 4, 'price' => 200.00, 'status' => 'failed',  'payment_method' => 'Wing',   'transaction_id' => 'TXN-' . strtoupper(Str::random(10))],
            ['booking_id' => 5, 'price' => 100.00, 'status' => 'paid',    'payment_method' => 'ABA',    'transaction_id' => 'TXN-' . strtoupper(Str::random(10))],
            ['booking_id' => 6, 'price' => 50.00,  'status' => 'pending', 'payment_method' => 'PayWay', 'transaction_id' => 'TXN-' . strtoupper(Str::random(10))],
            ['booking_id' => 7, 'price' => 120.00, 'status' => 'paid',    'payment_method' => 'ABA',    'transaction_id' => 'TXN-' . strtoupper(Str::random(10))],
            ['booking_id' => 8, 'price' => 80.00,  'status' => 'failed',  'payment_method' => 'Wing',   'transaction_id' => 'TXN-' . strtoupper(Str::random(10))],
            ['booking_id' => 9, 'price' => 250.00, 'status' => 'pending', 'payment_method' => 'PayWay', 'transaction_id' => 'TXN-' . strtoupper(Str::random(10))],
            ['booking_id' => 10,'price' => 75.00,  'status' => 'paid',    'payment_method' => 'ABA',    'transaction_id' => 'TXN-' . strtoupper(Str::random(10))],
        ];

        foreach ($payments as $payment) {
            payment::create($payment);
        }
    }
}
