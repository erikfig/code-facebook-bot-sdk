<?php

namespace CodeBot\Resources;

use CodeBot\Bot;
use CodeBot\SenderRequest;

class Resolver
{
    private $resources = [];

    public function register(string $class)
    {
        if (!in_array($class, $this->resources)) {
            $this->resources[] = $class;
        }
    }

    public function resolver(SenderRequest $sender, Bot $bot)
    {
        foreach ($this->resources as &$resource) {
            if ($this->instance($resource, $sender, $bot)) {
                return true;
            }
        }

        return false;
    }

    private function instance(string $resource, SenderRequest $sender, Bot $bot)
    {
        $interfaces = class_implements($resource);

        if (!isset($interfaces[ResourceInterface::class])) {
            throw new \Exception('Class must be implements ' . ResourceInterface::class . ' interface');
        }

        $object = new $resource;
        return $object($sender, $bot);
    }
}