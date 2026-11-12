<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    private function checkAdmin()
    {
        abort_unless(
            Auth::check() && Auth::user()->user_type === 'admin',
            403
        );
    }

    // Profile Page
    public function index()
    {
        $this->checkAdmin();

        $user = Auth::user();

        return view('pages.dashboard.admin-dashboard.profile', compact('user'));
    }

    // Edit Profile Page
    public function edit()
    {
        $this->checkAdmin();

        $user = Auth::user();

        return view('pages.dashboard.admin-dashboard.edit-profile', compact('user'));
    }

    // Update Profile
    public function update(Request $request)
    {
        $this->checkAdmin();

        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('admin.profile')
            ->with('success', 'Profile updated successfully!');
    }
}
