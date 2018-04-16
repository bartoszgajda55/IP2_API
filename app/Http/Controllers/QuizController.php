<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

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
     * Edit quiz entity
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $quiz = Quiz::find($id);
        if(!$quiz) {
            return Response::create([], 404);
        }

        if($request->has('quizname')) {
            $quiz->QuizName = $request->input('quizname');
        }
        if($request->has('quizdescription')) {
            $quiz->QuizDescription = $request->input('quizdescription');
        }
        if($request->has('quizimage')) {
            $quiz->QuizImage = $request->input('quizimage');
        }
        if($request->has('quizcolor')) {
            $quiz->QuizColor = $request->input('quizcolor');
        }

        if($quiz->save()) {
            return Response::create([], 200);
        } else {
            return Response::create([], 500);
        }
    }


    /**
     * Retrieve the questions for the given quiz.
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

    /**
     * Create a new quiz
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $quiz = new Quiz();
        $quiz->QuizName = $request->input('quizname');
        $quiz->QuizDescription = $request->input('quizdescription');
        $quiz->QuizImage = $request->input('quizimage');
        $quiz->QuizColor = $request->input('quizcolor');

        if($quiz->save()) {
            return Response::create($quiz->QuizID, 201);
        } else {
            return Response::create([], 500);
        }
    }

    /**
     * Remove the quiz for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function remove($id)
    {
        $quiz = Quiz::find($id);

        try {
            $quiz->delete();
            return Response::create([], 200);
        } catch (Throwable | QueryException $error) {
            return Response::create([], 500);
        }
    }
}
