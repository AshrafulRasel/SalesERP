<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function edit_profile(){
         return view('profile.edit_profile');
    }

    public function update_profile(Request $request, $id){


        $user = User::find($id);
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->email = $request->email;

        if ($request->hasFile('image')){
        $image_path ="images/user/".$user->image;
        if (file_exists($image_path)){
            unlink($image_path);
        }
        $imageName =request()->image->getClientOriginalName();
        request()->image->move(public_path('images/user/'), $imageName);
        $user->image = $imageName;
    }



        $user->save();

        return redirect()->back();
    }


    public function update_password(){
        return view('profile.password');
    }
}
