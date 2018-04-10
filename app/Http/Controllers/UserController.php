<?php

namespace App\Http\Controllers;

use App\User;
use App\UserFriend;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * Retrieve all users.
     *
     * @return Response
     */
    public function index()
    {
        $term = Input::get('term');
        $order = Input::get('order');
        $limit = Input::get('limit');

        try {
            if($term && $limit) {
                return Response::create(User::orderBy($term, $order)->limit($limit)->get());
            } else if ($term) {
                return Response::create(User::orderBy($term, $order)->get());
            } else if ($limit) {
                return Response::create(User::limit($limit)->get());
            } else {
                return Response::create(User::get());
            }
        } catch (QueryException $exception) {
            return Response::create([], 400);
        }

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
     * Retrieve the user friends for the given user ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function showFriends($id)
    {
        $userFriends = UserFriend::where('User1ID', $id)->get();
        if($userFriends->isNotEmpty()) {
            return Response::create($userFriends, 200);
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
            return Response::create([], 404);
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
     * Check if user email and username are taken
     *
     * @param  Request  $request
     * @return Response
     */
    public function find(Request $request)
    {
        if (!($request->has('email') || $request->has('username'))) {
            return Response::create([], 400);
        }

        if($request->has('email')) {
            $user = User::where('Email', $request->input('email'))->get();
            if ($user->isNotEmpty()) {
                return Response::create([], 400);
            }
        }

        if($request->has('username')) {
            $user = User::where('Username', $request->input('username'))->get();
            if ($user->isNotEmpty()) {
                return Response::create([], 400);
            }
        }

        return Response::create([], 200);
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
            return Response::create([], 404);
        }

        if ($password === $user->Password) {
            return Response::create([$user], 200);
        } else {
            return Response::create([], 400);
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
