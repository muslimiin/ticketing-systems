<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::where('username', 'superadmin')->first();

        if (is_null($admin)) {
            Admin::create([
                'name' => "Super Admin",
                'email' => "superadmin@gmail.com",
                'username' => "superadmin",
                'password' => Hash::make('secret'),
            ]);
        }

        $admin = Admin::where('username', 'admin')->first();

        if (is_null($admin)) {
            Admin::create([
                'name' => "Admin",
                'email' => "admin@gmail.com",
                'username' => "admin",
                'password' => Hash::make('secret'),
            ]);
        }

        $admin = Admin::where('username', 'cashier')->first();

        if (is_null($admin)) {
            Admin::create([
                'name' => "Cashier",
                'email' => "cashier@gmail.com",
                'username' => "cashier",
                'password' => Hash::make('secret'),
            ]);
        }
    }
}
