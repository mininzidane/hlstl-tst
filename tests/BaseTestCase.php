<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BaseTestCase extends KernelTestCase
{
    private const DATA = [
        [
            '1',
            'alex@mail.com',
            '67',
            'Alex Norton',
        ],
        [
            '3',
            'dan@ya.ru',
            '34',
            'Dan Hoff',
        ],
    ];

    protected array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();

        $this->data = array_map(function (array $row) {
            return array_combine(['user_id', 'email', 'age', 'name'], $row);
        }, self::DATA);
    }
}
