<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'nagibator777',
            'email' => 'nagibator777@gmail.com',
            'password' => bcrypt('sosecret'),
        ]);
        DB::table('users')->insert([
            'name' => 'nagibator666',
            'email' => 'nagibator666@gmail.com',
            'password' => bcrypt('sosecret'),
        ]);
        DB::table('users')->insert([
            'name' => 'nagibator555',
            'email' => 'nagibator555@gmail.com',
            'password' => bcrypt('sosecret'),
        ]);
        DB::table('users')->insert([
            'name' => 'nagibator333',
            'email' => 'nagibator333@gmail.com',
            'password' => bcrypt('sosecret'),
        ]);
    }
}
