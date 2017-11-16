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
            'sent_at' => date('d.m.Y H:i:s', $this->time_sent),
            'read' => (boolean) $this->is_read,
            'read_at' => ($this->time_read === null) ? null : date('d.m.Y H:i:s', $this->time_read),
            'archived' => (boolean) $this->is_archived,
            'archived_at' => ($this->time_archived === null) ? null : date('d.m.Y H:i:s', $this->time_archived),
        ];
    }
}
