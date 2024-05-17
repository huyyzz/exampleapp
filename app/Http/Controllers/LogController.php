<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{       //GET: /login
    function viewLogin(){
        return view('cloth.login');
    }
    function login(Request $request){
        $email = $request->get('email');
        $password = $request->get('password');
        if (Auth::attempt(['email'=> $email, 'password' => $password])){
            session()->put('user_name', $email);
            $user = Auth::user();
            switch($user->role){
                case 'admin':
                    return redirect()->route('Cloths.index');
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


        session()->put('user_name', $validatedData['email']);

        return redirect()->route('login');
    }
}



