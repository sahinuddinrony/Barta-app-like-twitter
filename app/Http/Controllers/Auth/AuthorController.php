<?php

namespace App\Http\Controllers\Auth;

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
            ->get();

        return view('auth.view_single_profile', compact('userData', 'userPosts', 'id'));
    }



}
