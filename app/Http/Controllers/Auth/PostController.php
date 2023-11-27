<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller

{
    public function createPost(Request $request)
    {
        // Validate request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'required',
        ]);

        // Assuming you have a form with a user_id input
        $userId = $request->input('user_id');
        $description = $request->input('description');

        // Insert the new post into the database
        DB::table('posts')->insert([
            'user_id' => $userId,
            'uuid' => Str::uuid(),
            'description' => $description,
            'view_count' => 0, // Initialize view count to zero
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('home'); // Assuming you have a route named 'home'

        // return redirect()->route('home', ['username' => Auth::guard('admin')->user()->username]);
    }

    public function viewSinglePost($postId)
    {
        // Fetch single post and increment view count
        $post = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name as author_name', 'users.username as single_name') // Ensure you select the 'users.name' column as 'author_name'
            ->where('posts.uuid', $postId)
            ->first();
// ->where('posts.id', $postId)
        if ($post) {
            // Increment view count
            DB::table('posts')
                ->where('id', $post->id)
                ->increment('view_count');

            return view('posts.single', compact('post'));
        } else {
            return redirect()->route('home')->with('error', 'Post not found.');
        }
    }

    public function editPost($postId)
    {
        // Fetch single post
        // $post = DB::table('posts')->where('id', $postId)->first();

        $post = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.name as author_name', 'users.username as single_name')
        ->where('posts.uuid', $postId)
        ->first();

        // Check if the post exists
        if ($post) {
            // You can implement authorization logic here to ensure only the author can edit the post

            return view('posts.edit', compact('post'));
        } else {
            return redirect()->route('home')->with('error', 'Post not found.');
        }
    }

    public function updatePost(Request $request, $postId)
    {
        $updateDescription = ['description' => $request->description ?? null ];

        // Validate request data
        $request->validate([
            'description' => 'required',
        ]);

        // Update post
        DB::table('posts')
            ->where('posts.uuid', $postId)
            ->update($updateDescription);
            // ->update(['description' => $request->input('description')]);

        return redirect()->route('home')->with('success', 'Post updated successfully!');

        // return redirect()->route('home', ['username' => Auth::guard('admin')->user()->username]);
    }

    public function deletePost($postId)
    {

        // Fetch single post
        $post = DB::table('posts')->where('posts.uuid', $postId)->first();

        // Check if the post exists
        if ($post) {
            // You can implement authorization logic here to ensure only the author can delete the post

            // Delete post
            DB::table('posts')->where('posts.uuid', $postId)->delete();

            return redirect()->route('home')->with('success', 'Post deleted successfully!');

            // return redirect()->route('home', ['username' => Auth::guard('admin')->user()->username]);
        } else {
            return redirect()->route('home')->with('error', 'Post not found.');
        }
    }

    public function showAllPosts()
    {
        // Fetch all posts
        $posts = DB::table('posts')->get();

        return view('posts.home', compact('posts'));
    }
}
