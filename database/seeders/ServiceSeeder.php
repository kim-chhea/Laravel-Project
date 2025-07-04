<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('services')->insert([
            ['title' => 'Website Development', 'description' => 'Professional website building', 'price' => 500],
            ['title' => 'English Tutoring', 'description' => 'Online and offline English courses', 'price' => 150],
            ['title' => 'Event DJ Service', 'description' => 'Live DJ for events and weddings', 'price' => 300],
            ['title' => 'Catering Service', 'description' => 'Food and drinks for parties', 'price' => 200],
            ['title' => 'General Checkup', 'description' => 'Basic health check package', 'price' => 100],
            ['title' => 'Private Taxi', 'description' => 'Reliable private transport', 'price' => 50],
            ['title' => 'Angkor Wat Tour', 'description' => 'One day guided tour', 'price' => 120],
            ['title' => 'House Cleaning', 'description' => 'Full house cleaning service', 'price' => 80],
            ['title' => 'Business Consulting', 'description' => 'Small business growth strategies', 'price' => 250],
            [ 'title' => 'Product Listing', 'description' => 'Add products to your eCommerce site', 'price' => 75],
        ]);
    }
}
