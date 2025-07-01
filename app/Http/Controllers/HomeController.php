<?php

namespace App\Http\Controllers;

use App\Constants\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        return Inertia::render('Home');
    }
    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }
    public function profile(Request $request)
    {
        return Inertia::render('Profile');
        /* if ($request->user()->role == Role::ADMIN) {
        } */
    }
    public function profileUpload(Request $request)
    {
        $request->validate([
            'profile' => 'required|file|max:5120'
        ]);
        if ($request->hasFile('profile')) {
            $user = Auth::user();
            if ($user->profile && Storage::disk('public')->exists($user->profile)) {
                Storage::disk('public')->delete($user->profile);
                $user->profile_url = "";
            }
            $path = $request->file('profile')->store('profile', 'public');
            $user->profile = $path;
            $user->profile_url = $path;
            $user->save();
            return back()->with('status', 'Your profile has been uploaded!');
        }
    }
}
