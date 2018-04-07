<?php

namespace App\Http\Controllers;

use App\User;
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
        $results = User::all();
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
        $user = User::find($id);
        if($user) {
            return Response::create($user, 200);
        } else {
            return Response::create([], 404);
        }
    }

    /**
     * Check if user exists and credentials are matching
     *
     * @param  Request  $request
     * @return Response
     */
    public function check(Request $request)
    {
        if($request->has('email')) {
            $email = $request->input('email');
        } else {
            return Response::create([], 404);
        }

        if($request->has('password')) {
            $password = $request->input('password');
        } else {
            return Response::create([], 404);
        }

        $user = User::all()->where('Email', $email)->where('Password', $password);
        if($user->isNotEmpty()) {
            return Response::create($user, 200);
        } else {
            return Response::create([], 404);
        }
    }

    /**
     * Create a new user
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $user = new User();
        $user->Username = $request->input('username');
        $user->Email = $request->input('email');
        $user->Firstname = $request->input('firstname');
        $user->Surname = $request->input('surname');
        $user->password = $request->input('password');

        if($user->save()) {
            $user = User::all()->where('Username', $user->Username);
            return Response::create($user, 201);
        } else {
            return Response::create([], 500);
        }
    }
}
