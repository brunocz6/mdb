<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MovieRating;
use Auth;

class MovieRatingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check())
        {
            $userId = Auth::id();
        }

        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'movie_id' => 'required',
            'stars' => 'required'
        ]);

        $movieRating = new MovieRating;
        $movieRating->title = $request->input('title');
        $movieRating->body = $request->input('body');
        $movieRating->movie_id = $request->input('movie_id');
        $movieRating->user_id = $userId;
        $movieRating->stars = $request->input('stars');
        $movieRating->save();

        return redirect()->route('movies.show', [$request->input('movie_id')])->with('success', 'Recenze byla přidána.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movieRating = MovieRating::find($id);
        $movieRating->delete();

        return redirect()->route('movies.show', [$movieRating->movie_id])->with('success', 'Recenze ' . $movieRating->title . ' byla smazána.');
    }
}
