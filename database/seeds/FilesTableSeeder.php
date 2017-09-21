<?php

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
            'path' => '/upload/1.png',
            'type' => 'image'
        ]);
        DB::table('files')->insert([
            'user_id' => 2,
            'path' => '/upload/2.png',
            'type' => 'image'
        ]);
        DB::table('files')->insert([
            'user_id' => 2,
            'path' => '/upload/3.png',
            'type' => 'image'
        ]);
        DB::table('files')->insert([
            'user_id' => 3,
            'path' => '/upload/4.png',
            'type' => 'image'
        ]);
    }
}
