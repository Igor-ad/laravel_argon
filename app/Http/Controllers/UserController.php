<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if (null != $request->input('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $users = $query
            ->orderBy('name')
            ->paginate(5);
        return view('users.index', compact('users'));
    }

    public function add()
    {
        return view('users.create');
    }

    public function create(UserCreateRequest $request)
    {
        $request['password'] = Hash::make($request->input('password'));
        User::create($request->all());
        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('user.index');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}
