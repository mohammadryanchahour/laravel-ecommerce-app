<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'isAdmin' => $request->isAdmin ?? false
        ]);

        return response()->json(['user' => $user, 'message' => 'User created Succesfully'], 201);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $authenticatedUser = Auth::attempt($request->only('email', 'password'));

        if (!$authenticatedUser) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        // dd($user);

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $token = $user->currentAccessToken();

        if (!$token) {
            return response()->json(['message' => 'User token not found'], 401);
        }

        if ($request->token === $user->currentAccessToken()->plainTextToken) {
            // var_dump($request->token);
            // var_dump($user->currentAccessToken()->plainTextToken);
            $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
            return response()->json(['message' => 'Logged out successfully'], 200);
        }
    }

}
