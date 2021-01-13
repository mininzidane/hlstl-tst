<?php

declare(strict_types=1);

namespace App\Service;

interface EmailRendererInterface
{
    public function renderTo(): array;

    public function renderBodyParams(): array;
}
