<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::User();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to be logged in to access this page.');
        }

        return view('reservation.aboutme', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:5|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userData = [
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->input('password'));
        }

        if($request->hasFile('avatar'))
        {
            if($user->avatar)
            {
                $avatarPath = public_path('img/avatars/') . $user->avatar;
                if(file_exists($avatarPath))
                {
                    unlink($avatarPath);
                }
            }
        }

        if ($request->hasFile('avatar')) {
            $avatarName = Str::random(20) . '.' . $request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->move(public_path('img/avatars'), $avatarName);
            $userData['avatar'] = $avatarName;
        }

        $user->update($userData);

        return redirect()->route('settings')->with('success', 'Profile updated successfully!');
    }

}
