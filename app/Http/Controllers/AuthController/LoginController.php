<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required | email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $login = $request->only('email', 'password');
        if (!$token = Auth::attempt($login)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'You have successfully logged in.',
            'authorization' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => 60
            ]
        ], Response::HTTP_OK);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'User successfully logged out.'
        ], Response::HTTP_OK);
    }
}
