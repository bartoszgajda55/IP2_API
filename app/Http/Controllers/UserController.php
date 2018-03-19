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
}
