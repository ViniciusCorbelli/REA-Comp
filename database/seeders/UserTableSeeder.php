<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {
        $users = [
            [
                'first_name' => 'System',
                'last_name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'user_type' => User::USER_TYPE_ADMIN,
            ],
        ];
        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
