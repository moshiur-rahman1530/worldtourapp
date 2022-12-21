<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   

    public function storeContact(Request $request)
      {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required'
        ]);

        $checkEmail = Contact::where('email','=',$request->email)->first();

        if (!$checkEmail) {
            $subscriber = Contact::create(['name'=>$request->name,'email'=>$request->email,'comment'=>$request->comment]);

            if ($subscriber == true) {
                return 1;
            }else{
                return 0;
            }
        }else{
            return 2;
        }
  
    }



}
