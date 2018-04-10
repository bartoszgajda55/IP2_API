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
            return Response::create([$user], 200);
        } else {
            return Response::create([], 404);
        }
    }

    /**
     * Edit user entity
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        if(!$user) {
            return Response::create(['message' => 'user does not exist'], 404);
        }

        if($request->has('username')) {
            $user->Username = $request->input('username');
        }
        if($request->has('email')) {
            $user->Email = $request->input('email');
        }
        if($request->has('firstname')) {
            $user->Firstname = $request->input('firstname');
        }
        if($request->has('surname')) {
            $user->Surname = $request->input('surname');
        }
        if($request->has('password')) {
            $user->Password = $request->input('password');
        }
        if($request->has('adminstatus')) {
            $user->AdminStatus = $request->input('adminstatus');
        }
        if($request->has('xp')) {
            $user->XP = $request->input('xp');
        }
        if($request->has('quizesscompleted')) {
            $user->QuizessCompleted = $request->input('quizesscompleted');
        }
        if($request->has('correctanswers')) {
            $user->CorrectAnswers = $request->input('correctanswers');
        }

        if($user->save()) {
            return Response::create([], 200);
        } else {
            return Response::create([], 500);
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
            return Response::create([], 400);
        }

        if($request->has('password')) {
            $password = $request->input('password');
        } else {
            return Response::create([], 400);
        }

        $user = User::where('Email', $email)->first();

        if (!$user) {
            return Response::create(['message' => 'email not found'], 404);
        }

        if ($password === $user->Password) {
            return Response::create([$user], 200);
        } else {
            return Response::create(['message' => 'passwords do not match'], 400);
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
            $user = User::all()->where('Username', $user->Username)->first();
            return Response::create([$user], 201);
        } else {
            return Response::create([], 500);
        }
    }
}
