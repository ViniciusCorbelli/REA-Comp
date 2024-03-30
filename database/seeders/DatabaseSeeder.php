<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        
        \App\Models\User::factory(50)->create();
        \App\Models\Topic::factory(50)->create();
        \App\Models\Type::factory(50)->create();
        \App\Models\Repository::factory(50)->create();
        \App\Models\Visit::factory(50)->create();
        \App\Models\Comment::factory(50)->create();
        \App\Models\FavorityComment::factory(50)->create();
        \App\Models\Link::factory(50)->create();
        \App\Models\Rate::factory(50)->create();
    }
}
