<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        // dd("1");
        $user = Auth::user();
        return view('customer.profile.edit', compact('user'));
    }

    // Handle form submission
    public function update(Request $request)
    {
         $request->validate([
            'phone' => 'required|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|max:255',
            'name' => 'required|max:255'
        ]);

        // dd($request);
        $user = Auth::user();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;

        $user->save();
        

        return redirect()->route('profile',  ['id' => $user->id])->with('success', 'Cập nhật thành công!');
    }

}
