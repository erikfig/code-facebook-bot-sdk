<?php

namespace CodeBot\TemplatesMessage;

use CodeBot\Message\Message;
use CodeBot\Element\ElementInterface;

interface TemplateInterface extends Message
{
    public function add(ElementInterface $element);
}