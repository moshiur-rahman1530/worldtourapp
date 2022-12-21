<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $result = Category::all();
        return view('admin.category',['category'=>$result]);
    }


      public function catbyproduct()
      {
       
      }

      public function store(Request $request)
      {
          $name = $request->input('catName');
          $desc = $request->input('catDes');
          $status = $request->input('status');
  
        //   $categoryImage = $request->file('catImg');
        //   $categoryImageSaveAsName = time() . Auth::id() . "-category." . $categoryImage->getClientOriginalExtension();
        //   $upload_path = 'images/category_image/';

        //   $category_image_url = $upload_path . $categoryImageSaveAsName;
  
        //   $success = $categoryImage->move($upload_path, $categoryImageSaveAsName);

        //   $filename = $request->file('image')->hashName();

            // $fileNameExt = $request->file('catImg')->getClientOriginalName();
            // $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            // $fileExt = $request->file('catImg')->getClientOriginalExtension();
            // $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            // $pathToStore = $request->file('catImg')->store('public/images/category',$fileNameToStore);

            $filename = $request->file('catImg')->getClientOriginalName();
            $filename = url("/images") ."/" . uniqid() .
            $request->file('catImg')->getClientOriginalName();
            $destinationPath = "images";
            $request->file('catImg')->move($destinationPath, $filename);

  
          $result = Category::create(['cat_name'=>$name, 'cat_des'=>$desc, "cat_img"=>$filename,'status'=>$status]);

          if ($result==true) {
            return 1;
          } else {
            return 0;
          }
  
      }


// get allcategory

  public function allcategory()
  {
    $result = Category::all();
    return $result;
  }

  // details category
  public function categoryDetails(Request $req)
  {
    // dd($id);
    $id = $req->input('id');
    $data=json_encode(Category::where('id','=',$id)->get());

    // dd($data);
    
      return $data;
  }


  public function userCategoryDetails(Request $request)
  {
    $id = $request->id;
    $data = Category::where('id','=',$id)->first();
    return view('detailscategory',['data'=>$data]);
  }


   // update category
   public function updateCategory(Request $req)
   {
     // dd($req->file('img'));
     $id = $req->input('id');
     $name = $req->input('name');
     $description = $req->input('description');
     
 
       if($req->hasFile('img')){

        $filename = $req->file('img')->getClientOriginalName();
        $filename = url("/images") ."/" . uniqid() .
        $req->file('img')->getClientOriginalName();
        $destinationPath = "images";
        $req->file('img')->move($destinationPath, $filename);
 
           global $old_image;
           $categorys = Category::where('id','=',$id)->first();
           $old_image = $categorys->cat_img;
           $urlf =basename($old_image);

           $imagePath = public_path('images/'.$urlf);
// dd($urlf);
         
               if (File::exists($imagePath)) { 
                   unlink($imagePath);
               }
       }else{
         $findUbcat = Category::where('id','=',$id)->first();
         $filename =$findUbcat->cat_img;
       }
       
       $findUbcat = Category::where('id','=',$id)->first();
       $status = $findUbcat->status;

       $result= Category::where('id','=',$id)->update([
         'cat_name'=>$name,
         'cat_des'=>$description,
         'cat_img'=>$filename,
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

  public function catStatus(Request $req){
    $id = $req->input('id');
    $data = Category::where('id',$id)->first();
    if ($data->status == 1) {
      $status = 0;
    } else {
      $status = 1;
    }
    $result = Category::where('id',$id)->update(['status'=>$status]);
        if ($result==true) {
          return 1;
        } else {
          return 0;
        }
}




// delete categoryDelete

    public function categoryDelete(Request $req)
    {
        $id = $req->input('id');

        global $old_image;
        $category = Category::where('id','=',$id)->first();
        $old_image = $category->cat_img;

        $urlf =basename($old_image);

        $imagePath = public_path('images/'.$urlf);
         
              if (File::exists($imagePath)) { 
                  unlink($imagePath);
              }
  
        $result = Category::where('id','=',$id)->delete();
        if ($result==true) {
          return 1;
        } else {
          return 0;
        }
       
    }

}
