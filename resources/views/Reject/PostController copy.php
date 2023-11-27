<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function post_submit(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|max:255',

        ]);

        DB::table('posts')->insert([
            'description' => $request->description

        ]);

        $all_post = DB::table('posts')->get();
        // return view('auth.profile', compact('all_post'));
        return redirect()->back()->with('success', 'Profile information saved successfully')->with(compact('all_post'));

        // auth()->attempt($request->only('email', 'password'));

        // if (!auth()->check()) {
        //     // Add some debugging statements or log messages here
        //     dd('Authentication failed');
        // }

        // return redirect()->back()->with('success', 'Profile information saved successfully');
        // return redirect()->back()->with('success', 'Profile information saved successfully')->with(compact('all_post'));
        // return redirect()->back()->with(compact('all_post'));



    }

    // public function user_post()
    // {
    //     $all_post = DB::table('posts')->get();
    //     dd($all_post);
    //     return view('auth.profile', compact('all_post'));

    // }
}
