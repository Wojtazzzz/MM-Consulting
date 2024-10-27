<?php

declare(strict_types=1);

function showPrice(int|float $price): string {
	return number_format((float) $price, 2, ',', '') . ' zł';
}