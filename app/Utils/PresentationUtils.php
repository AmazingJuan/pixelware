<?php

/*
 * PresentationUtils.php
 * Utility class for formatting and presenting data.
 * Author: Juan Avendaño
*/

namespace App\Utils;

class PresentationUtils
{
    /**
     * Format raw price (in cents) to a human-readable string with two decimal places (remember we don't use float in our app).
     */
    public static function formatCurrency(int $rawPrice): string
    {
        // Gather decimals and integers
        $priceIntegers = intdiv($rawPrice, 100);
        $priceDecimals = $rawPrice % 100;

        // Format price with commas and two decimal places
        return number_format($priceIntegers, 0, '', ',').'.'.str_pad($priceDecimals, 2, '0', STR_PAD_LEFT);
    }
}
