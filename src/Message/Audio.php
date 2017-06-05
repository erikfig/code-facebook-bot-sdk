<?php

namespace CodeBot\Message;

class Audio implements Message
{
    private $recipientId;

    public function __construct(string $recipientId)
    {
        $this->recipientId = $recipientId;
    }
    public function message(string $messageText) :array
    {
        return [
            'recipient' => [
                'id'=>$this->recipientId
            ],
            'message' => [
                'attachment' => [
                    'type' => 'audio',
                    'payload' => [
                        'url' => $messageText
                    ]
                ]
            ]
        ];
    }
}