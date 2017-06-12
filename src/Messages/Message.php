<?php

namespace Deskti\Chat\Messages;

use Eloquent;
use Deskti\Chat\Conversations\Conversation;
use Deskti\Chat\Eventing\EventGenerator;
use Deskti\Chat\Chat;
use Deskti\Chat\Notifications\MessageNotification;

class Message extends Eloquent
{
    protected $fillable = ['body', 'user_id', 'type', 'conversation_id'];

    protected $table = 'messages';

    use EventGenerator;

    public function sender()
    {
        return $this->belongsTo(Chat::userModel(), 'user_id');
    }

    public function conversation()
    {
        return $this->belongsTo('Deskti\Chat\Conversations\Conversation', 'conversation_id');
    }

    /**
     * Adds a message to a conversation
     *
     * @param      Conversation  $conversation
     * @param      string        $body
     * @param      integer        $userId
     * @param      string        $type
     *
     * @return     Message
     */
    public function send(Conversation $conversation, $body, $userId, $type = 'text')
    {
        $message = $conversation->messages()->create([
            'body' => $body,
            'user_id' => $userId,
            'type' => $type,
        ]);

        $this->raise(new MessageWasSent($message));

        return $this;
    }

    /**
     * Deletes a message
     *
     * @param      integer  $messageId
     * @param      integer  $userId
     *
     * @return
     */
    public function trash($messageId, $userId)
    {
        return MessageNotification::where('user_id', $userId)
            ->where('message_id', $messageId)
            ->delete();
    }

    /**
     * marks message as read
     *
     * @param      integer  $messageId
     * @param      integer  $userId
     *
     * @return
     */
    public function messageRead($messageId, $userId)
    {
        return MessageNotification::where('user_id', $userId)
            ->where('message_id', $messageId)
            ->update(['is_seen' => 1]);
    }
}
