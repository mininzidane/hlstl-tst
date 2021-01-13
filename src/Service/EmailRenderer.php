<?php

declare(strict_types=1);

namespace App\Service;

use App\Database\UserData;
use Psr\Log\InvalidArgumentException;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class EmailRenderer
{
    private const TEMPLATE_ID = 'index.html';

    public const FULL_TABLE_STRATEGY = 'full';
    public const EACH_ROW_STRATEGY = 'row';

    public function renderEmails(string $strategy, string $template): array
    {
        $data = UserData::getAllRows();

        /** @var EmailRendererInterface $strategyInstance */
        switch ($strategy) {
            case self::FULL_TABLE_STRATEGY:
                $strategyInstance = new FullTableEmailRendererStrategy($data);
                break;
            case self::EACH_ROW_STRATEGY:
                $strategyInstance = new EachRowEmailRendererStrategy($data);
                break;
            default:
                throw new InvalidArgumentException("Invalid strategy: {$strategy}");
        }

        $loader = new ArrayLoader([
            self::TEMPLATE_ID => nl2br($template),
        ]);
        $twig = new Environment($loader);

        $recipientsList = $strategyInstance->renderTo();
        $bodyParamsList = $strategyInstance->renderBodyParams();
        $bodyTexts = [];
        foreach ($bodyParamsList as $bodyParams) {
            $bodyTexts[] = $twig->render(self::TEMPLATE_ID, $bodyParams);
        }

        $data = [];
        foreach ($bodyTexts as $i => $bodyText) {
            $data[] = [
                'to' => $recipientsList[$i] ?? $recipientsList[0],
                'body' => $bodyText,
            ];
        }

        return $data;
    }
}
