<?php

declare(strict_types=1);

namespace App\Service;

class FullTableEmailRendererStrategy implements EmailRendererInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function renderTo(): array
    {
        return ['admin@admin.ru'];
    }

    public function renderBodyParams(): array
    {
        $emails = $ages = $names = [];
        foreach ($this->data as $row) {
            $emails[] = $row['email'];
            $ages[] = $row['age'];
            $names[] = $row['name'];
        }

        return [
            [
                'email' => implode(', ', $emails),
                'age' => implode(', ', $ages),
                'name' => implode(', ', $names),
            ]
        ];
    }
}
