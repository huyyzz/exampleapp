<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LogController extends Controller
{       //GET: /login
    function viewLogin(){
        return view('cloth.login');
    }
    function login(Request $request){
        $email = $request->get('email');
        $password = $request->get('password');
        if (Auth::attempt(['email'=> $email, 'password' => $password])){

            $user = Auth::user();

            session()->put('user_name', $user->name);
            session()->put('role', $user->role);
            session()->put('id', $user->id);
//            dd($user->role);
            switch($user->role){
                case 'admin':
                    return redirect()->route('statistic');
                    break;
                case 'customer':
                    return redirect()->route('customer.home');
                    break;
            }
        }else{
            return redirect()->back();
        }
    }
    function logout(){
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
    public function viewRegister(){
        return view('cloth.register');
    }
    public function registration(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|min:6',
            'address' => 'required|max:255',
            'phone' => 'required|numeric',
        ]);
        $validatedData['role'] = "customer" ;
        // Hash password
        $validatedData['password'] = bcrypt($validatedData['password']);
        // Create user

        try {
            $user = User::create($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() === '23000') {
                return back()->withErrors(['msg' => 'Email already exist']);
            }
        }
        Auth::login($user);


        session()->put('user_name', $validatedData['name']);

        return redirect()->route('login');
    }

    public function profile($id){
        $brands = brand::all();
        $categories = category::all();
        $user = User::where('id',$id)->first();
        return view('customer.profile', compact('user','brands','categories'));
    }
}



