<?php

namespace App\Helpers;

class PrestasiHelper
{
    /**
     * Get award emoji and color based on category
     */
    public static function getAwardIcon(string $category): array
    {
        $categoryUpper = strtoupper($category);

        // Check for "JUARA 1"
        if (str_contains($categoryUpper, 'JUARA 1')) {
            return [
                'emoji' => '🥇',
                'bgColor' => 'from-yellow-300 to-yellow-500',
                'textColor' => 'text-yellow-600',
                'label' => 'Juara 1',
            ];
        }

        // Check for "JUARA 2"
        if (str_contains($categoryUpper, 'JUARA 2')) {
            return [
                'emoji' => '🥈',
                'bgColor' => 'from-gray-400 to-gray-500',
                'textColor' => 'text-gray-700',
                'label' => 'Juara 2',
            ];
        }

        // Check for "JUARA 3"
        if (str_contains($categoryUpper, 'JUARA 3')) {
            return [
                'emoji' => '🥉',
                'bgColor' => 'from-orange-400 to-amber-500',
                'textColor' => 'text-amber-700',
                'label' => 'Juara 3',
            ];
        }

        // Check for "HARAPAN"
        if (str_contains($categoryUpper, 'HARAPAN')) {
            return [
                'emoji' => '⭐',
                'bgColor' => 'from-blue-400 to-blue-500',
                'textColor' => 'text-blue-600',
                'label' => 'Harapan',
            ];
        }

        // Default for other achievements
        return [
            'emoji' => '🏆',
            'bgColor' => 'from-blue-500 to-indigo-600',
            'textColor' => 'text-blue-600',
            'label' => 'Prestasi',
        ];
    }
}
