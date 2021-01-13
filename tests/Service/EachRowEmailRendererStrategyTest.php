<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\EachRowEmailRendererStrategy;
use App\Tests\BaseTestCase;

class EachRowEmailRendererStrategyTest extends BaseTestCase
{
    public function testRender(): void
    {
        $eachRowEmailRendererStrategy = new EachRowEmailRendererStrategy($this->data);
        self::assertSame(['alex@mail.com', 'dan@ya.ru'], $eachRowEmailRendererStrategy->renderTo());
        self::assertSame([
            [
                'email' => 'alex@mail.com',
                'age' => '67',
                'name' => 'Alex Norton',
            ],
            [
                'email' => 'dan@ya.ru',
                'age' => '34',
                'name' => 'Dan Hoff',
            ],
        ], $eachRowEmailRendererStrategy->renderBodyParams());
    }
}
