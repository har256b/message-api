<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $primaryKey = 'uid';
	
    protected $fillable = [
    	'sender',
    	'subject',
    	'message',
    	'time_sent',
    ];

    public $timestamps = false;
}
