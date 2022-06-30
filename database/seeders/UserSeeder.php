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
        User::create([
            'first_name' => 'Hieu',
            'last_name' => 'Le',
            'user_name' => 'hieukusok',
            'email' => 'admin01@gmail.com',
            'password' => 'hieukusok',
            'role' => 'owner',
            'actived' => true,

        ]);
        User::factory(50)->create();
    }
}
