<?php

namespace App\Models\Enum;

enum GenderEnum: string
{
    case Female = 'female';
    case Male = 'male';

    public static function getOptions(): array
    {
        $temp = [];
        collect(self::cases())->each(function($case) use (&$temp) {
            $temp[$case->value] = $case->name;
        });
        return $temp;
    }
}
