<?php

namespace CodeBot\Message;

use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{
    public function testRetornaUmArray()
    {
        $actual = (new Text(1))->message('Oiii');
        $expected = [
            'recipient' => [
                'id'=>1
            ],
            'message' => [
                'text' => 'Oiii',
                'metadata' => 'DEVELOPER_DEFINED_METADATA'
            ]
        ];

        $this->assertEquals($actual, $expected);
    }
}