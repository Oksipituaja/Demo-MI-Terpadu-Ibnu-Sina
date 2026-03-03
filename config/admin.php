<?php

// Add to config/app.php or create this as separate config file

return [
    'admin' => [
        // File upload configuration
        'file_upload' => [
            'limits' => [
                'news_featured_image' => 2048,          // 2MB - smaller for article headlines
                'teachers_photo' => 2048,               // 2MB - profile photos
                'gallery_image' => 5120,                // 5MB - gallery items
                'facilities_image' => 5120,             // 5MB - facility photos
                'prestasi_image' => 5120,               // 5MB - achievement/award proof
                'about_image' => 5120,                  // 5MB - about section images
                'default_max' => 5120,                  // 5MB - fallback for unspecified types
            ],
            'mimes' => ['jpeg', 'png', 'jpg', 'gif', 'svg', 'webp', 'avif'],
            'mimes_string' => 'jpeg,png,jpg,gif,svg,webp,avif',
        ],

        // Pagination configuration
        'pagination' => [
            'news' => 15,           // 15 per page
            'teachers' => 20,       // 20 per page
            'galleries' => 20,      // 20 per page (good for grid)
            'agendas' => 15,        // 15 per page
            'facilities' => 12,     // 12 per page (for nice grid layout)
            'prestasi' => 15,       // 15 per page
            'abouts' => 10,         // Usually only a few sections
            'registrations' => 25,  // More entries likely
            'default' => 15,        // Fallback
        ],

        // About page special sections (fixed keys)
        'about_sections' => [
            'hero_image' => 'Hero Image',
            'principal_message' => 'Principal Message',
            'school_vision' => 'School Vision',
            'school_mission' => 'School Mission',
            'school_values' => 'School Values',
        ],

        // Facility status options
        'facility_kondisi' => [
            'tersedia' => 'Tersedia (Available)',
            'perbaikan' => 'Perbaikan (Under Maintenance)',
            'belum_ada' => 'Belum Ada (Not Yet Available)',
            'akan_ada' => 'Akan Ada (Planned)',
        ],

        // Agenda status options
        'agenda_status' => [
            'upcoming' => 'Upcoming',
            'ongoing' => 'Ongoing',
            'completed' => 'Completed',
        ],
    ],
];
