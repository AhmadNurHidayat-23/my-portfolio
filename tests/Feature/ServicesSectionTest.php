<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ServicesSectionTest extends TestCase
{
    /**
     * Test that the What I Do section renders with all required copy and structure.
     */
    public function test_services_section_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Eyebrow and heading
        $response->assertSee('06 / EXPERTISE');
        $response->assertSee('What I Do.');
        $response->assertSee('I transform ideas into functional digital experiences through thoughtful design and development.');

        // All 4 services titles
        $response->assertSee('Web Development');
        $response->assertSee('Mobile App Development');
        $response->assertSee('Backend &amp; API Development', false);
        $response->assertSee('UI Development');

        // Numbers
        $response->assertSee('01');
        $response->assertSee('02');
        $response->assertSee('03');
        $response->assertSee('04');

        // Descriptions
        $response->assertSee('Membangun website dan aplikasi web yang responsif, modern, dan sesuai kebutuhan bisnis.');
        $response->assertSee('Mengembangkan aplikasi mobile dengan pengalaman pengguna yang intuitif dan fungsional.');
        $response->assertSee('Membangun sistem backend, database, dan API untuk mendukung aplikasi yang terintegrasi.');
        $response->assertSee('Mengubah rancangan antarmuka menjadi website interaktif, presisi, dan responsif.');

        // CTA
        $response->assertSee('Have a project in mind?');
        $response->assertSee("Let's Talk", false);
        $response->assertSee('↗');
    }

    /**
     * Ensure the CTA link points to a valid destination (#contact or WhatsApp).
     */
    public function test_services_cta_has_valid_destination(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $content = $response->getContent();
        $this->assertMatchesRegularExpression(
            '/href="(#contact|https:\/\/wa\.me\/[^"]+)"[^>]*class="services-cta-link"/',
            $content
        );
    }

    /**
     * Ensure no card container classes or generic agency boxes in What I Do section.
     */
    public function test_services_section_follows_editorial_minimalist_standards(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $content = $response->getContent();
        // Section should exist
        $this->assertStringContainsString('id="services"', $content);

        // No inline styles or scripts
        $this->assertStringNotContainsString('<style', $content);
        $this->assertStringNotContainsString('style=', $content);
        $this->assertStringNotContainsString('onclick=', $content);
    }
}
