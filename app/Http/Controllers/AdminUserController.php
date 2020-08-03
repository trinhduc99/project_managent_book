<?php

namespace App\Http\Controllers;

use App\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('admin.user.index', compact('users'));
    }

}
