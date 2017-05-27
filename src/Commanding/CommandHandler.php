<?php

namespace Deskti\Chat\Commanding;

interface CommandHandler
{
    public function handle($command);
}
