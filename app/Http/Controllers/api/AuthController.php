<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
     /**
     * Login function
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
        }

        if (!auth()->attempt($data)) {
            return response(['message' => 'Login failed. Please try again']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['access_token' => $accessToken]);

    }

    /**
     * Register function
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

}
