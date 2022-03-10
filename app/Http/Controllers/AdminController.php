<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditMovieRequest;
use App\Http\Requests\EditQuoteRequest;
use App\Http\Requests\MovieFormRequest;
use App\Http\Requests\QuoteFormRequest;
use App\Models\Movie;
use App\Models\Quote;

class AdminController extends Controller
{
    public function addMovie(MovieFormRequest $request, Movie $movie)
    {
        $movie = new Movie();
        $movie->setTranslations('name', $request->input('name'));
        $movie->slug = $request->slug;
        $movie->save();

        return $movie;
    }

    public function getMovies()
    {
        return Movie::latest('updated_at')->get();
    }

    public function updateMovie($id, EditMovieRequest $request)
    {
        $attributes = $request->validated();

        $movie = Movie::find($id)->update($attributes);
        return ["result"=> $movie ? 'The Movie has been updated' : "operation failed"];
    }

    public function deleteMovie($id)
    {
        $movie = Movie::destroy($id);
        Quote::where('movie_id', $id)->delete();
        return ["result"=> $movie ? 'The Movie has been deleted' : "operation failed"];
    }

    public function editMovie($id)
    {
        return Movie::find($id);
    }

    public function getQuotes()
    {
        return Quote::with('movie')->latest('updated_at')->get();
    }

    public function addQuote(QuoteFormRequest $request)
    {
        $quote = new Quote();
        $quote->setTranslations('text', $request->input('text'));
        $quote->movie_id = $request->movie_id;
        $quote->thumbnail = $request->file('thumbnail')->store('thumbnails');
        $quote->save();

        return $quote;
    }

    public function deleteQuote($id)
    {
        $quote = Quote::destroy($id);
        return ["result"=> $quote ? 'The Quote has been deleted' : "operation failed"];
    }

    public function editQuote($id)
    {
        return Quote::find($id);
    }


    public function updateQuote($id, EditQuoteRequest $request)
    {
        $attributes = $request->validated();

        if (isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }
        
        $quote = Quote::find($id)->update($attributes);
        return ["result"=> $quote ? 'The Quote has been updated' : "operation failed"];
    }
}
