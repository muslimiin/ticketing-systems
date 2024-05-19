<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'muslimink96@gmail.com')->first(); // Perbaiki email

        if (is_null($user)) {
            User::create([
                'name' => "Muslimin",
                'email' => "muslimink96@gmail.com",
                'password' => Hash::make('secret'),
            ]);
        }

        $user = User::where('email', 'cashier@gmail.com')->first();

        if (is_null($user)) {
            User::create([
                'name' => "Cashier",
                'email' => "cashier@gmail.com",
                'password' => Hash::make('secret'),
            ]);
        }
    }
}
