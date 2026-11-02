<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Hidden Repositories (Excluded from Public Portfolio Showcase)
    |--------------------------------------------------------------------------
    |
    | Repository names that should not appear on the homepage or projects index.
    | Matched case-insensitively and by repository identity.
    |
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
    | Curated Portfolio Repositories (Allowlist)
    |--------------------------------------------------------------------------
    |
    | Only repositories explicitly registered in this list are displayed.
    | New repositories created on GitHub will not automatically appear.
    | To add a new project to the portfolio in the future, register its name here.
    |
    */
    'curated_repositories' => [
        // Top 9 Priority Featured Projects
        'sistem-manajement-usaha-layanan-web',
        'simaul',
        'sistem-manajement-usaha-layanan-mobile',
        'simaul-mobile',
        'sistem-pemasaran-otomatis-terpadu',
        'atur-uang-apps',
        'Locatrip',
        'locatrip',
        'Grwonesia',
        'grwonesia',
        'grownesia',
        'CitySense',
        'citysense',
        'city-sense',
        'Sistem-Pendaftaran-Beasiswa',
        'sistem-pendaftaran-beasiswa',
        'sistem-manajemen-layanan',

        // Additional Curated Previous Projects
        'my-portfolio',
        'stunting-cerdas',
        'Movix',
        'movix',
    ],

    /*
    |--------------------------------------------------------------------------
    | Priority Project Slugs Order (Top 9 Showcase)
    |--------------------------------------------------------------------------
    */
    'priority_order' => [
        'simaul',
        'simaul-mobile',
        'sistem-pemasaran-otomatis-terpadu',
        'atur-uang-apps',
        'locatrip',
        'grownesia',
        'city-sense',
        'sistem-pendaftaran-beasiswa',
        'sistem-manajemen-layanan',
    ],

    /*
    |--------------------------------------------------------------------------
    | Curated Project Metadata & Descriptions
    |--------------------------------------------------------------------------
    |
    | Centralized structured metadata for editorial portfolio presentation.
    | Loaded from modular curated configuration file.
    |
    */
    'curated' => require __DIR__.'/projects_curated.php',
];
