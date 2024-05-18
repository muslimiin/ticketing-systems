<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed model_has_roles
        DB::table('model_has_roles')->insert([
            'role_id' => 1, // role 1
            'model_type' => 'App\Models\User', // Jika menggunakan eloquent, gunakan nama kelas model
            'model_id' => 1, // user 1
            'user_id' => 1, // user 1
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 2, // role 2
            'model_type' => 'App\Models\User',
            'model_id' => 2, // user 2
            'user_id' => 2, // user 2
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 3, // role 3
            'model_type' => 'App\Models\User',
            'model_id' => 3, // user 3
            'user_id' => 3, // user 3
        ]);

        // Seed model_has_permissions (jika Anda memiliki permissions tertentu yang ingin disematkan ke user-role ini)
        // Misalnya, jika Anda memiliki ID izin tertentu yang ingin Anda sematkan, Anda dapat menyesuaikan query ini.
        // Contoh:
        DB::table('model_has_permissions')->insert([
            'permission_id' => 1, // ID permission
            'model_type' => 'App\Models\User',
            'model_id' => 1, // user 1
            'user_id' => 1, // user 1
        ]);
        DB::table('model_has_permissions')->insert([
            'permission_id' => 2, // ID permission
            'model_type' => 'App\Models\User',
            'model_id' => 2, // user 2
            'user_id' => 2, // user 2
        ]);
        DB::table('model_has_permissions')->insert([
            'permission_id' => 3, // ID permission
            'model_type' => 'App\Models\User',
            'model_id' => 3, // user 3
            'user_id' => 3, // user 3
        ]);
    }
}
