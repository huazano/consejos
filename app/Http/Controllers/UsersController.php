<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function edit(User $id)
    {
        return view('users.edit', ['user' => $id]);
    }

    public function profile()
    {
        return view('users.profile');
    }
}
