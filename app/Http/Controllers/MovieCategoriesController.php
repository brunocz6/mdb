<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MovieCategory;

class MovieCategoriesController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movie_categories.create');
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
            'name' => 'required'
        ]);

        $category = new MovieCategory;
        $category->name = $request->input('name');
        $category->save();

        return redirect('/admin')->with('success', 'Kategorie ' . $category->name . ' byla přidána.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = MovieCategory::find($id);

        if($category == null)
        {
            abort(404);
        }

        return view('movie_categories.edit')->with('category', $category);
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
            'name' => 'required'
        ]);

        $category = MovieCategory::find($id);
        $category->name = $request->input('name');
        $category->save();

        return redirect('/admin')->with('success', 'Kategorie ' . $category->name . ' byla upravena.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = MovieCategory::find($id);
        $category->delete();

        return redirect('/admin')->with('success', 'Kategorie ' . $category->name . ' byla smazána.');
    }
}
