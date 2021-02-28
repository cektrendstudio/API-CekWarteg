<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
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
        $faker = Faker::create('id_ID');
        for($i = 0; $i < 4; $i++){
            DB::table('users')->insert([
                'username'  => $faker->unique()->userName,
                'password'  => Hash::make('123456'),
                'created_at'    => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
