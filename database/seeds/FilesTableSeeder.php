<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('files')->insert([
            'user_id' => 1,
            'path' => '/upload/1.jpg',
            'original_name' => '1.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('files')->insert([
            'user_id' => 2,
            'path' => '/upload/2.jpg',
            'original_name' => '2.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('files')->insert([
            'user_id' => 2,
            'path' => '/upload/3.jpg',
            'original_name' => '3.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('files')->insert([
            'user_id' => 3,
            'path' => '/upload/4.jpg',
            'original_name' => '4.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
