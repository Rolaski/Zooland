<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AdminUserController extends Controller
{
    public function showUserCRUD()
    {
        $users = User::all();
        return view('admin.userCRUD', compact('users'));
    }

    // Method for create new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5',
            'role' => 'required|string|in:user,admin',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        // check if email is unique
        $validator = Validator::make($request->all(), [
            'email' => 'unique:users,email'
        ]);

        // email isnt unique
        if ($validator->fails()) {
            return back()->withErrors(['email' => 'Email already exists.'])->withInput();
        }

        // create new user from inputs
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;

        // add new avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = Str::random(20) . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('img/avatars'), $avatarName);
            $user->avatar = $avatarName;
        }

        $user->save();

        return redirect()->route('userCRUD')->with('success', 'User added successfully.');
    }

    public function update(Request $request)
    {
    $user = User::findOrFail($request->user_id);
    $requestData = $request->except('role');

    $validatedData = Validator::make($requestData, [
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique('users')->ignore($user->id),
        ],
        'password' => 'nullable|string|min:5',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
    ]);

    if ($validatedData->fails()) {
        return redirect()->back()->withErrors($validatedData)->withInput();
    }

    $userData = [
        'name' => $request->name,
        'surname' => $request->surname,
        'email' => $request->email,
    ];

    if ($request->filled('password')) {
        $hashedPassword = Hash::make($request->input('password'));
        $userData['password'] = $hashedPassword;
    }

    if ($request->hasFile('avatar')) {
        if ($user->avatar) {
            $oldAvatarPath = public_path('img/avatars/' . $user->avatar);
            if (file_exists($oldAvatarPath)) {
                unlink($oldAvatarPath);
            }
        }
        $avatar = $request->file('avatar');
        $avatarName = Str::random(20) . '.' . $avatar->getClientOriginalExtension();
        $avatar->move(public_path('img/avatars'), $avatarName);

        $userData['avatar'] = $avatarName;
    }

    $user->role = $request->role == 'admin' ? 'admin' : 'user';

    $user->fill($userData);
    $user->save();

    return redirect()->route('userCRUD')->with('success', 'User updated successfully.');
    }


    public function destroy(User $user)
    {
        try
        {
            $user->delete();
            return redirect()->route('userCRUD')->with('success', 'User deleted successfully.');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            if ($e->getCode() === '23000')
            {
                return redirect()->route('userCRUD')->with('error', 'Cannot delete user with existing reservations.');
            }
            else
            {
                return redirect()->route('userCRUD')->with('error', 'An unexpected error occurred.');
            }
        }
    }
}
