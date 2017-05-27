<?php

namespace Deskti\Chat\Messages;

class SendMessageCommand
{
    public $senderId;
    public $body;
    public $conversation;

    public function __construct($conversation, $body, $senderId)
    {
        $this->conversation = $conversation;
        $this->body = $body;
        $this->senderId = $senderId;
    }
}