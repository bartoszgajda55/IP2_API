<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class QuestionController extends Controller
{
    /**
     * Create a new question
     *
     * @param  Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $question = new Question();
        $question->QuizID = $request->input('quizid');
        $question->QuestionString = $request->input('questionstring');
        $question->QuestionImage = $request->input('questionimage');
        $question->CorrectAnswerString = $request->input('correctanswerstring');
        $question->WrongAnswerString = $request->input('wronganswerstring');
        $question->WrongAnswerString2 = $request->input('wronganswerstring2');
        $question->WrongAnswerString3 = $request->input('wronganswerstring3');

        if ($question->save()) {
            return Response::create([$question], 201);
        } else {
            return Response::create([], 500);
        }
    }

    /**
     * Create a new question
     *
     * @param  Request $request
     * @return Response
     */
    public function createMany(Request $request)
    {
        $quizId = $request->input('quizid');

        try {
            foreach ($request->input('questions') as $key) {
                $question = new Question();
                $question->QuizID = $quizId;
                $question->QuestionString = $key['questionstring'];
                $question->QuestionImage = $key['questionimage'];
                $question->CorrectAnswerString = $key['correctanswerstring'];
                $question->WrongAnswerString = $key['wronganswerstring'];
                $question->WrongAnswerString2 = $key['wronganswerstring2'];
                $question->WrongAnswerString3 = $key['wronganswerstring3'];
                $question->save();
            }
        } catch (\Throwable $exception) {
            return Response::create([], 500);
        }
        return Response::create([], 201);
    }

    /**
     * Edit question
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $question = Question::find($id);
        if(!$question) {
            return Response::create([], 404);
        }

        if($request->has('questionstring')) {
            $question->QuestionString = $request->input('questionstring');
        }
        if($request->has('questionimage')) {
            $question->QuestionImage = $request->input('questionimage');
        }
        if($request->has('correctanswerstring')) {
            $question->CorrectAnswerString = $request->input('correctanswerstring');
        }
        if($request->has('wronganswerstring')) {
            $question->WrongAnswerString = $request->input('wronganswerstring');
        }
        if($request->has('wronganswerstring2')) {
            $question->WrongAnswerString2 = $request->input('wronganswerstring2');
        }
        if($request->has('wronganswerstring3')) {
            $question->WrongAnswerString3 = $request->input('wronganswerstring3');
        }

        if($question->save()) {
            return Response::create([], 200);
        } else {
            return Response::create([], 500);
        }
    }

    /**
     * Remove the question for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function remove($id)
    {
        $question = Question::find($id);

        try {
            $question->delete();
            return Response::create([], 200);
        } catch (Throwable | QueryException $error) {
            return Response::create([], 500);
        }
    }
}
