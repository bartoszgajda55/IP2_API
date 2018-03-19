<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Retrieve all users.
     *
     * @return Response
     */
    public function index()
    {
        $results = app('db')->select("SELECT * FROM User");
        return Response::create($results);
    }

    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = app('db')->select("SELECT * FROM User WHERE UserID = ".$id);
        return Response::create($user);
    }

    /**
     * Check if user exists and credentials are matching
     *
     * @param  Request  $request
     * @return Response
     */
    public function check(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = app('db')->select("SELECT * FROM User WHERE Email = '".$email."' AND Password = '".$password."'");
        if($user) {
            return Response::create($user, 200);
        }
        return Response::create([], 404);
    }
}
