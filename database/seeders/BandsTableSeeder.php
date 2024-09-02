<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Band;

class BandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Band::create(
            [
                'name' => 'Queen',
                'genre' => 'Rock',
                'founded' => '1970',
                'created_at' => '2022-11-23',
                'updated_at' => '2022-11-23'
            ]
        );

        Band::create(
            [
                'name' => 'Coldplay',
                'genre' => 'Indie',
                'founded' => '1996',
                'created_at' => '2022-11-23',
                'updated_at' => '2022-11-23'
            ]
        );

        Band::create(
            [
                'name' => 'ABBA',
                'genre' => 'Pop',
                'founded' => '1972',
                'created_at' => '2022-11-23',
                'updated_at' => '2022-11-23'
            ]
        );

        Band::create(
            [
                'name' => 'Imagine Dragons',
                'genre' => 'Pop',
                'founded' => '2008',
                'created_at' => '2022-11-23',
                'updated_at' => '2022-11-23'
            ]
        );

        Band::create(
            [
                'name' => 'Metallica',
                'genre' => 'Heavy Metal',
                'founded' => '1981',
                'created_at' => '2022-11-23',
                'updated_at' => '2022-11-23'
            ]
        );
    }
}
