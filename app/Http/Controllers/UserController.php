<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;

class UserController extends Controller
{
    public function register(Request $request) 
    {   
        $validator = validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            $message = $validator->errors()->first();
            return response()->json([
                'status' => 0,
                'message' => $message
            ], 422);
        }
        try {
            // $token = Str::random(64);
            // $password = Str::random(10);
            $user = new User;
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->save();
            return response()->json([
                'status' => 1,
                'message' => "user register successfully."
            ]);

        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Unauthorized',
                    'status' => 0
                ]);
            }
            $user = $request->user();
            $tokenResult = $user->createToken($user->id);
            $token = $tokenResult->token;
            return response()->json([
                'status' => 1, 
                'tokenDetails' => $token, 
                'token' => $tokenResult->accessToken, 
                'id' => Auth::id(), 
                'user' => $user])->header('Authorization', $tokenResult->accessToken);
        }
        catch (\Exception $e) {
            throw $e;
        }
    }
}
