<?php

namespace Database\Seeders;

use App\Models\serviceCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class serviceCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $serviceCategories = [
            ['category_id' => 1, 'service_id' => 1],
            ['category_id' => 2, 'service_id' => 2],
            ['category_id' => 3, 'service_id' => 3],
            ['category_id' => 1, 'service_id' => 4],
            ['category_id' => 4, 'service_id' => 5],
            ['category_id' => 2, 'service_id' => 6],
            ['category_id' => 5, 'service_id' => 7],
            ['category_id' => 3, 'service_id' => 8],
            ['category_id' => 4, 'service_id' => 9],
            ['category_id' => 5, 'service_id' => 10],
        ];

        foreach ($serviceCategories as $item) {
            serviceCategories::create($item);
        }
    }
}
