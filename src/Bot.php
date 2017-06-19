<?php

namespace CodeBot;

class Bot
{
    private $senderId;
    private $pageAccessToken;

    public function setSender(string $senderId)
    {
        $this->senderId = $senderId;
        return $this;
    }

    public function pageAccessToken(string $pageAccessToken)
    {
        $this->pageAccessToken = $pageAccessToken;
        return $this;
    }

    public function message(string $type, string $message)
    {
        $type = $this->load($type, 'CodeBot\Message');
        $message = $type->message($message);
        return $this->callSendApi($message);
    }

    public function template(string $type, string $message, array $elements, array $config = [])
    {
        $type = $this->load($type.'Template', 'CodeBot\TemplatesMessage');

        foreach ($config as $method => $params) {
            call_user_func_array([$type, $method], $params);
        }

        foreach ($elements as $element) {
            $type->add($element);
        }

        $message = $type->message($message);
        return $this->callSendApi($message);
    }

    public function addGetStartedButton(string $postback)
    {
        $data = (new GetStartedButton())->add($postback);
        return $this->callSendApi($data, CallSendApi::URL_PROFILE);
    }

    public function removeGetStartedButton()
    {
        $data = (new GetStartedButton())->remove();
        return $this->callSendApi($data, CallSendApi::URL_PROFILE, 'DELETE');
    }

    public function addMenu(string $locale, string $composer_input_disabled, array $call_to_actions)
    {
        $menu = new MenuManager($locale, $composer_input_disabled);

        foreach ($call_to_actions as $action) {
            $menu->callToAction($action['id'], $action['type'], $action['title'], $action['parent_id'], $action['value']);
        }

        return $this->callSendApi($menu->toArray(), CallSendApi::URL_PROFILE);
    }

    public function removeMenu()
    {
        $data = [
            'fields' => [
                'persistent_menu'
            ]
        ];

        return $this->callSendApi($data, CallSendApi::URL_PROFILE, 'DELETE');
    }

    private function load($class, $namespace)
    {
        $class = ucfirst($class);
        $class = $namespace .'\\' . $class;
        return new $class($this->senderId);
    }

    private function callSendApi(array $message, string $url = null, $method = 'POST') :string
    {
        $callSendApi = new CallSendApi($this->pageAccessToken);
        return $callSendApi->make($message, $url, $method);
    }
}