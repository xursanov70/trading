<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);
        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json(["message" => "Ro'yxatdan muvaffaqqiyatli o'tildi !", 'token' => $token, 'success' => true], 201);
    }



    public function login(LoginRequest $request)
    {
        $login = [
            'username' => $request->username,
            'password' => $request->password

        ];

        if (Auth::attempt($login)) {
            $user = $request->user();
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json(['token' => $token, 'success' => true], 200);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function updateUser(UpdateUserRequest $request)
    {
      return  $user = User::find(Auth::user()->id);

        $user->update([
            'username' => $request->username,
            'phone' => $request->phone,
        ]);
        return response()->json(["message" => "O'zgartirish muvaffaqqiyatli yakunlandi!"], 200);
    }

    
    public function myProfile()
    {
        return Auth::user();
    }
}
