<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'userA',
                'email' => 'usera@example.com',
                'password' => Hash::make('12345678'),
                'currency' => 'USD',
                'balance' => 100
            ],
            [
                'name' => 'userB',
                'email' => 'userb@example.com',
                'password' => Hash::make('12345678'),
                'currency' => 'EUR',
                'balance' => 100
            ],
            [
                'name' => 'userC',
                'email' => 'userc@example.com',
                'password' => Hash::make('12345678'),
                'currency' => 'BDT',
                'balance' => 100
            ]
        ];
        foreach ($users as $user){
            User::create($user);
        }

    }
}
