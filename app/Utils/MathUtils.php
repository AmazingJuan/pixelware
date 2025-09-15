<?php

/*
 * MathUtils.php
 * Utility class for mathematical operations.
 * Author: Juan Avendaño
 */

namespace App\Utils;

class MathUtils
{
    public static function calculateNewAverage(float $previousAverage, int $newValue, int $totalCount): float
    {
        return (($previousAverage * $totalCount) + $newValue) / ($totalCount + 1);
    }
}
