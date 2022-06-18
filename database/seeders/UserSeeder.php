<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'first_name' => 'Hieu',
                'last_name' => 'Le',
                'user_name' => 'hieukusok',
                'email' => 'admin01@gmail.com',
                'password' => 'hieukusok',
                'role' => 'owner',
                'status' => 'active',
            ]
        ];

        foreach ($user as $user) {
            User::create($user);
        }
    }
}
