<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;

class HomeController extends Controller
{
    public function register(Request $req){
        $req->session()->put('signup',true);
        $validation=$req->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        $req->session()->flush();
        $user=new User();
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->save();
        return redirect()->back()->with('success','Signup Successfully, Please Login!');
    }

    public function login(Request $req){
        $validation=$req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember_me = $req->has('rememberme') ? true : false; 
        if (auth()->attempt(['email' => $req->email, 'password' => $req->password], $remember_me))
        {
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('error','Invalid Credentials.');
        }
    }

    public function logout(Request $req){
    	Auth::guard('web')->logout();
    	return redirect()->route('/');
    }

    public function dashboard(){
        $users=User::count();
        $products=Product::count();
        $out_of_stock=Product::where('stock','0')->count();
        $today_added=Product::whereDate('created_at',date("Y-m-d"))->count();
        return view('dashboard')->with(['users'=>$users,'products'=>$products,'out_of_stock'=>$out_of_stock,'today_added'=>$today_added]);
    }
}
