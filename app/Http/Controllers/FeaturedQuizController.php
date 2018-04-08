<?php

namespace App\Http\Controllers;

use App\FeaturedQuiz;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeaturedQuizController extends Controller
{
    /**
     * Retrieve all featured quizes.
     *
     * @return Response
     */
    public function index()
    {
        $results = FeaturedQuiz::all();
        return Response::create($results);
    }

    /**
     * Retrieve the quiz for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $quiz = FeaturedQuiz::find($id);
        if($quiz) {
            return Response::create($quiz, 200);
        } else {
            return Response::create([], 404);
        }
    }
}
