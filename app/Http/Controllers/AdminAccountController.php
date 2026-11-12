<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminAccountController extends Controller
{
    // Admin Check
    private function checkAdmin()
    {
        abort_unless(
            Auth::check() && Auth::user()->user_type === 'admin',
            403
        );
    }

    // Security Page
    public function index()
    {
        $this->checkAdmin();

        return view('pages.dashboard.admin-dashboard.account-security');
    }

    // Change Password
    public function updatePassword(Request $request)
    {
        $this->checkAdmin();

        $request->validate([


            'password' => [
                'required',
                'confirmed',
                'different:current_password',
                Password::min(8),
            ],
        ]);

        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with(
            'success',
            'Password changed successfully!'
        );
    }

    // Delete Account
    public function destroy(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'delete_password' => [
                'required',
                'current_password',
            ],
        ]);

        $user = Auth::user();

        // Delete User Account
        $user->delete();

        // Logout
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Your account has been deleted successfully!');
    }
}
