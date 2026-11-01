<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class CertificatesSectionTest extends TestCase
{
    /**
     * Test that the certificates section renders with all required content and metadata.
     */
    public function test_certificates_section_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Section header and index
        $response->assertSee('04 / Certificates');
        $response->assertSee('Certificates.');
        $response->assertSee('Certifications & Achievements');

        // All 8 certificate titles
        $response->assertSee('JUARA I — LOMBA WEB DEVELOPER');
        $response->assertSee('MIKROTIK CERTIFIED NETWORK ASSOCIATE (MTCNA)');
        $response->assertSee('INTERMEDIATE ASSISTANT WEB DEVELOPER');
        $response->assertSee('FUNDAMENTAL OF ASSISTANT WEB DEVELOPER');
        $response->assertSee('AI PRAKTIS UNTUK PRODUKTIVITAS');
        $response->assertSee('PENGANTAR MINDSET DIGITAL 1');
        $response->assertSee('PELINDUNGAN DATA PRIBADI');
        $response->assertSee('DATABASE PROGRAMMING WITH SQL – BAHASA INDONESIA');

        // Issuers & Organizers
        $response->assertSee('FushionTech');
        $response->assertSee('MikroTik');
        $response->assertSee('Politeknik Negeri Cilacap');
        $response->assertSee('Dicoding Indonesia');
        $response->assertSee('Digital Talent Scholarship');
        $response->assertSee('Oracle Academy');

        // All 8 certificate image assets
        $response->assertSee('images/certificates/01-juara-1-web-developer.png');
        $response->assertSee('images/certificates/02-mikrotik-mtcna.png');
        $response->assertSee('images/certificates/03-intermediate-assistant-web-developer.png');
        $response->assertSee('images/certificates/04-fundamental-assistant-web-developer.png');
        $response->assertSee('images/certificates/05-ai-praktis-untuk-produktivitas.png');
        $response->assertSee('images/certificates/06-pengantar-mindset-digital-1.png');
        $response->assertSee('images/certificates/07-pelindungan-data-pribadi.png');
        $response->assertSee('images/certificates/08-database-programming-with-sql.png');
    }

    /**
     * Verify that all certificate image files exist and are non-empty in public directory.
     */
    public function test_all_certificate_image_files_exist_on_disk(): void
    {
        $items = config('certificates.items', []);

        $this->assertCount(8, $items);

        foreach ($items as $item) {
            $filePath = public_path($item['image']);
            $this->assertFileExists($filePath, "Certificate image {$item['image']} does not exist.");
            $this->assertGreaterThan(0, filesize($filePath), "Certificate image {$item['image']} is empty.");
        }
    }

    /**
     * Verify strict compliance: NO "View Certificate", NO "Verify", NO modal triggers.
     */
    public function test_strict_compliance_no_prohibited_buttons_or_modals(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('View Certificate');
        $response->assertDontSee('Verify');
        $response->assertDontSee('data-modal');
        $response->assertDontSee('lightbox');
    }

    /**
     * Ensure no inline CSS or JS in homepage output.
     */
    public function test_no_inline_styles_or_scripts(): void
    {
        $response = $this->get('/');

        $content = $response->getContent();
        $this->assertStringNotContainsString('<style', $content);
        $this->assertStringNotContainsString('style=', $content);
        $this->assertStringNotContainsString('onclick=', $content);
    }
}
