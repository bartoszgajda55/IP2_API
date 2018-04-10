<?php

namespace App\Http\Controllers;

use App\Blacklist;
use App\FeaturedQuiz;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlacklistController extends Controller
{
    /**
     * Retrieve the quiz for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $ban = Blacklist::find($id);
        if($ban) {
            return Response::create($ban, 200);
        } else {
            return Response::create([], 404);
        }
    }
}
