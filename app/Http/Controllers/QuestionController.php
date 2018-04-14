<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    /**
     * Create a new question
     *
     * @param  Request  $request
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

        if($question->save()) {
            return Response::create([$question], 201);
        } else {
            return Response::create([], 500);
        }
    }
}
