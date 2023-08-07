<?php

namespace Printu\Exercises;

class UniqueString
{
    private const REGEX_PATTERN = "/^[a-z]+$/";
    public const MIN_LENGTH = 1;
    public const MAX_LENGTH = 100000;

    public static function findUniqueString(string $s): int
    {
        static::validateString($s);

        $charactersCount = static::countCharacters($s);
        $stringLength = strlen($s);

        for ($i = 0; $i < $stringLength; $i++) {
            if ($charactersCount[$s[$i]] === 1) {
                return $i + 1;
            }
        }

        return -1;
    }

    protected static function validateString(string $string): void
    {
        static::validateChars($string);
        static::validateLength($string);
    }

    protected static function validateChars(string $string): void
    {
        if (!preg_match(self::REGEX_PATTERN, $string)) {
            throw new \InvalidArgumentException("String {$string} does not match regex.");
        }
    }

    protected static function validateLength(string $string): void
    {
        $stringLength = strlen($string);

        if ($stringLength <= self::MIN_LENGTH || $stringLength >= self::MAX_LENGTH) {

            throw new \InvalidArgumentException("String {$string} must be longer than " . self::MIN_LENGTH . " and less than " . self::MAX_LENGTH . " characters.");
        }
    }

    protected static function countCharacters(string $string): array
    {
        $arrayString = str_split($string);
        return array_count_values($arrayString);
    }
}
