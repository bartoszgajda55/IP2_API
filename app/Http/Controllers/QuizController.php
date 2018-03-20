<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Response;

class QuizController extends Controller
{
    /**
     * Retrieve all quizes and questions.
     *
     * @return Response
     */
    public function index()
    {
        $results = Quiz::all();
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
        $quiz = Quiz::find($id);
        if($quiz) {
            return Response::create($quiz, 200);
        } else {
            return Response::create([], 404);
        }
    }

    /**
     * Retrieve the quiz for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function showQuestions($id)
    {
        $questions = Quiz::find($id)->questions;
        if($questions) {
            return Response::create($questions, 200);
        } else {
            return Response::create([], 404);
        }
    }

}
