<?php

namespace App\Helpers;

class PrestasiHelper
{
    /**
     * Get award icon and color based on category
     * Uses fas fa-medal icon with Gold/Silver/Bronze colors based on ranking
     */
    public static function getAwardIcon(string $category): array
    {
        $categoryUpper = strtoupper($category);

        // JUARA Rankings with medal colors
        if (str_contains($categoryUpper, 'JUARA 1')) {
            return [
                'icon' => 'fas fa-medal',
                'bgColor' => 'from-yellow-400 to-yellow-500',
                'textColor' => 'text-yellow-600',
                'label' => 'Juara 1',
                'sortOrder' => 1,
            ];
        }

        if (str_contains($categoryUpper, 'JUARA 2')) {
            return [
                'icon' => 'fas fa-medal',
                'bgColor' => 'from-gray-300 to-gray-400',
                'textColor' => 'text-gray-600',
                'label' => 'Juara 2',
                'sortOrder' => 2,
            ];
        }

        if (str_contains($categoryUpper, 'JUARA 3')) {
            return [
                'icon' => 'fas fa-medal',
                'bgColor' => 'from-orange-400 to-orange-500',
                'textColor' => 'text-orange-600',
                'label' => 'Juara 3',
                'sortOrder' => 3,
            ];
        }

        // HARAPAN Rankings with medal colors (same as Juara)
        if (str_contains($categoryUpper, 'HARAPAN 1')) {
            return [
                'icon' => 'fas fa-medal',
                'bgColor' => 'from-yellow-400 to-yellow-500',
                'textColor' => 'text-yellow-600',
                'label' => 'Harapan 1',
                'sortOrder' => 4,
            ];
        }

        if (str_contains($categoryUpper, 'HARAPAN 2')) {
            return [
                'icon' => 'fas fa-medal',
                'bgColor' => 'from-gray-300 to-gray-400',
                'textColor' => 'text-gray-600',
                'label' => 'Harapan 2',
                'sortOrder' => 5,
            ];
        }

        if (str_contains($categoryUpper, 'HARAPAN 3')) {
            return [
                'icon' => 'fas fa-medal',
                'bgColor' => 'from-orange-400 to-orange-500',
                'textColor' => 'text-orange-600',
                'label' => 'Harapan 3',
                'sortOrder' => 6,
            ];
        }

        // Generic HARAPAN (no number)
        if (str_contains($categoryUpper, 'HARAPAN')) {
            return [
                'icon' => 'fas fa-medal',
                'bgColor' => 'from-blue-400 to-blue-500',
                'textColor' => 'text-blue-600',
                'label' => 'Harapan',
                'sortOrder' => 7,
            ];
        }

        // Default for other achievements
        return [
            'icon' => 'fas fa-trophy',
            'bgColor' => 'from-blue-500 to-indigo-600',
            'textColor' => 'text-blue-600',
            'label' => 'Prestasi',
            'sortOrder' => 99,
        ];
    }
}
