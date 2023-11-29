<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
        ]);
        \App\Models\Product::factory(15)->create();
        // \App\Models\Order::factory(15)->create();
    }
}
