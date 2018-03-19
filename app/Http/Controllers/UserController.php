<?php

namespace App\Http\Controllers;

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
}
