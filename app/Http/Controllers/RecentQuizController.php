<?php

namespace App\Http\Controllers;

use App\RecentQuiz;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RecentQuizController extends Controller
{
    /**
     * Retrieve the recent quizzes for user of ID
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $recentQuiz = RecentQuiz::where('UserID', $id)->orderBy('Time', 'DESC')->limit(8)->get();
        if($recentQuiz->isNotEmpty()) {
            return Response::create($recentQuiz, 200);
        } else {
            return Response::create([], 404);
        }
    }

    /**
     * Create a new Recent Quiz
     *
     * @param  Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $recentQuiz = new RecentQuiz();
        $recentQuiz->QuizID = $request->input('quizid');
        $recentQuiz->UserID = $request->input('userid');
        $recentQuiz->Score = $request->input('score');

        if ($recentQuiz->save()) {
            return Response::create([$recentQuiz], 201);
        } else {
            return Response::create([], 500);
        }
    }
}
