<?php

namespace luhn;

class Luhn
{
    private static function calcCheckSum(string $num, $dblEven)
    {
        if (!ctype_digit($num)) {
            echo 'Error: The string does not contain only numbers.';

            return false;
        }

        $len = strlen($num);
        $type = $len % 2;

        for ($i = 0; $i < $len; $i++) {
            if ($dblEven ? ($i % 2) !== $type : ($i % 2) === $type) {
                $num[$i] = array_sum(str_split($num[$i] * 2));
            }
        }

        return $dblEven
            ? substr(array_sum(str_split($num)) * 9, -1, 1)
            : array_sum(str_split($num)) % 10 === 0;
    }

    public static function genCheckDigit(string $num)
    {
        return self::calcCheckSum($num, true);
    }

    public static function validate(string $num)
    {
        return self::calcCheckSum($num, false);
    }
}
