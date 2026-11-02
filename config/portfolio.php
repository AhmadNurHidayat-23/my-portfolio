<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Portfolio Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration options for Ahmad Nur Hidayat's personal portfolio.
    | Set WHATSAPP_NUMBER and PORTFOLIO_CV_URL in your .env file.
    |
    */

    'whatsapp_number' => env('WHATSAPP_NUMBER', '6282126824313'),
    'whatsapp_message' => env('WHATSAPP_DEFAULT_MESSAGE', 'Halo Ahmad, saya melihat portofolio Anda dan tertarik untuk berdiskusi mengenai kerja sama atau proyek.'),
    'cv_url' => env('PORTFOLIO_CV_URL', '/documents/CV-Ahmad-Nur-Hidayat.pdf'),
    'email' => env('PORTFOLIO_EMAIL', 'nurhidayata062.stu@pnc.ac.id'),

    /*
    |--------------------------------------------------------------------------
    | Professional Developer Services (What I Do)
    |--------------------------------------------------------------------------
    */
    'services' => [
        [
            'number' => '01',
            'title' => 'Web Development',
            'description' => 'Membangun website dan aplikasi web yang responsif, modern, dan sesuai kebutuhan bisnis.',
        ],
        [
            'number' => '02',
            'title' => 'Mobile App Development',
            'description' => 'Mengembangkan aplikasi mobile dengan pengalaman pengguna yang intuitif dan fungsional.',
        ],
        [
            'number' => '03',
            'title' => 'Backend & API Development',
            'description' => 'Membangun sistem backend, database, dan API untuk mendukung aplikasi yang terintegrasi.',
        ],
        [
            'number' => '04',
            'title' => 'UI Development',
            'description' => 'Mengubah rancangan antarmuka menjadi website interaktif, presisi, dan responsif.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Hidden Repositories (Excluded from Public Portfolio Showcase)
    |--------------------------------------------------------------------------
    */
    'hidden_repositories' => [
        'Pweb',
        'WEB_FILM',
        'Movix_v2',
        'Movix_Fix',
        'AhmadNurHidayat-23.github.io',
        'Siroyo',
        'AhmadNurHidayat-23',
        'rupakata-pembuat-poster-tipografi',
        'passcraft-secure-password-generator',
        'paletteforge-generator-palet-warna',
        'taskly-sistem-manajemen-tugas',
        'shortify-sistem-penyingkat-tautan',
        'devlinks-sistem-manajemen-tautan-profil',
    ],

    /*
    |--------------------------------------------------------------------------
    | Technology Stack (Unified Logo Gallery)
    |--------------------------------------------------------------------------
    |
    | Flat list of official tools and technologies with SVG icon paths.
    | Rendered in a single responsive CSS grid with brand color hover states.
    |
    */
    'technologies' => [
        ['name' => 'HTML5', 'icon' => 'icons/technologies/html5.svg'],
        ['name' => 'CSS3', 'icon' => 'icons/technologies/css3.svg'],
        ['name' => 'JavaScript', 'icon' => 'icons/technologies/javascript.svg'],
        ['name' => 'React', 'icon' => 'icons/technologies/react.svg'],
        ['name' => 'Tailwind CSS', 'icon' => 'icons/technologies/tailwindcss.svg'],
        ['name' => 'Blade', 'icon' => 'icons/technologies/blade.svg'],
        ['name' => 'PHP', 'icon' => 'icons/technologies/php.svg'],
        ['name' => 'Laravel', 'icon' => 'icons/technologies/laravel.svg'],
        ['name' => 'C++', 'icon' => 'icons/technologies/cpp.svg'],
        ['name' => 'Flutter', 'icon' => 'icons/technologies/flutter.svg'],
        ['name' => 'Dart', 'icon' => 'icons/technologies/dart.svg'],
        ['name' => 'MySQL', 'icon' => 'icons/technologies/mysql.svg'],
        ['name' => 'MariaDB', 'icon' => 'icons/technologies/mariadb.svg'],
        ['name' => 'Git', 'icon' => 'icons/technologies/git.svg'],
        ['name' => 'GitHub', 'icon' => 'icons/technologies/github.svg'],
        ['name' => 'Vite', 'icon' => 'icons/technologies/vite.svg'],
        ['name' => 'Composer', 'icon' => 'icons/technologies/composer.svg'],
        ['name' => 'NPM', 'icon' => 'icons/technologies/npm.svg'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Legacy Skill Categories (Preserved for backwards compatibility)
    |--------------------------------------------------------------------------
    */
    'skills' => [
        [
            'category' => 'Frontend Development',
            'index' => '01',
            'items' => [
                ['name' => 'HTML5', 'icon' => 'icons/technologies/html5.svg'],
                ['name' => 'CSS3', 'icon' => 'icons/technologies/css3.svg'],
                ['name' => 'JavaScript', 'icon' => 'icons/technologies/javascript.svg'],
                ['name' => 'React', 'icon' => 'icons/technologies/react.svg'],
                ['name' => 'Tailwind CSS', 'icon' => 'icons/technologies/tailwindcss.svg'],
                ['name' => 'Blade', 'icon' => 'icons/technologies/blade.svg'],
            ],
        ],
        [
            'category' => 'Backend Development',
            'index' => '02',
            'items' => [
                ['name' => 'PHP', 'icon' => 'icons/technologies/php.svg'],
                ['name' => 'Laravel', 'icon' => 'icons/technologies/laravel.svg'],
            ],
        ],
        [
            'category' => 'Programming Languages',
            'index' => '03',
            'items' => [
                ['name' => 'C++', 'icon' => 'icons/technologies/cpp.svg'],
                ['name' => 'Dart', 'icon' => 'icons/technologies/dart.svg'],
            ],
        ],
        [
            'category' => 'Mobile Development',
            'index' => '04',
            'items' => [
                ['name' => 'Flutter', 'icon' => 'icons/technologies/flutter.svg'],
            ],
        ],
        [
            'category' => 'Database',
            'index' => '05',
            'items' => [
                ['name' => 'MySQL', 'icon' => 'icons/technologies/mysql.svg'],
                ['name' => 'MariaDB', 'icon' => 'icons/technologies/mariadb.svg'],
            ],
        ],
        [
            'category' => 'Development Tools',
            'index' => '06',
            'items' => [
                ['name' => 'Git', 'icon' => 'icons/technologies/git.svg'],
                ['name' => 'GitHub', 'icon' => 'icons/technologies/github.svg'],
                ['name' => 'Vite', 'icon' => 'icons/technologies/vite.svg'],
                ['name' => 'Composer', 'icon' => 'icons/technologies/composer.svg'],
                ['name' => 'NPM', 'icon' => 'icons/technologies/npm.svg'],
            ],
        ],
    ],
];
