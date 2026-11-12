<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('pages.dashboard.admin-dashboard.user.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('pages.dashboard.admin-dashboard.user.show', compact('user'));
    }
}