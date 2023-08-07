<?php

namespace Printu\Exercises;

class Hash
{
    private const HASH_KEY = '5823679';

    public static function hashOrder(int $number): string
    {
        $hashedValue = bcmod(bcmul($number, self::HASH_KEY), '10000000');

        return str_pad($hashedValue, 7, '0', STR_PAD_LEFT);
    }
}
