<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserController extends Controller {

    /**
    * checks for validations and sign up a given new user
    * @param request: user data 'name' string,'email' string,'password' string
    */
    public function signup(Request $request) {
        // validate the request body content use these headers (Content-Type, X-Requested-With)
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

            // gets here when validation successed
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);     // encript password string in the DB

        $user->save();
            // save in the users table

        return response()->json([
            'message'=> 'user was created!'
        ], 201);
    }
    
    /**
     * handles sign in requests, uses jwt, sends a token for the user to use if everything was successful
     * @param request: user data for signing in (email & password)
     */ 
    public function signin(Request $request) {
            // validate request
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $relevant_credintials = $request->only('email', 'password');

            // validate json-web-token
        try {
                // does an if statement and in it creates a token
            if (!$token = JWTAuth::attempt($relevant_credintials)) {
                // if the credintials fails return 401 error
                return response()->json([
                    'error' => 'Invalid user data'
                ], 401);
            }
        } catch (JWTException $e) {
            // if the creation of the token itself failed
            return response()->json([
                'error' => 'Cannot create token'
            ], 500);
        }

            // if everything was good
        return response()->json([
            'token' => $token
        ], 200);
    }
}