<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    public function apiadd(Request $request)
    {
        $request['password'] = Hash::make($request->input('password'));
        User::create($request->all());
        return response()->json('OK! User: ' . $request->name . ' creaded successfully', 201);
    }

    public function del(User $user)
    {
        $user->delete();
        return response()->json('User ID: ' . $user->id . ' deleted successfully', 200);
    }
}
