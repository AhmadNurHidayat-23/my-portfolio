<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class SeoAndErrorPagesTest extends TestCase
{
    public function test_homepage_renders_complete_seo_and_open_graph_tags(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('<meta name="description"', false);
        $response->assertSee('<link rel="canonical"', false);
        $response->assertSee('<meta property="og:type" content="website"', false);
        $response->assertSee('<meta property="og:title"', false);
        $response->assertSee('<meta property="og:description"', false);
        $response->assertSee('<meta property="og:image"', false);
        $response->assertSee('<meta name="twitter:card" content="summary_large_image"', false);
    }

    public function test_homepage_exposes_valid_person_data_with_only_verified_profiles(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $document = new \DOMDocument;
        @$document->loadHTML($response->getContent());
        $nodes = (new \DOMXPath($document))->query('//script[@type="application/ld+json"]');
        $this->assertSame(1, $nodes->length);
        $person = json_decode($nodes->item(0)->textContent, true, 512, JSON_THROW_ON_ERROR);
        $this->assertSame('https://schema.org', $person['@context']);
        $this->assertSame('Person', $person['@type']);
        $this->assertSame('https://ahmadnurhidayat.vercel.app/#person', $person['@id']);
        $this->assertSame('Ahmad Nur Hidayat', $person['name']);
        $this->assertSame('https://ahmadnurhidayat.vercel.app/', $person['url']);
        $this->assertSame(['https://github.com/AhmadNurHidayat-23'], $person['sameAs']);
    }

    public function test_project_detail_renders_project_specific_meta_tags(): void
    {
        $response = $this->get('/projects/simaul');

        $response->assertStatus(200);
        $response->assertSee('SIMAUL', false);
        $response->assertSee('Ahmad Nur Hidayat | Web &amp; Mobile Developer', false);
        $response->assertSee('<meta property="og:title"', false);
    }

    public function test_sitemap_xml_renders_valid_xml_with_public_routes(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml; charset=utf-8');
        $response->assertSee('<urlset', false);
        $response->assertSee('/projects/simaul', false);
    }

    public function test_custom_404_page_renders_with_editorial_style_and_404_status(): void
    {
        $response = $this->get('/non-existent-page-for-testing');

        $response->assertStatus(404);
        $response->assertSee('Error 404 / Page Not Found');
        $response->assertSee('Lost in whitespace.');
        $response->assertSee('Back to Portfolio');
    }

    public function test_robots_txt_renders_absolute_sitemap_url(): void
    {
        $response = $this->get('/robots.txt');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/plain; charset=utf-8');
        $response->assertSee('User-agent: *');
        $response->assertSee('Allow: /');
        $response->assertSee('Sitemap: '.url('/sitemap.xml'), false);
    }
}
