<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('locations')->insert([
            ['address' => '123 Main St', 'city' => 'Phnom Penh'],
            ['address' => '456 Riverside Blvd', 'city' => 'Siem Reap'],
            ['address' => '789 Mekong Rd', 'city' => 'Battambang'],
            ['address' => '12 Angkor Ave', 'city' => 'Siem Reap'],
            ['address' => '34 Independence Blvd', 'city' => 'Phnom Penh'],
            ['address' => '56 Victory St', 'city' => 'Sihanoukville'],
            ['address' => '78 National Hwy', 'city' => 'Kampot'],
            ['address' => '90 Street 63', 'city' => 'Phnom Penh'],
            ['address' => '101 Pub Street', 'city' => 'Siem Reap'],
            ['address' => '202 Royal Palace Rd', 'city' => 'Phnom Penh'],
        ]);
    }
}
