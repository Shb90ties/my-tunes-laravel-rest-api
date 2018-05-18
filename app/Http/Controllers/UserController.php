<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
}