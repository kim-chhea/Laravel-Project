<?php

namespace Database\Seeders;

use App\Models\review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $reviews = [
            [
                'user_id' => 1,
                'service_id' => 1,
                'comment' => 'Excellent service, very satisfied!',
                'rating' => 5,
            ],
            [
                'user_id' => 2,
                'service_id' => 2,
                'comment' => 'Good experience, would recommend.',
                'rating' => 4,
            ],
            [
                'user_id' => 3,
                'service_id' => 3,
                'comment' => 'Average quality, can improve.',
                'rating' => 3,
            ],
            [
                'user_id' => 4,
                'service_id' => 4,
                'comment' => 'Fast and friendly service!',
                'rating' => 5,
            ],
            [
                'user_id' => 5,
                'service_id' => 5,
                'comment' => 'Not satisfied with the result.',
                'rating' => 2,
            ],
            [
                'user_id' => 6,
                'service_id' => 6,
                'comment' => 'Affordable and reliable.',
                'rating' => 4,
            ],
            [
                'user_id' => 7,
                'service_id' => 7,
                'comment' => 'Great customer support!',
                'rating' => 5,
            ],
            [
                'user_id' => 8,
                'service_id' => 8,
                'comment' => 'Below expectations.',
                'rating' => 2,
            ],
            [
                'user_id' => 9,
                'service_id' => 9,
                'comment' => 'Decent service for the price.',
                'rating' => 3,
            ],
            [
                'user_id' => 10,
                'service_id' => 10,
                'comment' => 'Highly recommended!',
                'rating' => 5,
            ],
        ];

        foreach ($reviews as $review) {
            review::create($review);
        }
    }
}
