<?php

use Illuminate\Database\Seeder;
use App\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->truncate();
        $data = json_decode(File::get('database/seeds/data/messages_sample.json'));
        $messages = $data->messages;
        foreach ($messages as $message) {
        	Message::insert([
        		'uid' => $message->uid,
        		'sender' => $message->sender,
        		'subject' => $message->subject,
        		'message' => $message->message,
        		'time_sent' => $message->time_sent,
        	]);
        }
    }
}
