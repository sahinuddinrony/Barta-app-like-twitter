<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\BartaControllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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

            // Fetch the user's comments
            $userComments = DB::table('comments')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc') // Order by most recent
                ->get();



            foreach ($userPosts as $post) {
                $commentsCount = DB::table('comments')
                    ->where('post_id', $post->id)
                    ->count();

                // Attach the comments count to the post object
                $post->comments_count = $commentsCount;
            }


            // Pass the data to the view
            return view('barta.pages.profile.profile', compact('userData', 'userPosts', 'userComments', 'userComments'));
        } else {
            // Redirect to login if the user is not authenticated
            return redirect()->route('login')->with('error', 'Please log in to view your profile.');
        }
    }
}
