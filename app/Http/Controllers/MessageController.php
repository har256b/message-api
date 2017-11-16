<?php

namespace App\Http\Controllers;

use App\Message;
use App\Repositories\EloquentMessageRepository as MessageRepository;
use App\Http\Resources\Message as MessageResource;
use App\Http\Resources\MessageCollection as MessageCollection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    /**
     * @var MessageRepository $messageRepository
     */
    private $messageRepository;

    /**
     * Constructor
     *
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        // // Adding pagination criteria
        $criteria = $request->only(['page', 'per_page']);
        if (!array_key_exists('per_page', $criteria)) {
            $criteria['per_page'] = env('PAGE_LIMIT');
        }
        $messages = $this->messageRepository->findBy([]);

        return $this->sendSuccessResponse(new MessageCollection($messages));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function archive(Request $request)
    {
        // // Adding pagination criteria
        $criteria = $request->only(['page', 'per_page']);
        if (!array_key_exists('per_page', $criteria)) {
            $criteria['per_page'] = env('PAGE_LIMIT');
        }

        // Archived messages criteria
        $criteria['is_archived'] = true;
        $messages = $this->messageRepository->findBy($criteria);

        return $this->sendSuccessResponse(new MessageCollection($messages));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        // Find message by given ID
        $message = $this->messageRepository->findOne($id);

        // If $message is not avalid Message object i.e. null for invalid ID
        if (!$message instanceof Message) {
            return $this->sendNotFoundResponse("Message with id {$id} doesn't exist");
        }

        return $this->sendSuccessResponse(new MessageResource($message));
    }

    /**
     * Update the message and sets as read.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function read(Request $request, $id)
    {
        // Find message by given ID
        $message = $this->messageRepository->findOne($id);

        // If $message is not avalid Message object i.e. null for invalid ID
        if (!$message instanceof Message) {
            return $this->sendNotFoundResponse("Message with id {$id} doesn't exist.");
        }

        // Updating message to set as read
        $message = $this->messageRepository->update($message, [
            'is_read' => true,
            'time_read' => time(),
        ]);

        return $this->sendSuccessResponse(new MessageResource($message));
    }

    /**
     * Update the message and sets as archived.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function archived(Request $request, $id)
    {
        // Find message by given ID
        $message = $this->messageRepository->findOne($id);

        // If $message is not avalid Message object i.e. null for invalid ID
        if (!$message instanceof Message) {
            return $this->sendNotFoundResponse("Message with id {$id} doesn't exist.");
        }

        // Updating message to set as read
        $message = $this->messageRepository->update($message, [
            'is_archived' => true,
            'time_archived' => time(),
        ]);

        return $this->sendSuccessResponse(new MessageResource($message));
    }
}
