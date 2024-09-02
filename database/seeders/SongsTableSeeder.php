<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Song;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Song::create(
            [
                'title' => 'Bohemian Rhapsody',
                'singer' => 'Queen',
                'created_at' => '2022-11-23',
                'updated_at' => '2022-11-23'
            ]
        );

        Song::create(
            [
                'title' => 'A Sky Full of Stars',
                'singer' => 'Coldplay',
                'created_at' => '2022-11-23',
                'updated_at' => '2022-11-23'
            ]
        );

        Song::create(
            [
                'title' => 'Mamma Mia',
                'singer' => 'ABBA',
                'created_at' => '2022-11-23',
                'updated_at' => '2022-11-23'
            ]
        );

        Song::create(
            [
                'title' => 'Bones',
                'singer' => 'Imagine Dragons',
                'created_at' => '2022-11-23',
                'updated_at' => '2022-11-23'
            ]
        );

        Song::create(
            [
                'title' => 'Master of Puppets',
                'singer' => 'Metallica',
                'created_at' => '2022-11-23',
                'updated_at' => '2022-11-23'
            ]
        );
    }
}
