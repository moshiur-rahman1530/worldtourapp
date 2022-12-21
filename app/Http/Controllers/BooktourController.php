<?php

namespace App\Http\Controllers;

use App\Models\Booktour;
use App\Models\Tour;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class BooktourController extends Controller
{
   public function bookTour(Request $request)
   {
    $tourid = $request->id;
    // dd($tourid);
    $tour = Tour::where('id','=', $tourid)->first();

    // dd($tour);

    $userid = Auth::user()->id;
    $checktour = Booktour::where('user_id','=', $userid)->where('tour_id','=',$tourid)->where('status','=',0)->first();

    if (!$checktour) {
        $result = Booktour::create([
            'user_id'=>$userid, 
            'tour_id'=>$tour['id'], 
            'tour_name'=>$tour['tour_title'], 
            'tour_img'=>$tour['tour_img'], 
            'tour_des'=>$tour['tour_des'], 
            'price'=>$tour['price'], 
            'duration'=>$tour['duration'], 
            'tour_date'=>$tour['date'], 
            'book_date'=> Carbon::now(), 
        ]);
    
        if ($result==true) {
           return 1;
        }else{
            return 0;
        }
    } else {
        return 2;
    }
    

   }
}
