<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    // public function post_submit(Request $request)
    // {
    //     $this->validate($request, [
    //         'description' => 'required|max:255',

    //     ]);

    //     DB::table('posts')->insert([
    //         'description' => $request->description

    //     ]);


        // Fetch all post information
        // $all_post_info = DB::table('posts')->get();
    // }

    // Create Post
    public function createPost(Request $request)
    {
        // Assuming you have a form with a user_id input
        $userId = $request->input('user_id');
        $description = $request->input('description');

        // Insert the new post into the database
        DB::table('posts')->insert([
            'user_id' => $userId,
            'description' => $description,
            'view_count' => 0, // Initialize view count to zero
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('home'); // Assuming you have a route named 'home'
    }

    // View Single Post and View Count:

    public function viewPost($postId)
    {
        // Fetch the post and its author
        $post = DB::table('posts')
            ->where('id', $postId)
            ->first();
// dd($post);
        // Increment the view count
        DB::table('posts')
            ->where('id', $postId)
            ->increment('view_count');

        // Pass the data to the view
        return view('auth.profile', compact('post'));
    }

// Edit Post (only by the author):

public function editPost($postId, Request $request)
{
    // Assuming you have a form with a description input
    $description = $request->input('description');

    // Update the post if the user is the author
    DB::table('posts')
        ->where('id', $postId)
        ->where('user_id', auth()->id()) // Ensure the user is the author
        ->update([
            'description' => $description,
            'updated_at' => now(),
        ]);

    return redirect()->route('home'); // Assuming you have a route named 'home'
}


// Delete Post (only by the author):

public function deletePost($postId)
{
    // Delete the post if the user is the author
    DB::table('posts')
        ->where('id', $postId)
        ->where('user_id', auth()->id()) // Ensure the user is the author
        ->delete();

    return redirect()->route('home'); // Assuming you have a route named 'home'
}



    // public function user_post()
    // {
    //     $all_post = DB::table('posts')->get();
    //     dd($all_post);
    //     return view('auth.profile', compact('all_post'));

    // }
}
