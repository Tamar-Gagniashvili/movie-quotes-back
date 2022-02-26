<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Quote;
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
        Movie::factory(10)->create();

        foreach (Movie::all() as $movie) {
            Quote::factory(5)->create(['movie_id'=> $movie->id]);
        }
    }
}
