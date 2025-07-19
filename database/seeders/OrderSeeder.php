<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('orders')->insert([
            ['user_id' => 1,'payment_id' => 1, 'status' => 'pending'],
            ['user_id' => 2,'payment_id' => 2, 'status' => 'paid'],
            ['user_id' => 3,'payment_id' => 3, 'status' => 'pending'],
            ['user_id' => 4,'payment_id' => 4, 'status' => 'pending'],
            ['user_id' => 5,'payment_id' => 5, 'status' => 'pending'],
            ['user_id' => 6,'payment_id' => 6, 'status' => 'pending'],
            ['user_id' => 7,'payment_id' => 7, 'status' => 'pending'],
            ['user_id' => 8,'payment_id' => 8, 'status' => 'paid'],
            ['user_id' => 9,'payment_id' => 9, 'status' => 'pending'],
            ['user_id' => 10,'payment_id' => 10, 'status' => 'pending'],
        ]);
        
    }
}
