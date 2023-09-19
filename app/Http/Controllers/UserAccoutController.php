<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAccoutController extends Controller
{
    public function create(){
        return inertia('UserAccount/Create');
    }

    public function store(Request $request){
        $user = User::create($request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:8|confirmed',
        ]));

        Auth::login($user);
        $request->session()->regenerate();
        
        return redirect()->route('listing.index')->with('success', 'Account created successfully.');
    }
}
