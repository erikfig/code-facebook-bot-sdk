<?php

namespace CodeBot\Resources;

use CodeBot\Bot;
use CodeBot\SenderRequest;

interface ResourceInterface
{
    public function __invoke(SenderRequest $sender, Bot $bot) :bool;
}