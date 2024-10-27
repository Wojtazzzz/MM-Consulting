<?php

declare(strict_types=1);

/**
 * Format price and display it with currency symbol
 * @param int|float $price
 * @return string
 */
function showPrice(int|float $price): string {
	return number_format((float) $price, 2, ',', '') . ' zł';
}