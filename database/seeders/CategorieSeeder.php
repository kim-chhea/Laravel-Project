<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            ['name' => 'IT Services'],
            ['name' => 'Education'],
            ['name' => 'Entertainment'],
            ['name' => 'Food & Beverage'],
            ['name' => 'Healthcare'],
            ['name' => 'Transportation'],
            ['name' => 'Tourism'],
            ['name' => 'Home Services'],
            ['name' => 'Consulting'],
            ['name' => 'E-commerce'],
        ]);
    }
}
