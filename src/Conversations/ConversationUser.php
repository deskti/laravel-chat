<?php

namespace Musonza\Chat\Conversations;

use Eloquent;

class ConversationUser extends Eloquent
{
    protected $table = 'conversation_user';

    public function conversation()
    {
        return $this->belongsTo('Musonza\Chat\Conversations\Conversation', 'conversation_id');
    }
}
