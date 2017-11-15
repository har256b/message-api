<?php

namespace App\Http\Controllers;

use App\Message;
use App\Http\Resources\Message as MessageResource;
use App\Http\Resources\MessageCollection as MessageCollection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        return $this->sendSuccessResponse(new MessageCollection(Message::paginate(3)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function archive(Request $request)
    {
        return $this->sendSuccessResponse(new MessageCollection(Message::where('is_archived', true)->paginate(3)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return $this->sendSuccessResponse(new MessageResource(Message::find($id)));
    }

    /**
     * Update the message and sets as read.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function read(Request $request, $id)
    {
        return $this->sendSuccessResponse(new MessageResource(Message::find($id)));
    }

    /**
     * Update the message and sets as archived.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function archived(Request $request, $id)
    {
        return $this->sendSuccessResponse(new MessageResource(Message::find($id)));
    }
}
