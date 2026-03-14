<?php

namespace App\Helpers;

class PrestasiHelper
{
    public static function getAwardIcon(string $category): array
    {
        $categoryUpper = strtoupper($category);

        if (str_contains($categoryUpper, 'JUARA 1') || str_contains($categoryUpper, 'HARAPAN 1')) {
            return [
                'icon'      => 'fas fa-medal',
                'bgStyle'   => 'background: linear-gradient(to bottom right, #eab308, #ca8a04)',
                'textStyle' => 'color: #a16207',
                'label'     => str_contains($categoryUpper, 'JUARA') ? 'Juara 1' : 'Harapan 1',
                'sortOrder' => str_contains($categoryUpper, 'JUARA') ? 1 : 4,
                // legacy — biarkan kosong agar tidak error di file lain
                'bgColor'   => '',
                'textColor' => '',
            ];
        }

        if (str_contains($categoryUpper, 'JUARA 2') || str_contains($categoryUpper, 'HARAPAN 2')) {
            return [
                'icon'      => 'fas fa-medal',
                'bgStyle'   => 'background: linear-gradient(to bottom right, #9ca3af, #6b7280)',
                'textStyle' => 'color: #4b5563',
                'label'     => str_contains($categoryUpper, 'JUARA') ? 'Juara 2' : 'Harapan 2',
                'sortOrder' => str_contains($categoryUpper, 'JUARA') ? 2 : 5,
                'bgColor'   => '',
                'textColor' => '',
            ];
        }

        if (str_contains($categoryUpper, 'JUARA 3') || str_contains($categoryUpper, 'HARAPAN 3')) {
            return [
                'icon'      => 'fas fa-medal',
                'bgStyle'   => 'background: linear-gradient(to bottom right, #f97316, #ea580c)',
                'textStyle' => 'color: #c2410c',
                'label'     => str_contains($categoryUpper, 'JUARA') ? 'Juara 3' : 'Harapan 3',
                'sortOrder' => str_contains($categoryUpper, 'JUARA') ? 3 : 6,
                'bgColor'   => '',
                'textColor' => '',
            ];
        }

        if (str_contains($categoryUpper, 'HARAPAN')) {
            return [
                'icon'      => 'fas fa-medal',
                'bgStyle'   => 'background: linear-gradient(to bottom right, #3b82f6, #2563eb)',
                'textStyle' => 'color: #1d4ed8',
                'label'     => 'Harapan',
                'sortOrder' => 7,
                'bgColor'   => '',
                'textColor' => '',
            ];
        }

        if (str_contains($categoryUpper, 'DELEGASI')) {
            return [
                'icon'      => 'fas fa-flag',
                'bgStyle'   => 'background: linear-gradient(to bottom right, #15803d, #22c55e)',
                'textStyle' => 'color: #15803d',
                'label'     => 'Delegasi',
                'sortOrder' => 8,
                'bgColor'   => '',
                'textColor' => '',
            ];
        }

        return [
            'icon'      => 'fas fa-trophy',
            'bgStyle'   => 'background: linear-gradient(to bottom right, #6366f1, #4f46e5)',
            'textStyle' => 'color: #4338ca',
            'label'     => 'Prestasi',
            'sortOrder' => 99,
            'bgColor'   => '',
            'textColor' => '',
        ];
    }
}