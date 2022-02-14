<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditMovieRequest;
use App\Http\Requests\MovieFormRequest;
use App\Http\Requests\QuoteFormRequest;
use App\Models\Movie;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function showMovies()
    {
        return Movie::all();
    }

    public function updateMovie($id, EditMovieRequest $request)
    {
        $attributes = $request->validated();

        $movie = movie::find($id)->update($attributes);
        if ($movie) {
            return ["result"=>'The movie has been updated'];
        } else {
            return ["result"=> "operation failed"];
        }
    }

    public function deleteMovie($id)
    {
        // $movie = Movie::find($id);
        // Quote::where('movie_id', $movie->id)->delete();
        // $movie->delete();
        // return;
        $movie = Movie::where('id', $id)->delete();
        if ($movie) {
            return ["result"=> "Movie has been deleted"];
        } else {
            return ["result"=> "operation failed"];
        }
    }

    public function editMovie($id)
    {
        return Movie::find($id);
    }

    // public function addQuote(QuoteFormRequest $request)
    // {
    //     $quote = new Quote();
    //     $quote->setTranslations('text', $request->input('text'));
    //     $quote->movie_id = $request->movie_id;
    //     $quote->thumbnail = request()->input('thumbnail')->store('thumbnails');
    //     $quote->save();

    //     return $quote;
    // }

    public function addQuote(Request $request, QuoteFormRequest $req)
    {
        $quote = new Quote();
        $quote->setTranslations('text', $req->input('text'));
        $quote->movie_id = $req->movie_id;
        // $quote->thumbnail = $req->file('thumbnail')->store('thumbnails');
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = $file->getClientOriginalName();
            $finalName = date('His') . $filename;

            $request->file('thumbnail')->storeAs('images/', $finalName, 'public');
            return response()->json(['message' => 'Successfully upload an image']);
        } else {
            return response()->json(['message'=>'You must select the image first']);
        }
        $quote->save();

        return $quote;
    }

    public function showQuotes()
    {
        return Quote::all();
    }
}
