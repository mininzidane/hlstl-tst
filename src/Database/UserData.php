<?php

declare(strict_types=1);

namespace App\Database;

class UserData
{
    public static function getAllRows(): array
    {
        $data = [
            [
                '1',
                'alex@mail.com',
                '67',
                'Alex Norton',
            ],
            [
                '2',
                'mary@gmail.com',
                '18',
                'Marry Shawn',
            ],
            [
                '3',
                'dan@ya.ru',
                '34',
                'Dan Hoff',
            ],
            [
                '4',
                'alexey@mail.com',
                '50',
                'Alexey Ivanov',
            ],
        ];

        return array_map(function (array $row) {
            return array_combine(['user_id', 'email', 'age', 'name'], $row);
        }, $data);
    }
}
