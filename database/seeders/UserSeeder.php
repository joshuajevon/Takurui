<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'user',
            'email'=> 'user@example.com',
            'password' =>bcrypt('user1234'),
            'phoneNumber' => '+6281234567890',
            'dob' => '2000-02-24',
            'gender'=> 'male',
            'address' => 'jl.kemanggisan',
            'isAdmin'=> false,
        ]);
    }
}
