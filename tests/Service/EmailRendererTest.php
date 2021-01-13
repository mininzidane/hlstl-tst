<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\EmailRenderer;
use App\Tests\BaseTestCase;

class EmailRendererTest extends BaseTestCase
{
    private $emailRenderer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->emailRenderer = self::$container->get(EmailRenderer::class);
    }

    public function testRenderEmails(): void
    {
        $template = 'Отчет за сегодня. В системе зарегистрировались: {{name}}. Их возраст соответственно: {{age}}. А вот их адреса: {{email}}.';
        $bodies = $this->emailRenderer->renderEmails(EmailRenderer::EACH_ROW_STRATEGY, $template);
        self::assertSame('Отчет за сегодня. В системе зарегистрировались: Alex Norton. Их возраст соответственно: 67. А вот их адреса: alex@mail.com.', $bodies[0]['body']);
        self::assertSame('Отчет за сегодня. В системе зарегистрировались: Marry Shawn. Их возраст соответственно: 18. А вот их адреса: mary@gmail.com.', $bodies[1]['body']);
        self::assertSame('Отчет за сегодня. В системе зарегистрировались: Dan Hoff. Их возраст соответственно: 34. А вот их адреса: dan@ya.ru.', $bodies[2]['body']);
        self::assertSame('Отчет за сегодня. В системе зарегистрировались: Alexey Ivanov. Их возраст соответственно: 50. А вот их адреса: alexey@mail.com.', $bodies[3]['body']);

        $body = $this->emailRenderer->renderEmails(EmailRenderer::FULL_TABLE_STRATEGY, $template)[0]['body'];
        self::assertSame('Отчет за сегодня. В системе зарегистрировались: Alex Norton, Marry Shawn, Dan Hoff, Alexey Ivanov. Их возраст соответственно: 67, 18, 34, 50. А вот их адреса: alex@mail.com, mary@gmail.com, dan@ya.ru, alexey@mail.com.', $body);
    }
}
