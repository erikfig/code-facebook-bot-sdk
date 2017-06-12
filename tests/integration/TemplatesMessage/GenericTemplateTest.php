<?php

namespace CodeBot\TemplatesMessage;

use CodeBot\Element\Button;
use CodeBot\Element\Product;
use PHPUnit\Framework\TestCase;

class GenericTemplateTest extends TestCase
{
    public function testListaComDoisProdutos()
    {
        $button = new Button('web_url', null, 'https://angular.io/');
        $product = new Product('Produto 1', 'https://media.licdn.com/mpr/mpr/AAEAAQAAAAAAAAqfAAAAJDQwZWJiNTdkLThiYjUtNGQ2YS1iMzJjLTRiMmQ5YjZiMDNiNw.png', 'Curso de angular', $button);

        $button = new Button('web_url', null, 'http://www.php.net/');
        $product2 = new Product('Produto 2', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1200px-PHP-logo.svg.png', 'Curso de PHP', $button);

        $template = new GenericTemplate(1234);
        $template->add($product);
        $template->add($product2);
        $actual = $template->message('qwe');

        $expected = [
            'recipient' => [
                'id' => 1234
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'elements' => [
                            [
                                'title' => 'Produto 1',
                                'subtitle' => 'Curso de angular',
                                'image_url' => 'https://media.licdn.com/mpr/mpr/AAEAAQAAAAAAAAqfAAAAJDQwZWJiNTdkLThiYjUtNGQ2YS1iMzJjLTRiMmQ5YjZiMDNiNw.png',
                                'default_action' => [
                                    'type'=>'web_url',
                                    'url'=>'https://angular.io/',
                                ],
                            ],
                            [
                                'title' => 'Produto 2',
                                'subtitle' => 'Curso de PHP',
                                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1200px-PHP-logo.svg.png',
                                'default_action' => [
                                    'type'=>'web_url',
                                    'url'=>'http://www.php.net/',
                                ],
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, $actual);
    }
}