<?php

namespace App\Http\Controllers\BartaControllers;

// namespace App\Http\Controllers\BartaComment;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function createCommant(Request $request)
    {

        // Validate request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required',
        ]);

        // Assuming you have a form with a user_id & post_id input
        $userId = $request->input('user_id');
        $postId = $request->input('post_id');
        $comment = $request->input('comment');

        // Insert the new post into the database
        $data = DB::table('comments')->insert([
            'user_id' => $userId,
            'post_id' => $postId,
            'uuid' => Str::uuid(),
            'comment' => $comment,
            'view_count' => 0, // Initialize view count to zero
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Profile information saved successfully');
        // return redirect()->route('home'); // Assuming you have a route named 'home'

        // return redirect()->route('home', ['username' => auth()->user()->username]);
    }



    public function viewSingleComment($postId)
    {

        dd($postId);
        // Fetch post with comments and user information
        $comment = Post::with('comments', 'user')
            ->where('posts.id', $postId)
            ->first();

        if ($comment) {
            // Increment view count
            $comment->increment('view_count');

            return view('barta.pages.post.single', compact('comment'));
        } else {
            return redirect()->route('home')->with('error', 'Post not found.');
        }
    }


    public function editComment($commentId)
    {

        $comment = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id') // Assuming the 'user_id' column in 'comments' refers to the 'id' column in 'users'
            ->join('posts', 'posts.id', '=', 'comments.post_id') // Assuming the 'post_id' column in 'comments' refers to the 'id' column in 'posts'
            ->select('comments.*', 'users.name as author_name', 'users.username as single_name')
            ->where('comments.uuid', $commentId)
            ->first();


        // Check if the post exists
        if ($comment) {
            // You can implement authorization logic here to ensure only the author can edit the comment

            return view('barta.pages.comment.edit_comment', compact('comment'));
        } else {
            return redirect()->route('home')->with('error', 'comment not found.');
        }
    }

    public function updateComment(Request $request, $commentId)
    {
        $updateComment = ['comment' => $request->comment ?? null];

        // Validate request data
        $request->validate([
            'comment' => 'required',
        ]);

        // Update Comment
        DB::table('comments')
            ->where('comments.uuid', $commentId)
            ->update($updateComment);
        // ->update(['description' => $request->input('description')]);

        return redirect()->route('home')->with('success', 'Comment updated successfully!');
        // return redirect()->route('posts.single')->with('success', 'Comment updated successfully!');

        // return redirect()->route('home', ['username' => auth()->user()->username]);
    }

    public function deleteComment($commentId)
    {

        // Fetch single comment
        $comment = DB::table('comments')->where('comments.uuid', $commentId)->first();

        // Check if the comment exists
        if ($comment) {
            // You can implement authorization logic here to ensure only the author can delete the comment

            // Delete comment
            DB::table('comments')->where('comments.uuid', $commentId)->delete();

            return redirect()->route('home')->with('success', 'comment deleted successfully!');

            // return redirect()->route('home', ['username' => auth()->user()->username]);
        } else {
            return redirect()->route('home')->with('error', 'comment not found.');
        }
    }

}
