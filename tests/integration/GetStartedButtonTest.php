<?php

namespace CodeBot;

use PHPUnit\Framework\TestCase;

class GetStartedButtonTest extends TestCase
{
    public function testAddGetStartedButton()
    {
        $data = (new GetStartedButton())->add('iniciar');
        $callSendApi = new CallSendApi('AQUI_VAI_SEU_PAGE_ACCESS_TOKEN');
        $result = $callSendApi->make($data, CallSendApi::URL_PROFILE);

        $this->assertTrue(is_string($result));
    }

    public function testRemoveGetStartedButton()
    {
        $data = (new GetStartedButton())->remove();
        $callSendApi = new CallSendApi('AQUI_VAI_SEU_PAGE_ACCESS_TOKEN');
        $result = $callSendApi->make($data, CallSendApi::URL_PROFILE, 'DELETE');

        $this->assertTrue(is_string($result));
    }
}