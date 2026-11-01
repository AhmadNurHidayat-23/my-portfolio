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
    | Curated Project Metadata & Concise Descriptions (10-16 words)
    |--------------------------------------------------------------------------
    |
    | Centralized structured metadata for editorial portfolio presentation.
    | Descriptions are single sentences, specific to system purpose.
    |
    */
    'curated' => [
        'simaul' => [
            'name' => 'SIMAUL — Sistem Manajemen Usaha Layanan',
            'matched_repos' => ['sistem-manajement-usaha-layanan-web', 'simaul'],
            'category' => 'Web Application',
            'image_type' => 'web',
            'technology' => 'PHP / Laravel',
            'year' => '2026',
            'description' => 'Sistem web untuk mengelola transaksi, jadwal antrean, dan operasional usaha jasa secara terpusat.',
            'overview' => 'SIMAUL dirancang untuk menyederhanakan manajemen operasional bisnis berbasis jasa seperti barbershop, salon, dan laundry. Platform ini mengintegrasikan pencatatan kasir, riwayat pesanan, ketersediaan staf, serta pemantauan stok bahan baku dalam satu antarmuka yang efisien.',
            'features' => [
                'Pencatatan kasir POS dan pelaporan transaksi harian otomatis.',
                'Penjadwalan antrean pelanggan dan alokasi kapster/staf layanan.',
                'Manajemen stok produk, pengingat batas minimum, dan rekap keuangan.',
            ],
            'technical' => 'Dibangun menggunakan Laravel dengan arsitektur MVC bersih, database relational MySQL/MariaDB, dan frontend Blade yang responsif.',
            'github_url' => 'https://github.com/AhmadNurHidayat-23/sistem-manajement-usaha-layanan-web',
            'live_url' => null,
            'is_live_github' => true,
            'gallery_images' => [
                'images/projects/simaul.png',
                'images/projects/simaul-laundry.jpg',
            ],
        ],
        'simaul-mobile' => [
            'name' => 'SIMAUL Mobile',
            'matched_repos' => ['sistem-manajement-usaha-layanan-mobile', 'simaul-mobile'],
            'category' => 'Mobile Application',
            'image_type' => 'mobile',
            'technology' => 'Flutter / Dart',
            'year' => '2026',
            'description' => 'Aplikasi mobile operasional kasir dan staf untuk pemantauan reservasi layanan dari smartphone.',
            'overview' => 'SIMAUL Mobile merupakan pendamping ekosistem web SIMAUL untuk perangkat Android dan iOS. Aplikasi ini memberikan fleksibilitas bagi staf dan kasir untuk mengelola reservasi dan memperbarui status pengerjaan secara real-time dari mana saja.',
            'features' => [
                'Antarmuka kasir cepat dan input nota transaksi berbasis mobile.',
                'Sinkronisasi data langsung dengan server backend web via REST API.',
                'Tampilan visual daftar reservasi dan ketersediaan slot layanan.',
            ],
            'technical' => 'Dibangun dengan Flutter & Dart, mengimplementasikan reactive state management dan komunikasi HTTP terenkripsi ke backend API.',
            'github_url' => 'https://github.com/AhmadNurHidayat-23/sistem-manajement-usaha-layanan-mobile',
            'live_url' => null,
            'is_live_github' => true,
            'gallery_images' => [
                'images/projects/simaul-mobile/screen-01-landing.png',
                'images/projects/simaul-mobile/screen-02-login.png',
                'images/projects/simaul-mobile/screen-03-katalog.png',
            ],
        ],
        'sistem-pemasaran-otomatis-terpadu' => [
            'name' => 'Sistem Pemasaran Otomatis Terpadu',
            'matched_repos' => ['sistem-pemasaran-otomatis-terpadu', 'pemasaran-otomatis'],
            'category' => 'Web Platform',
            'image_type' => 'web',
            'technology' => 'PHP / Laravel',
            'year' => '2026',
            'description' => 'Sistem otomasi distribusi pesan promosi terpadu untuk efisiensi kampanye pemasaran multi-kanal.',
            'overview' => 'Aplikasi terpadu untuk merancang, menjadwalkan, dan mengeksekusi kampanye pemasaran digital secara otomatis. Sistem mengoptimalkan pengiriman notifikasi berkala kepada pelanggan tanpa intervensi manual berulang.',
            'features' => [
                'Penyusunan alur kampanye terjadwal berbasis kriteria segmentasi.',
                'Otomasi pesan siaran dan pemantauan rasio keterbacaan promosi.',
                'Dashboard analitik performa konversi kampanye pemasaran.',
            ],
            'technical' => 'Dikembangkan dengan Laravel, memanfaatkan job queue scheduler untuk pemrosesan pesan latar belakang berkala.',
            'github_url' => null,
            'live_url' => null,
            'is_live_github' => false,
            'gallery_images' => [
                'images/projects/sistem-pemasaran-otomatis-terpadu.png',
            ],
        ],
        'atur-uang-apps' => [
            'name' => 'Atur Uang Apps',
            'matched_repos' => ['atur-uang-apps'],
            'category' => 'Mobile Application',
            'image_type' => 'mobile',
            'technology' => 'Flutter / Dart',
            'year' => '2026',
            'description' => 'Aplikasi pelacak keuangan personal untuk memantau pengeluaran bulanan dan arus kas harian.',
            'overview' => 'Atur Uang Apps membantu pengguna memelihara kesehatan finansial melalui pencatatan transaksi masuk dan keluar secara intuitif. Aplikasi menyediakan visualisasi grafik pengeluaran berdasarkan kategori agar pengeluaran tetap terkontrol.',
            'features' => [
                'Pencatatan pemasukan dan pengeluaran harian multi-kategori.',
                'Penetapan batas anggaran bulanan dengan indikator peringatan.',
                'Laporan rekapitulasi grafik arus kas mingguan dan bulanan.',
            ],
            'technical' => 'Menggunakan Flutter dengan penyimpanan data lokal SQLite/Hive untuk akses cepat tanpa memerlukan koneksi internet aktif.',
            'github_url' => 'https://github.com/crashyet/atur-uang-apps',
            'live_url' => null,
            'is_live_github' => true,
            'gallery_images' => [
                'images/projects/atur-uang/screen-01-home.png',
                'images/projects/atur-uang/screen-02-analisa.png',
                'images/projects/atur-uang/screen-03-riwayat.png',
            ],
        ],
        'locatrip' => [
            'name' => 'LocaTrip',
            'matched_repos' => ['Locatrip', 'locatrip', 'locatrip-app'],
            'category' => 'Mobile & Web Platform',
            'image_type' => 'web',
            'technology' => 'PHP / Laravel / Blade',
            'year' => '2026',
            'cover_image' => 'images/projects/locatrip.png',
            'description' => 'Platform direktori pariwisata terpadu dengan analitik geospatial dan asisten pemandu wisata cerdas SaiA.',
            'overview' => 'LocaTrip adalah platform smart tourism terintegrasi untuk mendigitalkan ekosistem pariwisata lokal dengan asisten pintar SaiA. Menghubungkan wisatawan, pengelola destinasi, dan pelaku UMKM melalui sistem reservasi tiket QR code, penilaian ulasan berbasis AI, dan monitoring analitik pendapatan secara real-time.',
            'features' => [
                'Tampilan interaktif sambutan SaiA untuk memandu wisatawan menjelajahi destinasi lokal.',
                'Dasbor analitik multi-peran (Super Admin, Admin Wisata, Admin UMKM, dan Wisatawan).',
                'Pemetaan geospatial interaktif (Geospatial Awareness) untuk persebaran kunjungan destinasi.',
                'Sistem reservasi tiket terpadu dengan validasi dinamis tiket QR code.',
            ],
            'technical' => 'Arsitektur web berbasis Laravel 12 dengan integrasi Google Gemini AI, Midtrans Payment Gateway, Leaflet.js, dan Chart.js.',
            'github_url' => 'https://github.com/Tisna7/Locatrip',
            'live_url' => 'https://locatrip.web.id/',
            'is_live_github' => true,
            'gallery_images' => [
                'images/projects/locatrip.png',
                'images/projects/locatrip/dashboard.png',
                'images/projects/locatrip/admin-dashboard.png',
            ],
        ],
        'grownesia' => [
            'name' => 'Grownesia',
            'matched_repos' => ['Grwonesia', 'grwonesia', 'grownesia'],
            'category' => 'Web Application',
            'image_type' => 'web',
            'technology' => 'PHP / Blade',
            'year' => '2026',
            'cover_image' => 'images/projects/grownesia.png',
            'description' => 'Platform digital pertanian berkelanjutan yang menghubungkan kelompok tani dengan pendanaan dan pasar.',
            'overview' => 'Grownesia (Grwonesia) merupakan platform kolaboratif pemberdayaan agrikultur. Proyek ini memfasilitasi transparansi pendanaan komoditas tani dan publikasi hasil panen berkualitas kepada calon pembeli.',
            'features' => [
                'Katalog kampanye proyek tani aktif beserta estimasi masa panen.',
                'Modul monitoring perkembangan lahan dan laporan berkala petani.',
                'Kanal komunikasi dan etalase komoditas panen siap distribusi.',
            ],
            'technical' => 'Dibangun dengan PHP Laravel, Blade Templating, dan integrasi payment gateway sandbox untuk alur simulasi pendanaan.',
            'github_url' => 'https://github.com/Tisna7/Grwonesia',
            'live_url' => null,
            'is_live_github' => true,
            'gallery_images' => [
                'images/projects/grownesia.png',
            ],
        ],
        'city-sense' => [
            'name' => 'City Sense',
            'matched_repos' => ['CitySense', 'citysense', 'city-sense'],
            'category' => 'Web Application',
            'image_type' => 'web',
            'technology' => 'JavaScript / Web API',
            'year' => '2025',
            'description' => 'Aplikasi web visualisasi data lingkungan perkotaan untuk pemantauan kualitas udara dan cuaca.',
            'overview' => 'CitySense menyajikan informasi interaktif kualitas udara, cuaca, dan indikator keberlanjutan kota pintar. Proyek ini dirancang secara editorial dan memenangkan apresiasi pada kompetisi desain web.',
            'features' => [
                'Visualisasi metrik lingkungan kota dengan grafik interaktif dinamis.',
                'Peta interaktif sebaran stasiun pemantau kualitas lingkungan.',
                'Desain antarmuka modern dengan tata letak editorial responsif.',
            ],
            'technical' => 'Dibangun dengan vanilla modern JavaScript, HTML5 semantik, CSS modular, dan di-deploy pada Netlify CDN.',
            'github_url' => 'https://github.com/crashyet/CitySense',
            'live_url' => 'https://citysense12.netlify.app/',
            'is_live_github' => true,
            'gallery_images' => [
                'images/projects/city-sense.png',
            ],
        ],
        'sistem-pendaftaran-beasiswa' => [
            'name' => 'Sistem Pendaftaran Beasiswa',
            'matched_repos' => ['Sistem-Pendaftaran-Beasiswa', 'sistem-pendaftaran-beasiswa'],
            'category' => 'Web Application',
            'image_type' => 'web',
            'technology' => 'PHP / Blade',
            'year' => '2026',
            'cover_image' => 'images/projects/sistem-pendaftaran-beasiswa.png',
            'description' => 'Sistem digital untuk verifikasi berkas dan evaluasi seleksi calon penerima beasiswa.',
            'overview' => 'Aplikasi web administrasi seleksi beasiswa yang menggantikan pengumpulan berkas fisik manual. Sistem memungkinkan pendaftar mengunggah dokumen digital dan memudahkan panitia dalam menilai kelayakan.',
            'features' => [
                'Formulir pendaftaran digital dengan validasi format dokumen pendukung.',
                'Panel penilai untuk memeriksa keabsahan dan memberi skor administrasi.',
                'Pengumuman status kelulusan berkas secara transparan bagi peserta.',
            ],
            'technical' => 'Arsitektur Laravel dengan validasi form ketat, penyimpanan dokumen terisolasi, dan sistem role-based admin/pendaftar.',
            'github_url' => 'https://github.com/AhmadNurHidayat-23/Sistem-Pendaftaran-Beasiswa',
            'live_url' => null,
            'is_live_github' => true,
            'gallery_images' => [
                'images/projects/sistem-pendaftaran-beasiswa.png',
                'images/projects/beasiswa-pnc.png',
            ],
        ],
        'sistem-manajemen-layanan' => [
            'name' => 'Sistem Manajemen Layanan',
            'matched_repos' => ['sistem-manajemen-layanan'],
            'category' => 'Web Application',
            'image_type' => 'web',
            'technology' => 'PHP / MySQL',
            'year' => '2026',
            'cover_image' => 'images/projects/sistem-manajemen-layanan.png',
            'description' => 'Sistem pengelolaan alur kerja operasional dan antrean layanan barbershop, salon, serta laundry.',
            'overview' => 'Fondasi sistem manajemen usaha jasa yang memfokuskan pada efisiensi layanan harian. Sistem mencatat transaksi kasir, durasi pengerjaan, dan riwayat pesanan pelanggan.',
            'features' => [
                'Pencatatan kasir dan perhitungan total biaya layanan per pelanggan.',
                'Pengelolaan daftar master jenis jasa dan tarif layanan.',
                'Rekapitulasi omset dan laporan pesanan selesai per periode.',
            ],
            'technical' => 'Dibangun dengan native PHP dan MySQL, menekankan kecepatan komputasi dan struktur query database relasional yang rapi.',
            'github_url' => 'https://github.com/AhmadNurHidayat-23/sistem-manajemen-layanan',
            'live_url' => null,
            'is_live_github' => true,
            'gallery_images' => [
                'images/projects/sistem-manajemen-layanan.png',
            ],
        ],
    ],
];
