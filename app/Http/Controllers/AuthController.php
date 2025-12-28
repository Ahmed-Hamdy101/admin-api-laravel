<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    // base case for auth
        if (Auth::attempt($request->only('email','password'))){
            $user = Auth::user();
            $token = $user->createToken('admin')->accessToken;
            return response()->json(['token'=>$token,
                'user'=>[
                    'id'=>$user->id,
                    'full name'=>$user->f_name . $user->l_name,
                    'email'=>$user->email
                ]]);
        }
        return response()->json(['error'=>'invalid Credential'],Response::HTTP_UNAUTHORIZED);
    }

    public function register(RegisterRequest $request)
    {
        // validate request is done in RegisterRequest
        $data = $request->only(['f_name', 'l_name', 'email']);
        // hash password
        $data['password'] = bcrypt($request->input('password'));
        // create user
        $user = User::create($data);

        // generate token right away
        $token = $user->createToken('admin')->accessToken;
        // return response
        return response()->json([
            'message' => 'User created successfully',
            'token'   => $token,
            'user'    => [
                'id'        => $user->id,
                'full_name' => $user->f_name . ' ' . $user->l_name,
                'email'     => $user->email,
            ],
        ], Response::HTTP_CREATED);
    }

}
