<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Movie;
use App\MovieCategory;
use App\MovieRating;

class MoviesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($categoryId = null)
    {
        // Naplním kolekci kategorií a kolekci filmů nechám prázdnou.
        $data = [
            'categories' => MovieCategory::all(),
            'movies' => []
        ];

        // Pokud byla specifikována kategorie, pokusím se ji vyhledat v databázi.
        if ($categoryId !== null) {
            $category = MovieCategory::find($categoryId);

            // Pokud kategorie nebyla v databázi naleznuta, vrátím 404.
            if($category === null){
                abort(404);
            }

            // Pokud byla kategorie v databázi naleznuta, naplním kolekci filmy této kategorie.
            $data['movies'] = $category->movies;
        }
        else{
            // Pokud nebyla kategorie specifikována, vrátím seznam všech filmů.
            $data['movies'] = Movie::all();
        }

        return view('movies.index')->with($data);
    }

    public function top()
    {
        // Naplním kolekci kategorií a kolekci filmů nechám prázdnou.
        $movies = Movie::all();

        $sorted = $movies->sort(function($a, $b) {
            if ($a->averageRating() == $b->averageRating()) {
                return 0;
            }
        
            return ($a->averageRating() < $b->averageRating() ? -1 : 1);
        });

        return view('movies.top')->with('movies', $sorted);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MovieCategory::pluck('name', 'id')->toArray();
        return view('movies.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            'released_at' => 'date'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $movie = new Movie;
        $movie->name = $request->input('name');
        $movie->description = $request->input('description');
        $movie->category_id = $request->input('category_id');
        $movie->writer = $request->input('writer');
        $movie->director = $request->input('director');
        $movie->released_at = $request->input('released_at');
        $movie->cover_image = $fileNameToStore;
        $movie->save();

        return redirect('/movies')->with('success', 'Film byl přidán.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $movie = Movie::find($id);

        if ($movie == null) {
            abort(404);
        }

        return view('movies.show')->with('movie', $movie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'categories' => MovieCategory::pluck('name', 'id')->toArray(),
            'movie' => Movie::find($id)
        ];

        $movie = Movie::find($id);

        if($data['movie'] == null)
        {
            abort(404);
        }

        return view('movies.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'writer' => 'required',
            'director' => 'required',
            'category_id' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            'released_at' => 'date'
        ]);
        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $movie = Movie::find($id);
        $movie->name = $request->input('name');
        $movie->writer = $request->input('writer');
        $movie->director = $request->input('director');
        $movie->description = $request->input('description');
        $movie->category_id = $request->input('category_id');
        $movie->released_at = $request->input('released_at');
        $movie->cover_image = $fileNameToStore;
        $movie->save();

        return redirect('/movies')->with('success', 'Film byl upraven.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();

        return redirect('/movies')->with('success', 'Film ' . $movie->name . ' byl smazán.');
    }
}
