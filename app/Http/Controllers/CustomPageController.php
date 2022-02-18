<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Quote;

class CustomPageController extends Controller
{
    public function getQuote()
    {
        return Quote::with('movie')->get()->random(1);
    }

    public function getQuotes($id)
    {
        $movie = Quote::where('movie_id', $id)->with('movie')->get();

        return $movie;
    }
}
