<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        DB::table('admin_users')->insert([
            [
                'login_id' => 'admin',
                'password_hash' => Hash::make('admin1234'),
                'name' => '運営管理者',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
