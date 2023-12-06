<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->isAdmin) {
            $users = User::all();
            return response()->json(['users' => $users]);
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        ]);

        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'isAdmin' => $request->isAdmin ?? false,
        ]);

        return response()->json(['user' => $user, 'message' => 'User created'], 201);
    }


    public function show(User $user)
    {
        return response()->json(['user'=> $user]); // Returns user data
    }

    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'User Updated'], 200);
    }

    public function destroy(User $user)
    {
        $user->delete(); // Deletes the user
        return response()->json(['message' => 'User deleted']);
    }
}
