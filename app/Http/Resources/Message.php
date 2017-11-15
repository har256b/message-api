<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Message extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'message_id' => $this->uid,
            'subject' => $this->subject,
            'sender' => $this->sender,
            'message' => $this->message,
            'read' => (boolean) $this->is_read,
            'archived' => (boolean) $this->is_archived,
        ];
    }
}
