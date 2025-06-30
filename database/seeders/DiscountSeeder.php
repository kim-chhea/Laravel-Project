<?php

namespace Database\Seeders;

use App\Models\discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
            $discounts = [
                [
                    'title' => 'New Year Sale',
                    'descriptions' => 'Get 20% off all services for the New Year.',
                    'percentage' => 20,
                ],
                [
                    'title' => 'Holiday Special',
                    'descriptions' => 'Enjoy 15% off during holiday seasons.',
                    'percentage' => 15,
                ],
                [
                    'title' => 'First-Time Customer',
                    'descriptions' => '10% off for your first booking with us.',
                    'percentage' => 10,
                ],
                [
                    'title' => 'Flash Sale',
                    'descriptions' => 'Limited time offer: 25% off selected services.',
                    'percentage' => 25,
                ],
                [
                    'title' => 'Referral Bonus',
                    'descriptions' => 'Refer a friend and get 5% off your next order.',
                    'percentage' => 5,
                ],
                [
                    'title' => 'Summer Promo',
                    'descriptions' => 'Beat the heat with 30% off on tours.',
                    'percentage' => 30,
                ],
                [
                    'title' => 'Festival Discount',
                    'descriptions' => 'Celebrate with 12% off on event services.',
                    'percentage' => 12,
                ],
                [
                    'title' => 'Student Discount',
                    'descriptions' => 'Special 10% off for students with valid ID.',
                    'percentage' => 10,
                ],
                [
                    'title' => 'Weekend Deal',
                    'descriptions' => '20% off for weekend bookings only.',
                    'percentage' => 20,
                ],
                [
                    'title' => 'Loyalty Reward',
                    'descriptions' => 'Earn 18% off after 5 completed orders.',
                    'percentage' => 18,
                ],
            ];
    
            foreach ($discounts as $discount) {
                discount::create($discount);
            }
    }
}
