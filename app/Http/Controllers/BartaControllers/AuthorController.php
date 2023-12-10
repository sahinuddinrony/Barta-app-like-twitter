<?php

// namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers\BartaControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{


    public function viewSingleProfile($id)
    {

        // Retrieve a specific user's data
        $userData = DB::table('users')
            ->where('id', $id)
            ->first();

        // Retrieve the user's posts
        $userPosts = DB::table('posts')
            ->where('user_id', $id)
            ->orderBy('created_at', 'desc') // Order by most recent
            ->get();

            // Fetch the user's comments
            $userComments = DB::table('comments')
                ->where('user_id', $id)
                ->orderBy('created_at', 'desc') // Order by most recent
                ->get();



            foreach ($userPosts as $post) {
                $commentsCount = DB::table('comments')
                    ->where('post_id', $post->id)
                    ->count();

                // Attach the comments count to the post object
                $post->comments_count = $commentsCount;
            }

        return view('barta.pages.profile.view_single_profile', compact('userData', 'userPosts', 'id', 'userComments'));
    }

}
