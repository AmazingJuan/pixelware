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
        // Recalculate average using a known formula
        return (($previousAverage * $totalCount) + $newValue) / ($totalCount + 1);
    }
}
