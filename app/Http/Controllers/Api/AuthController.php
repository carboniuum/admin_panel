<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            $token = $user->createToken('admin')->plainTextToken;

            return response()->json([
                'token' => $token,
            ]);
        }

        return response()->json([
            'error' => 'Invalid credentials',
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = User::create($request->only('first_name', 'last_name', 'email') + [
            'password' => Hash::make($request['password']),
        ]);

        return response($user, Response::HTTP_CREATED);
    }
}
