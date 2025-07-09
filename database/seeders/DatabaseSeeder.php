<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Whoops\Run;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
           RoleSeeder::class,
           LocationSeeder::class,
           UserSeeder::class,
           CategorieSeeder::class,
           ServiceSeeder::class,
           OrderSeeder::class,
           BookingSeeder::class,
           DiscountSeeder::class,
           CartSeeder::class,
           ReviewSeeder::class,
           PaymentSeeder::class,
          WishlistSeeder::class,
          OrderServiceSeeder::class,
          serviceCategoriesSeeder::class,
          ServiceDiscountSeeder::class,
          BookingServiceSeeder::class,
          CartServiceSeeder::class,
          WishlistServiceSeeder::class

       ]);
    }
}
