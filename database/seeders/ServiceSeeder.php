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
            ['category_id' => 1, 'title' => 'Website Development', 'description' => 'Professional website building', 'price' => 500],
            ['category_id' => 2, 'title' => 'English Tutoring', 'description' => 'Online and offline English courses', 'price' => 150],
            ['category_id' => 3, 'title' => 'Event DJ Service', 'description' => 'Live DJ for events and weddings', 'price' => 300],
            ['category_id' => 4, 'title' => 'Catering Service', 'description' => 'Food and drinks for parties', 'price' => 200],
            ['category_id' => 5, 'title' => 'General Checkup', 'description' => 'Basic health check package', 'price' => 100],
            ['category_id' => 6, 'title' => 'Private Taxi', 'description' => 'Reliable private transport', 'price' => 50],
            ['category_id' => 7, 'title' => 'Angkor Wat Tour', 'description' => 'One day guided tour', 'price' => 120],
            ['category_id' => 8, 'title' => 'House Cleaning', 'description' => 'Full house cleaning service', 'price' => 80],
            ['category_id' => 9, 'title' => 'Business Consulting', 'description' => 'Small business growth strategies', 'price' => 250],
            ['category_id' => 10, 'title' => 'Product Listing', 'description' => 'Add products to your eCommerce site', 'price' => 75],
        ]);
    }
}
