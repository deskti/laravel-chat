<?php

namespace Deskti\Chat\Conversations;

use Eloquent;

class ConversationUser extends Eloquent
{
    protected $table = 'conversation_user';

    public function conversation()
    {
        return $this->belongsTo('Deskti\Chat\Conversations\Conversation', 'conversation_id');
    }
}
