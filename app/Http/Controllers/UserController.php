<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userProfile()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        if ($user) {
            // Fetch the user's information
            $userData = $user;

            // Fetch the user's posts
            $userPosts = DB::table('posts')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc') // Order by most recent
                ->get();

            // Pass the data to the view
            return view('auth.profile', compact('userData', 'userPosts'));
        } else {
            // Redirect to login if the user is not authenticated
            return redirect()->route('login')->with('error', 'Please log in to view your profile.');
        }
    }
}
