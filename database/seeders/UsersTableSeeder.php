<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'name' => 'Administrator',
            'email' => env('USER_ADMIN'),
            'password' => bcrypt('m4k1an1234'),
            'email_verified_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
