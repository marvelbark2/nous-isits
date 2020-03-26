<?php

namespace App\Http\Controllers;

use App\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getall()
    {
        $messages = Message::take(200)->pluck('content');
        return $messages;
    }
    public function store()
    {
        $message = new Message();
        $content = request('message');
        $message->content = $content;
        $message->save();

        event(new MessageSent($content));

        return $content;
    }
}
