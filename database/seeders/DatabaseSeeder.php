<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call([
            UserTableSeeder::class,
        ]);
        \App\Models\User::factory(40)->create();
        \App\Models\UserProfile::factory(43)->create();
        \App\Models\Topic::factory(50)->create();
    }
}
