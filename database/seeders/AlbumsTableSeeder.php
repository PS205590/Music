<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Album;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Album::create(
            [
                'name' => 'Night at the Opera',
                'year' => '1975',
                'times_sold' => '6000000',
            ]
        );

        Album::create(
            [
                'name' => 'Parachutes',
                'year' => '2000',
                'times_sold' => '13000000',
            ]
        );

        Album::create(
            [
                'name' => 'Waterloo',
                'year' => '1974',
                'times_sold' => '5000000',
            ]
        );

        Album::create(
            [
                'name' => 'Evolve',
                'year' => '2017',
                'times_sold' => '5000000',
            ]
        );

        Album::create(
            [
                'name' => 'Master of Puppets',
                'year' => '1986',
                'times_sold' => '6000000',
            ]
        );
    }
}
