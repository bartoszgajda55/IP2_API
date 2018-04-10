<?php

namespace App\Http\Controllers;

use App\Blacklist;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class BlacklistController extends Controller
{
    /**
     * Retrieve the ban for the given ID.
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

    /**
     * Create new ban
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $ban = new Blacklist();
        $ban->UserID = $request->input('userid');
        $ban->BanReason = $request->input('reason');

        try {
            $ban->save();
            return Response::create([], 201);
        } catch (Throwable | QueryException $error) {
            return Response::create([], 500);
        }
    }

    /**
     * Remove the ban for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function remove($id)
    {
        $ban = Blacklist::find($id);

        try {
            $ban->delete();
            return Response::create([], 200);
        } catch (Throwable | QueryException $error) {
            return Response::create([], 500);
        }
    }

}
