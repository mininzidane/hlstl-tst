<?php

declare(strict_types=1);

namespace App\Service;

class EachRowEmailRendererStrategy implements EmailRendererInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function renderTo(): array
    {
        $emails = [];
        foreach ($this->data as $row) {
            $emails[] = $row['email'];
        }

        return $emails;
    }

    public function renderBodyParams(): array
    {
        $params = [];
        foreach ($this->data as $row) {
            $params[] = [
                'email' => $row['email'],
                'age' => $row['age'],
                'name' => $row['name'],
            ];
        }

        return $params;
    }
}
