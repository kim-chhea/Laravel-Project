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
            ['user_id' => 1, 'status' => 'pending'],
            ['user_id' => 2, 'status' => 'processing'],
            ['user_id' => 3, 'status' => 'completed'],
            ['user_id' => 4, 'status' => 'pending'],
            ['user_id' => 5, 'status' => 'completed'],
            ['user_id' => 6, 'status' => 'cancelled'],
            ['user_id' => 7, 'status' => 'pending'],
            ['user_id' => 8, 'status' => 'processing'],
            ['user_id' => 9, 'status' => 'completed'],
            ['user_id' => 10, 'status' => 'pending'],
        ]);
    }
}
