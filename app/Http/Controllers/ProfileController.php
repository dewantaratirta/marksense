<?php

namespace App\Http\Controllers;

use App\Models\Enum\GenderEnum;
use App\Repositories\Eloquent\UserRepository;
use App\Rules\UsernameRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected UserRepository $userRepository;

    function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    function index()
    {
        $user = Auth::user()->load(['media', 'roles']);
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user()->load(['media', 'roles']);
        $gender_options = GenderEnum::getOptions();
        return view('profile.edit', compact('user', 'gender_options'));
    }

    function profile_post(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => [
                'required',
                'min:3',
                'max:20',
                new UsernameRules(),
                'unique:users,username,' . $user->id
            ],
            'role' => 'integer|exists:roles,id',
            'avatar' => 'mimes:png,jpg,jpeg,webp|max:2048',
        ];

        $request->validate($rules);
        $result = $this->userRepository->update(Auth::id(), $request->all());
        if (!$result) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
    }


    function password_post(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Old password is incorrect');
        }

        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('profile.edit_password')->with('success', 'Password updated successfully');
    }
}
