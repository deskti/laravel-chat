<?php

namespace Musonza\Chat\Commanding;

interface CommandHandler
{
    public function handle($command);
}
