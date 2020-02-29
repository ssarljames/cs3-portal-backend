<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
      public function login (Request $request) {

            $user = User::where('username', $request->username)->first();

            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                    $response = ['token' => $token];
                    $user->token = $token;
                    return response($user, 200);
                } else {
                    $response = "Invalid Credentials";
                    return response($response, 422);
                }

            }

            else {
                $response = 'Invalid Credentials';
                return response($response, 422);
            }

      }

      public function logout (Request $request) {

            $token = $request->user()->token();
            $token->revoke();

            return response([
                'message'=>'You have been succesfully logged out!'
            ], 200);

        }
}
