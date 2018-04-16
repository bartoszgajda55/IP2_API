<?php

namespace App\Http\Controllers;

use App\RecentQuiz;
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
}
