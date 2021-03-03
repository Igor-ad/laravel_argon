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

    public function add(Request $request)

    {
        $request['password'] = Hash::make($request->input('password'));
        User::create($request->all());
        return response()->json('OK', 201);
    }

    public function del(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
