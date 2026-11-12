<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    // Show User Profile Edit Page
    public function edit()
    {
        return view('pages.dashboard.user-dashboard.edit-profile', [
            'user' => auth()->user()
        ]);
    }

    // Update User Profile
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        if ($request->hasFile('avatar')) {

            if (
                $user->avatar &&
                !filter_var($user->avatar, FILTER_VALIDATE_URL)
            ) {
                Storage::disk('public')->delete($user->avatar);
            }

            $validated['avatar'] = $request->file('avatar')
                ->store('profile-images', 'public');
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()
            ->route('userprofile.edit')
            ->with('success', 'Profile updated successfully!');
    }


    // Change Password Page
    public function changePassword()
    {
        return view('pages.dashboard.user-dashboard.chang-password');
    }


    // Update Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password changed successfully!');
    }


    // Delete Account Page
    public function deleteAccount()
    {
        return view('pages.dashboard.user-dashboard.chang-password');
    }


    // Delete Account Permanently
    public function destroyAccount(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = auth()->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Your account has been deleted successfully!');
    }


    public function profileInfo()
    {
        $user = auth()->user();

        return view('pages.dashboard.user-dashboard.profile-info', compact('user'));
    }


    
}
