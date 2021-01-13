<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\FullTableEmailRendererStrategy;
use App\Tests\BaseTestCase;

class FullTableEmailRendererStrategyTest extends BaseTestCase
{
    public function testRender(): void
    {
        $eachRowEmailRendererStrategy = new FullTableEmailRendererStrategy($this->data);
        self::assertSame(['admin@admin.ru'], $eachRowEmailRendererStrategy->renderTo());
        self::assertSame([
            [
                'email' => 'alex@mail.com, dan@ya.ru',
                'age' => '67, 34',
                'name' => 'Alex Norton, Dan Hoff',
            ],
        ], $eachRowEmailRendererStrategy->renderBodyParams());
    }
}
