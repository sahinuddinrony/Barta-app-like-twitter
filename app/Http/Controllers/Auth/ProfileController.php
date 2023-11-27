<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function index()
    {

        return view('auth.edit_profile');
        
        // return view('auth.edit_profile', ['username' => Auth::guard('admin')->user()->username]);
    }

    public function profile_submit(Request $request)
    {
        $userData = [
            'name' => $request->name ?? null,
            'lastname' => $request->lastname ?? null,
            'email' => $request->email ?? null,
            'bio' => $request->bio ?? null,
        ];

        // Only add password if it is provided
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required',
                // 'retype_password' => 'required|same:password'
            ]);

            $userData['password'] = Hash::make($request->password);
        }

        $email = auth()->guard('admin')->user()->email;

        // Check if the user with the provided email exists
        $userExists = DB::table('users')->where('email', $email)->exists();

        if ($userExists) {
            // If the user exists, update the data
            DB::table('users')->where('email', $email)->update($userData);
        } else {
            // If the user doesn't exist, insert the new data
            $userData['email'] = $email;
            DB::table('users')->insert($userData);
        }

        return redirect()->back()->with('success', 'Profile information saved successfully');
    }
}
