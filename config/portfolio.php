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

    'whatsapp_number' => env('WHATSAPP_NUMBER', null),
    'whatsapp_message' => env('WHATSAPP_DEFAULT_MESSAGE', 'Hello Ahmad, I would like to discuss a project with you.'),
    'cv_url' => env('PORTFOLIO_CV_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Skills & Tech Stack Data
    |--------------------------------------------------------------------------
    |
    | Centralized technology categories and official logo definitions.
    | Easy to update without modifying Blade markup or CSS.
    |
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
