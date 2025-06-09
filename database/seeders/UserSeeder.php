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
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2,
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 1,
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2,
            ],
            [
                'name' => 'Robert Brown',
                'email' => 'robert@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 3,
            ],
            [
                'name' => 'Linda White',
                'email' => 'linda@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 1,
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2,
            ],
            [
                'name' => 'Susan Taylor',
                'email' => 'susan@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 3,
            ],
            [
                'name' => 'James Anderson',
                'email' => 'james@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 1,
            ],
            [
                'name' => 'Karen Thomas',
                'email' => 'karen@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2,
            ],
        ];
        
        foreach ($users as $user)
        {
            User::create($user);
        }
    }
}
