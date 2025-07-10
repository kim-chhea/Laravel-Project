<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
class BookingServiceSeeder extends Seeder
{
    public function run()
    {
        $bookingServices = [
            ['booking_id' => 1, 'service_id' => 2, 'status' => 'confirmed', 'booking_date' => '2025-07-15', 'time_slot' => '14:00:00'],
            ['booking_id' => 1, 'service_id' => 3, 'status' => 'pending', 'booking_date' => '2025-07-15', 'time_slot' => '15:00:00'],
            ['booking_id' => 2, 'service_id' => 1, 'status' => 'cancelled', 'booking_date' => '2025-07-16', 'time_slot' => '10:00:00'],
            ['booking_id' => 3, 'service_id' => 4, 'status' => 'cancelled', 'booking_date' => '2025-07-17', 'time_slot' => '11:00:00'],
            ['booking_id' => 4, 'service_id' => 5, 'status' => 'pending', 'booking_date' => '2025-07-18', 'time_slot' => '13:00:00'],
            ['booking_id' => 5, 'service_id' => 6, 'status' => 'pending', 'booking_date' => '2025-07-19', 'time_slot' => '09:00:00'],
            ['booking_id' => 6, 'service_id' => 7, 'status' => 'pending', 'booking_date' => '2025-07-20', 'time_slot' => '16:00:00'],
            ['booking_id' => 7, 'service_id' => 8, 'status' => 'cancelled', 'booking_date' => '2025-07-21', 'time_slot' => '12:00:00'],
            ['booking_id' => 8, 'service_id' => 9, 'status' => 'cancelled', 'booking_date' => '2025-07-22', 'time_slot' => '14:30:00'],
            ['booking_id' => 9, 'service_id' => 10, 'status' => 'cancelled', 'booking_date' => '2025-07-23', 'time_slot' => '15:30:00'],
        ];

        foreach ($bookingServices as $bookingService) {
            DB::table('booking_services')->insert([
                'booking_id'   => $bookingService['booking_id'],
                'service_id'   => $bookingService['service_id'],
                'status'       => $bookingService['status'],
                'booking_date' => $bookingService['booking_date'],
                'time_slot'    => $bookingService['time_slot'],
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
