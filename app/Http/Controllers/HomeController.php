<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    public function index()
    {

        // Fetch all posts with their authors
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name as author_name', 'users.username as single_name')
            ->orderBy('created_at', 'desc') // Order by most recent
            ->get();

        // Pass the data to the view
        return view('home', compact('posts'));
    }



    // public function index()
    // {
    //     // Fetch the authenticated user's username
    //     $username = Auth::user()->username;

    //     // $username = auth()->guard('admin')->user()->username;

    //     // Fetch all posts with their authors
    //     $posts = DB::table('posts')
    //         ->join('users', 'posts.user_id', '=', 'users.id')
    //         ->select('posts.*', 'users.name as author_name', 'users.username as single_name')
    //         ->orderBy('created_at', 'desc') // Order by most recent
    //         ->get();

    //     // Pass the data to the view
    //     return view('home', compact('posts', 'username'));
    // }



}


