<?php

namespace App\Http\Controllers;

use App\Message;
use App\Http\Resources\Message as MessageResource;
use App\Http\Resources\MessageCollection as MessageCollection;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return (new MessageCollection(Message::paginate(3)))->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        return (new MessageCollection(Message::where('is_archived', true)->paginate(3)))->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return (new MessageResource(Message::find($id)))->response()->setStatusCode(200);
    }

    /**
     * Update the message and sets as read.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function read(Request $request, $id)
    {
        return (new MessageResource(Message::find($id)))->response()->setStatusCode(200);
    }

    /**
     * Update the message and sets as archived.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archived(Request $request, $id)
    {
        return (new MessageResource(Message::find($id)))->response()->setStatusCode(200);
    }
}
