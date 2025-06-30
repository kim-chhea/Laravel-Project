<?php

namespace Database\Seeders;

use App\Models\booking;
use App\Models\bookingService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $bookingServices = [
            ['booking_id' => 1, 'service_id' => 2],
            ['booking_id' => 1, 'service_id' => 3],
            ['booking_id' => 2, 'service_id' => 1],
            ['booking_id' => 3, 'service_id' => 4],
            ['booking_id' => 4, 'service_id' => 5],
            ['booking_id' => 5, 'service_id' => 6],
            ['booking_id' => 6, 'service_id' => 7],
            ['booking_id' => 7, 'service_id' => 8],
            ['booking_id' => 8, 'service_id' => 9],
            ['booking_id' => 9, 'service_id' => 10],
        ];

        foreach ($bookingServices as $item) {
            bookingService::create($item);
        }
    }
}
