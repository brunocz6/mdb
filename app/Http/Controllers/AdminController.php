<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MovieCategory;

class AdminController extends Controller
{
    public function index()
    {
        $categories = MovieCategory::all();

        return view('admin.index')->with('categories', $categories);
    }
}
