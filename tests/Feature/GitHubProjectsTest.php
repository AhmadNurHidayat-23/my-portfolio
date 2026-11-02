<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Services\GitHubRepositoryService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GitHubProjectsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Cache::forget(GitHubRepositoryService::CACHE_KEY);
        Cache::forget(GitHubRepositoryService::FALLBACK_CACHE_KEY);
        Cache::forget(GitHubRepositoryService::TOTAL_COUNT_CACHE_KEY);
        Cache::forget(GitHubRepositoryService::TOTAL_COUNT_FALLBACK_KEY);
    }

    public function test_home_page_renders_selected_work_section_with_all_repositories(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('03 / Works');
        $response->assertSee('Selected Work.');
        $response->assertSee("A collection of things I've built.", false);
        $response->assertSee('19 Repositories');
        $response->assertSee('SIMAUL — Sistem Manajemen Usaha Layanan');
        $response->assertSee('SIMAUL Mobile');
        $response->assertSee('Atur Uang Apps');
        $response->assertSee('my-portfolio');
        $response->assertSee('images/projects/simaul.png', false);
        $response->assertSee('images/projects/simaul-mobile.png', false);
        $response->assertSee('images/projects/sistem-pemasaran-otomatis-terpadu.png', false);
        $response->assertSee('images/projects/atur-uang-apps.png', false);
        $response->assertSee('images/projects/grownesia.png', false);
        $response->assertSee('images/projects/city-sense.png', false);
        $response->assertSee('images/projects/sistem-pendaftaran-beasiswa.png', false);
        $response->assertSee('images/projects/sistem-manajemen-layanan.png', false);
        $response->assertSee('images/projects/stunting-cerdas.png', false);
        $response->assertSee('images/projects/movix.png', false);
        $response->assertSee('Website portofolio pribadi untuk menampilkan profil, keahlian, dan proyek pengembangan web.');
        $response->assertSee('Platform edukasi dan skrining awal stunting untuk membantu pemantauan pertumbuhan serta kesehatan anak.');
        $response->assertSee('Platform streaming film berbasis web untuk menjelajahi koleksi film dan menikmati tontonan favorit.');

        $response->assertSee('All Repositories');
        $response->assertSee('https://github.com/AhmadNurHidayat-23?tab=repositories');
        $response->assertSee('rel="noopener noreferrer"', false);
    }

    public function test_priority_projects_are_ordered_at_the_top(): void
    {
        $service = app(GitHubRepositoryService::class);
        $projects = $service->getAll();

        $this->assertCount(12, $projects);
        $this->assertSame('SIMAUL — Sistem Manajemen Usaha Layanan', $projects[0]['name']);
        $this->assertSame('SIMAUL Mobile', $projects[1]['name']);
        $this->assertSame('Sistem Pemasaran Otomatis Terpadu', $projects[2]['name']);
        $this->assertSame('Atur Uang Apps', $projects[3]['name']);
        $this->assertSame('LocaTrip', $projects[4]['name']);
        $this->assertSame('Grownesia', $projects[5]['name']);
        $this->assertSame('City Sense', $projects[6]['name']);
        $this->assertSame('Sistem Pendaftaran Beasiswa', $projects[7]['name']);
        $this->assertSame('Sistem Manajemen Layanan', $projects[8]['name']);
    }

    public function test_projects_index_page_renders_dynamic_count_and_all_repositories(): void
    {
        $response = $this->get('/projects');

        $response->assertStatus(200);
        $response->assertSee('All Public Projects.');
        $response->assertSee('Showing all 19 Repositories');
        $response->assertSee('SIMAUL — Sistem Manajemen Usaha Layanan');
        $response->assertSee('my-portfolio');
        $response->assertSee('Website portofolio pribadi untuk menampilkan profil, keahlian, dan proyek pengembangan web.');
        $response->assertSee('Platform edukasi dan skrining awal stunting untuk membantu pemantauan pertumbuhan serta kesehatan anak.');
        $response->assertSee('Platform streaming film berbasis web untuk menjelajahi koleksi film dan menikmati tontonan favorit.');
        $response->assertSee('Back to Portfolio');

        $response->assertSee('All Repositories');
        $response->assertSee('https://github.com/AhmadNurHidayat-23?tab=repositories');
        $response->assertSee('rel="noopener noreferrer"', false);
    }

    public function test_hidden_repositories_are_excluded_from_views_and_return_404(): void
    {
        $hiddenSlugs = [
            'pweb', 'web-film', 'movix-v2', 'movix-fix', 'ahmadnurhidayat-23githubio',
            'ahmadnurhidayat-23.github.io', 'siroyo', 'ahmadnurhidayat-23',
            'rupakata-pembuat-poster-tipografi', 'passcraft-secure-password-generator',
            'paletteforge-generator-palet-warna', 'taskly-sistem-manajemen-tugas',
            'shortify-sistem-penyingkat-tautan', 'devlinks-sistem-manajemen-tautan-profil',
        ];

        $hiddenProjectCardTitles = [
            'Pweb', 'WEB_FILM', 'Movix_v2', 'Movix_Fix', 'AhmadNurHidayat-23.github.io', 'Siroyo',
            'rupakata-pembuat-poster-tipografi', 'passcraft-secure-password-generator',
            'paletteforge-generator-palet-warna', 'taskly-sistem-manajemen-tugas',
            'shortify-sistem-penyingkat-tautan', 'devlinks-sistem-manajemen-tautan-profil',
        ];

        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);

        $projectsResponse = $this->get('/projects');
        $projectsResponse->assertStatus(200);

        foreach ($hiddenProjectCardTitles as $title) {
            $homeResponse->assertDontSee($title);
            $projectsResponse->assertDontSee($title);
        }

        foreach ($hiddenSlugs as $slug) {
            $this->get("/projects/{$slug}")->assertStatus(404);
        }
    }

    public function test_unlisted_and_new_repositories_are_excluded_from_curated_showcase(): void
    {
        $this->resetHttpFake([
            'https://api.github.com/users/*/repos*' => Http::response([
                [
                    'id' => 9999901,
                    'name' => 'rupakata-pembuat-poster-tipografi',
                    'full_name' => 'AhmadNurHidayat-23/rupakata-pembuat-poster-tipografi',
                    'description' => 'Poster generator',
                    'html_url' => 'https://github.com/AhmadNurHidayat-23/rupakata-pembuat-poster-tipografi',
                ],
                [
                    'id' => 9999902,
                    'name' => 'unlisted-brand-new-repo',
                    'full_name' => 'AhmadNurHidayat-23/unlisted-brand-new-repo',
                    'description' => 'Unlisted repo',
                    'html_url' => 'https://github.com/AhmadNurHidayat-23/unlisted-brand-new-repo',
                ],
                [
                    'id' => 1440513304,
                    'name' => 'my-portfolio',
                    'full_name' => 'AhmadNurHidayat-23/my-portfolio',
                    'description' => 'Website portofolio pribadi.',
                    'html_url' => 'https://github.com/AhmadNurHidayat-23/my-portfolio',
                ],
            ], 200),
            'https://api.github.com/users/*' => Http::response(['public_repos' => 22], 200),
            'https://api.github.com/*' => Http::response([], 200),
        ]);

        $service = app(GitHubRepositoryService::class);
        $projects = $service->getAll(forceRefresh: true);

        $names = collect($projects)->pluck('name')->all();
        $this->assertNotContains('rupakata-pembuat-poster-tipografi', $names);
        $this->assertNotContains('unlisted-brand-new-repo', $names);
        $this->assertContains('my-portfolio', $names);

        $this->get('/projects/unlisted-brand-new-repo')->assertStatus(404);
        $this->get('/projects/rupakata-pembuat-poster-tipografi')->assertStatus(404);
    }

    public function test_dynamic_repository_count_differs_from_curated_cards_count(): void
    {
        $this->resetHttpFake([
            'https://api.github.com/users/*/repos*' => Http::response([], 403),
            'https://api.github.com/users/*' => Http::response(['public_repos' => 25], 200),
            'https://api.github.com/*' => Http::response([], 403),
        ]);

        $response = $this->get('/?refresh=1');
        $response->assertStatus(200);
        $response->assertSee('25 Repositories');

        $service = app(GitHubRepositoryService::class);
        $curatedProjects = $service->getAll();

        $this->assertCount(12, $curatedProjects);
        $this->assertSame(25, $service->getTotalRepositoryCount());
    }

    public function test_dynamic_count_falls_back_to_cached_count_on_api_failure(): void
    {
        Cache::put(GitHubRepositoryService::TOTAL_COUNT_CACHE_KEY, 23, 60);

        $this->resetHttpFake([
            'https://api.github.com/*' => Http::response('Server Error', 500),
        ]);

        $service = app(GitHubRepositoryService::class);
        $this->assertSame(23, $service->getTotalRepositoryCount());
    }

    public function test_project_detail_page_renders_valid_project_data_and_next_project_link(): void
    {
        $response = $this->get('/projects/simaul');

        $response->assertStatus(200);
        $response->assertSee('SIMAUL — Sistem Manajemen Usaha Layanan');
        $response->assertSee('Project Overview');
        $response->assertSee('Key Features');
        $response->assertSee('Technical Implementation');
        $response->assertSee('Next Project');
        $response->assertSee('SIMAUL Mobile');
    }

    public function test_project_detail_page_returns_404_for_unknown_slug(): void
    {
        $this->get('/projects/this-repository-does-not-exist-12345')->assertStatus(404);
    }

    public function test_artisan_refresh_command_synchronizes_repositories(): void
    {
        $this->artisan('portfolio:refresh-github')
            ->expectsOutputToContain('Flushing previous GitHub repository cache')
            ->expectsOutputToContain('Successfully synchronized')
            ->assertSuccessful();
    }

    public function test_no_inline_styles_or_scripts_in_projects_views(): void
    {
        $homeResponse = $this->get('/');
        $this->assertStringNotContainsString('<style', $homeResponse->getContent());
        $this->assertStringNotContainsString('style=', $homeResponse->getContent());
        $this->assertStringNotContainsString('onclick=', $homeResponse->getContent());

        $projectsResponse = $this->get('/projects');
        $this->assertStringNotContainsString('<style', $projectsResponse->getContent());
        $this->assertStringNotContainsString('style=', $projectsResponse->getContent());
        $this->assertStringNotContainsString('onclick=', $projectsResponse->getContent());

        $detailResponse = $this->get('/projects/simaul');
        $this->assertStringNotContainsString('<style', $detailResponse->getContent());
        $this->assertStringNotContainsString('style=', $detailResponse->getContent());
        $this->assertStringNotContainsString('onclick=', $detailResponse->getContent());
    }
}
