<?php

namespace Database\Seeders;

use App\Models\booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $bookings = [
            ['user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 10, 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($bookings as $booking) {
            booking::create($booking);
        }
    }
}
