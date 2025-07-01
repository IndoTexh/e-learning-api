<?php

namespace App\Http\Controllers;

use App\Constants\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        return Inertia::render('Auth/Register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        if($request->email == 'sothanroth@gmail.com') $user->role = Role::ADMIN;
        else $user->role = Role::STUDENT;
        $user->save();
        return redirect()->route('login');
    }
}
