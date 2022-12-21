<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Booktour;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    public function index()
    {
        // $result = Tour::all();
        $cat = Category::all();
        return view('admin.tour',['cats'=>$cat]);
    }


      public function catbytour()
      {
       
      }

      public function store(Request $request)
      {
          $title = $request->input('tour_title');
          $desc = $request->input('tour_des');
          $status = $request->input('status');
          $cat = $request->input('tour_cat');
          $price = $request->input('price');
          $duration = $request->input('duration');
          $date = $request->input('date');
          $feature = $request->input('is_featured');
  
            $filename = $request->file('tour_img')->getClientOriginalName();
            $filename = url("/images") ."/" . uniqid() .
            $request->file('tour_img')->getClientOriginalName();
            $destinationPath = "images";
            $request->file('tour_img')->move($destinationPath, $filename);

  
          $result = Tour::create(['tour_title'=>$title, 'tour_des'=>$desc, "tour_img"=>$filename,'status'=>$status, "price"=>$price,"date"=>$date,"duration"=>$duration,"is_featured"=>$feature,"tour_cat"=>$cat]);

          if ($result==true) {
            return 1;
          } else {
            return 0;
          }
  
      }


// get allcategory

  public function alltour()
  {
    $result = Tour::all();
    return $result;
  }


// filter tour

  public function filterTour(Request $request)
  {


    if ($request->input('key')=="" && $request->input('minprice')=="" && $request->input('maxprice')=="" && $request->input('category')=="" && $request->input('date')=="" && $request->input('duration')=="")
        {
        return;
        }

         
        if($request->input('key')){
            $passes = Tour::where('tour_title', 'LIKE', '%' . $request->input('key') . '%')
            ->orderBy('id', 'DESC')
            ->get();
        }
        if($request->input('duration')){
            $passes = Tour::where('duration', 'LIKE', '%' . $request->input('duration') . '%')
            ->orderBy('id', 'DESC')
            ->get();
        }
        if($request->input('date')){
            $passes = Tour::where('date', 'LIKE', '%' . $request->input('date') . '%')
            ->orderBy('id', 'DESC')
            ->get();
        }
        if($request->input('category')){
            $passes = Tour::where('tour_cat', 'LIKE', '%' . $request->input('category') . '%')
            ->orderBy('id', 'DESC')
            ->get();
        }
        if($request->input('maxprice')){
            $passes = Tour::whereBetween('price', [0, (int)$request->input('maxprice')])
            ->orderBy('id', 'DESC')
            ->get();
        }
        if($request->input('minprice')){
            $passes = Tour::whereBetween('price', [(int)$request->input('minprice'), 10000000000])
            ->orderBy('id', 'DESC')
            ->get();
        }
       
        if ($request->key && $request->category)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->category && $request->minprice)
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->whereBetween('price', [(int) $request->input('minprice'), 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->category && $request->maxprice)
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->whereBetween('price', [0, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->input('minprice') && $request->input('maxprice'))
        {
            $passes =DB::table('tours')->whereBetween('price', [(int) $request->input('minprice'), (int)$request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->maxprice && $request->duration )
        {
            $passes =DB::table('tours')->where('duration', 'LIKE', '%' . $request->duration . '%')->whereBetween('price', [0, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->maxprice && $request->date )
        {
            $passes =DB::table('tours')->where('date', 'LIKE', '%' . $request->date . '%')->whereBetween('price', [0, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->minprice && $request->date )
        {
            $passes =DB::table('tours')->where('date', 'LIKE', '%' . $request->date . '%')
            ->whereBetween('price', [(int) $request->input('minprice'), 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->minprice && $request->duration )
        {
            $passes =DB::table('tours')->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->whereBetween('price', [(int) $request->input('minprice'), 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->date && $request->duration )
        {
            $passes =DB::table('tours')->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->category && $request->duration)
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->category && $request->date)
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->duration)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->where('duration', 'LIKE', '%' . $request->duration . '%')
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->key && $request->date)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->where('date', 'LIKE', '%' . $request->date . '%')
                ->orderBy('id', 'DESC')
                ->get();
                
        }

        if ($request->key && $request->minprice)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->whereBetween('price', [(int) $request->input('minprice'), 10000000000])
                ->orderBy('id', 'DESC')
                ->get();
                
        }
        if ($request->key && $request->maxprice)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->whereBetween('price', [0,(int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();
                
        }

        if ($request->key && $request->category && $request->minprice )
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
                ->whereBetween('price', [(int) $request->input('minprice'), 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->key && $request->category && $request->maxprice )
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
                ->whereBetween('price', [0, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->key && $request->category && $request->duration )
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
                ->where('duration', 'LIKE', '%' . $request->duration . '%')
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->key && $request->category && $request->date )
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
                ->where('date', 'LIKE', '%' . $request->date . '%')
                ->orderBy('id', 'DESC')
                ->get();    
        }

        
        if ($request->key && $request->duration && $request->maxprice )
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->where('duration', 'LIKE', '%' . $request->duration . '%')
                ->whereBetween('price', [0, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->duration && $request->minprice )
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->where('duration', 'LIKE', '%' . $request->duration . '%')
                ->whereBetween('price', [(int) $request->input('minprice'), 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->duration && $request->date )
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->where('duration', 'LIKE', '%' . $request->duration . '%')
                ->where('date', 'LIKE', '%' . $request->date . '%')
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->maxprice && $request->minprice )
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->whereBetween('price', [(int) $request->input('minprice'), (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->maxprice && $request->date )
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->where('date', 'LIKE', '%' . $request->date . '%')
                ->whereBetween('price', [0, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->key && $request->date && $request->minprice )
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
                ->where('date', 'LIKE', '%' . $request->date . '%')
                ->whereBetween('price', [(int) $request->input('minprice'), 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        
        if ($request->category && $request->minprice && $request->maxprice )
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
                ->whereBetween('price', [(int) $request->input('minprice'), (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->category && $request->minprice && $request->duration )
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
                ->whereBetween('price', [(int) $request->input('minprice'), 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->category && $request->minprice && $request->date )
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
                ->whereBetween('price', [(int) $request->input('minprice'), 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->category && $request->maxprice && $request->date )
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
                ->whereBetween('price', [0, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->category && $request->maxprice && $request->duration )
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
                ->whereBetween('price', [0, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->category && $request->date && $request->duration )
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->minprice && $request->maxprice && $request->duration )
        {
            $passes =DB::table('tours')->where('duration', 'LIKE', '%' . $request->duration . '%')
                ->whereBetween('price', [(int) $request->minprice, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->minprice && $request->maxprice && $request->date )
        {
            $passes =DB::table('tours')->where('date', 'LIKE', '%' . $request->date . '%')
                ->whereBetween('price', [(int) $request->minprice, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->minprice && $request->duration && $request->date )
        {
            $passes =DB::table('tours')->where('date', 'LIKE', '%' . $request->date . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
                ->whereBetween('price', [(int) $request->input('minprice'), 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->maxprice && $request->duration && $request->date )
        {
            $passes =DB::table('tours')->where('date', 'LIKE', '%' . $request->date . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
                ->whereBetween('price', [0, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->key && $request->category && $request->minprice && $request->duration)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->whereBetween('price', [(int) $request->input('minprice'), 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->category && $request->minprice && $request->date)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->whereBetween('price', [(int) $request->input('minprice'), 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->category && $request->maxprice && $request->date)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->whereBetween('price', [0, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->category && $request->maxprice && $request->duration)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->whereBetween('price', [0, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->category && $request->minprice && $request->maxprice)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->whereBetween('price', [(int) $request->input('minprice'), (int) $request->maxprice])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->duration && $request->minprice && $request->maxprice)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->whereBetween('price', [(int) $request->input('minprice'), (int) $request->maxprice])
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->key && $request->date && $request->minprice && $request->maxprice)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->whereBetween('price', [(int) $request->input('minprice'), (int) $request->maxprice])
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ($request->key && $request->date && $request->duration && $request->maxprice)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->whereBetween('price', [0, (int) $request->maxprice])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->date && $request->duration && $request->minprice)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->whereBetween('price', [(int) $request->minprice, 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->category && $request->duration && $request->date)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ( $request->category && $request->duration && $request->date && $request->minprice)
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->whereBetween('price', [(int) $request->minprice, 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }

        if ( $request->category && $request->duration && $request->date && $request->maxprice)
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->whereBetween('price', [0, (int) $request->maxprice])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ( $request->category && $request->duration && $request->minprice && $request->maxprice)
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->whereBetween('price', [(int) $request->minprice, (int) $request->maxprice])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ( $request->category && $request->date && $request->minprice && $request->maxprice)
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->whereBetween('price', [(int) $request->minprice, (int) $request->maxprice])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ( $request->duration && $request->date && $request->minprice && $request->maxprice)
        {
            $passes =DB::table('tours')->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->whereBetween('price', [(int) $request->minprice, (int) $request->maxprice])
                ->orderBy('id', 'DESC')
                ->get();    
        }


        if ($request->key && $request->category && $request->minprice && $request->duration && $request->date)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->whereBetween('price', [(int) $request->input('minprice'), 10000000000])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->category && $request->maxprice && $request->duration && $request->date)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->whereBetween('price', [0, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->category && $request->maxprice && $request->minprice && $request->date)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->whereBetween('price', [ (int) $request->minprice, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->category && $request->maxprice && $request->minprice && $request->duration)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->whereBetween('price', [ (int) $request->minprice, (int) $request->maxprice])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->key && $request->date && $request->maxprice && $request->minprice && $request->duration)
        {
            $passes =DB::table('tours')->where('tour_title', 'LIKE', '%' . $request->key . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->whereBetween('price', [ (int) $request->minprice, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }
        if ($request->category && $request->date && $request->maxprice && $request->minprice && $request->duration)
        {
            $passes =DB::table('tours')->where('tour_cat', 'LIKE', '%' . $request->category . '%')
            ->where('date', 'LIKE', '%' . $request->date . '%')
            ->where('duration', 'LIKE', '%' . $request->duration . '%')
            ->whereBetween('price', [ (int) $request->minprice, (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();    
        }

       

        if ($request->input('key') && $request->input('minprice') && $request->input('maxprice') && $request->input('category') && $request->input('date') && $request->input('duration'))
        {
            $passes = Tour::where('tour_title', 'LIKE', '%' . $request->input('key') . '%')
                ->where('tour_cat', 'LIKE', '%' . $request->input('category') . '%')
                ->where('date', 'LIKE', '%' . $request->input('date') . '%')
                ->where('duration', 'LIKE', '%' . $request->input('duration') . '%')
                ->whereBetween('price', [(int) $request->input('minprice'), (int) $request->input('maxprice')])
                ->orderBy('id', 'DESC')
                ->get();
                
        } 
        
        return $passes;
  }

  // details category
  public function tourDetails(Request $req)
  {
    // dd($id);
    $id = $req->input('id');
    $data=json_encode(Tour::where('id','=',$id)->get());

    // dd($data);
    
      return $data;
  }


  public function userTourDetails (Request $request)
  {
    $id = $request->id;
    $data = Tour::where('id','=',$id)->first();
    return view('detailstour',['data'=>$data]);
  }


   // update category
   public function updateTour(Request $request)
   {
     // dd($req->file('img'));
     $id = $request->input('id');
     $title = $request->input('tour_title');
     $desc = $request->input('tour_des');
     $status = $request->input('status');
     $cat = $request->input('tour_cat');
     $price = $request->input('price');
     $duration = $request->input('duration');
     $date = $request->input('date');
     $feature = $request->input('is_featured');
     
 
       if($request->hasFile('img')){

        $filename = $request->file('img')->getClientOriginalName();
        $filename = url("/images") ."/" . uniqid() .
        $request->file('img')->getClientOriginalName();
        $destinationPath = "images";
        $request->file('img')->move($destinationPath, $filename);
 
           global $old_image2;
           $categorys = Tour::where('id','=',$id)->first();
           $old_image2 = $categorys->tour_img;
           $urlf2 =basename($old_image2);

           $imagePath2 = public_path('images/'.$urlf2);
// dd($urlf);
         
               if (File::exists($imagePath2)) { 
                   unlink($imagePath2);
               }
       }else{
         $findUbcat = Tour::where('id','=',$id)->first();
         $filename =$findUbcat->tour_img;
       }
       
    //    $findUbcat = Tour::where('id','=',$id)->first();
    //    $status = $findUbcat->status;

       $result= Tour::where('id','=',$id)->update([
         'tour_title'=>$title,
         'tour_des'=>$desc,
         'tour_cat'=>$cat,
         'price'=>$price,
         'duration'=>$duration,
         'tour_img'=>$filename,
         'is_featured'=>$feature,
         'date'=>$date,
         'status'=>$status,
       ]);
 
      if($result==true){
        return 1;
      }
      else{
       return 0;
      }
   }



   // change cat Status

  public function tourStatus(Request $req){
    $id = $req->input('id');
    $data = Tour::where('id',$id)->first();
    if ($data->status == 1) {
      $status = 0;
    } else {
      $status = 1;
    }
    $result = Tour::where('id',$id)->update(['status'=>$status]);
        if ($result==true) {
          return 1;
        } else {
          return 0;
        }
}




// delete categoryDelete

    public function tourDelete(Request $req)
    {
        $id = $req->input('id');

        global $old_image;
        $category = Tour::where('id','=',$id)->first();
        $old_image = $category->tour_img;

        $urlf = basename($old_image);

        $imagePath = public_path('images/'.$urlf);
         
              if (File::exists($imagePath)) { 
                  unlink($imagePath);
              }
  
        $result = Tour::where('id','=',$id)->delete();
        if ($result==true) {
          return 1;
        } else {
          return 0;
        }
       
    }

    public function manageTourPage(){
        return view('admin.manageBook');
    }
    public function manageTour(){
        $result = Booktour::orderBy('status','desc')->with('user')->get();
        // dd($result);
        return $result;

        // if($allbookslist==1){
        //     return 1;
        // }else{
        //     return 0;
        // }
    }
    public function tourBookStatus(Request $req){
        $id = $req->input('id');
        $data = Booktour::where('id',$id)->first();
        if ($data->status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $result = Booktour::where('id',$id)->update(['status'=>$status]);
            if ($result==true) {
                return 1;
            } else {
                return 0;
            }

        
    }


    public function bookTourDelete(Request $req)
  {
        $id = $req->input('id');
        $result = Booktour::where('id','=',$id)->delete();
        if ($result==true) {
        return 1;
        } else {
        return 0;
        }
  }


}
