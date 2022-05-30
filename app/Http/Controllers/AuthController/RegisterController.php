<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:8',
            'password_confirm' => 'required | same:password'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'You have successfully registered.',
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong. Please try again.'
        ], Response::HTTP_BAD_REQUEST);
    }

}
