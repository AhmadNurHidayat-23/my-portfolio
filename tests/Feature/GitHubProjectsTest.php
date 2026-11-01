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
    }

    public function test_home_page_renders_selected_work_section_with_all_repositories(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('03 / Works');
        $response->assertSee('Selected Work.');
        $response->assertSee("A collection of things I've built.", false);
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
    }

    public function test_priority_projects_are_ordered_at_the_top(): void
    {
        $service = app(GitHubRepositoryService::class);
        $projects = $service->getAll();

        $this->assertGreaterThanOrEqual(9, count($projects));
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
        $response->assertSee('Showing all 12 Repositories');
        $response->assertSee('SIMAUL — Sistem Manajemen Usaha Layanan');
        $response->assertSee('my-portfolio');
        $response->assertSee('Website portofolio pribadi untuk menampilkan profil, keahlian, dan proyek pengembangan web.');
        $response->assertSee('Platform edukasi dan skrining awal stunting untuk membantu pemantauan pertumbuhan serta kesehatan anak.');
        $response->assertSee('Platform streaming film berbasis web untuk menjelajahi koleksi film dan menikmati tontonan favorit.');
        $response->assertSee('Back to Portfolio');
    }

    public function test_hidden_repositories_are_excluded_from_views_and_return_404(): void
    {
        $hiddenSlugs = [
            'pweb',
            'web-film',
            'movix-v2',
            'movix-fix',
            'ahmadnurhidayat-23githubio',
            'ahmadnurhidayat-23.github.io',
            'siroyo',
            'ahmadnurhidayat-23',
        ];

        $hiddenProjectCardTitles = [
            'Pweb',
            'WEB_FILM',
            'Movix_v2',
            'Movix_Fix',
            'AhmadNurHidayat-23.github.io',
            'Siroyo',
        ];

        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('12 Repositories');

        $projectsResponse = $this->get('/projects');
        $projectsResponse->assertStatus(200);

        foreach ($hiddenProjectCardTitles as $title) {
            $homeResponse->assertDontSee($title);
            $projectsResponse->assertDontSee($title);
        }

        foreach ($hiddenSlugs as $slug) {
            $detailResponse = $this->get("/projects/{$slug}");
            $detailResponse->assertStatus(404);
        }
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
        $response = $this->get('/projects/this-repository-does-not-exist-12345');

        $response->assertStatus(404);
    }

    public function test_api_failure_falls_back_gracefully_without_crashing(): void
    {
        Http::fake([
            'https://api.github.com/*' => Http::response('API Rate Limit Exceeded', 403),
        ]);

        $service = app(GitHubRepositoryService::class);
        $repos = $service->getAll();

        $this->assertIsArray($repos);
        $this->assertNotEmpty($repos);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('SIMAUL — Sistem Manajemen Usaha Layanan');
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
