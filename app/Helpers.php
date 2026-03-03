<?php

use App\Helpers\PrestasiHelper;

if (!function_exists('getAwardIcon')) {
    /**
     * Get award icon and color based on category
     */
    function getAwardIcon(string $category): array
    {
        return PrestasiHelper::getAwardIcon($category);
    }
}
