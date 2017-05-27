<?php

namespace Deskti\Chat\Messages;

use Deskti\Chat\Commanding\CommandHandler;
use Deskti\Chat\Eventing\EventDispatcher;

class SendMessageCommandHandler implements CommandHandler
{
    protected $message;
    protected $dispatcher;

    public function __construct(EventDispatcher $dispatcher, Message $message)
    {
        $this->dispatcher = $dispatcher;
        $this->message = $message;
    }

    public function handle($command)
    {
        $this->message->send($command->conversation, $command->body, $command->senderId);

        $this->dispatcher->dispatch($this->message->releaseEvents());
    }
}
