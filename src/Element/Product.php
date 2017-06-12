<?php

namespace CodeBot\Element;

class Product implements ElementInterface
{
    private $title;
    private $image_url;
    private $subtitle;
    private $default_action;
    private $buttons;

    public function __construct(string $title, ? string $image_url = null, ? string $subtitle = null, Button $default_action = null)
    {
        $this->title = $title;
        $this->image_url = $image_url;
        $this->subtitle = $subtitle;
        $this->default_action = $default_action;
    }

    public function add(Button $element)
    {
        $this->buttons[] = $element->get();
    }


    public function get() :array
    {
        $result['title'] = $this->title;

        if ($this->image_url !== null) {
            $result['image_url'] = $this->image_url;
        }

        if ($this->subtitle !== null) {
            $result['subtitle'] = $this->subtitle;
        }

        if ($this->default_action !== null) {
            $default_action = $this->default_action->get();
            unset($default_action['title']);
            $result['default_action'] = $default_action;
        }

        if ($this->buttons !== null) {
            $result['buttons'] = $this->buttons;
        }

        return $result;
    }
}