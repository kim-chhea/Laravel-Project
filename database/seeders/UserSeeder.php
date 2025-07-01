<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 

        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 1,
                'location_id' => 1,
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2,
                'location_id' => 2,
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 1,
                'location_id' => 3,
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2,
                'location_id' => 4,
            ],
            [
                'name' => 'Robert Brown',
                'email' => 'robert@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 3,
                'location_id' => 4,
            ],
            [
                'name' => 'Linda White',
                'email' => 'linda@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 1,
                'location_id' => 5,
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2,
                'location_id' => 6,
            ],
            [
                'name' => 'Susan Taylor',
                'email' => 'susan@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 3,
                'location_id' => 7,
            ],
            [
                'name' => 'James Anderson',
                'email' => 'james@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 1,
                'location_id' => 8,
            ],
            [
                'name' => 'Karen Thomas',
                'email' => 'karen@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2,
                'location_id' => 9,
            ],
        ];
        
        foreach ($users as $user)
        {
            User::create($user);
        }
    }
}
