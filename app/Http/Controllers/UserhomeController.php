<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tour;

class UserhomeController extends Controller
{
   
    public function index()
    {
        $cat = Category::all();
        // dd($cat);
        return view('home',['cats'=>$cat]);
    }
    public function AllTourPackage()
    {
        $tours = Tour::all();
        // dd($cat);
        return view('alltour',['tours'=>$tours]);
    }



    public function AboutUs(Type $var = null)
    {
        return view('about');
    }
   
}
