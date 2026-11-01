<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ContactSectionTest extends TestCase
{
    /**
     * Test that the full-screen Contact & Footer section renders with all required copy, links, and identity.
     */
    public function test_contact_section_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Section ID & Header Eyebrow
        $response->assertSee('id="contact"', false);
        $response->assertSee('07 / CONTACT');
        $response->assertSee('OPEN FOR COLLABORATION');

        // Main CTA Headings
        $response->assertSee('Tertarik bekerja sama?');
        $response->assertSee('Hubungi saya.');
        $response->assertSee('Punya ide, proyek, atau peluang kolaborasi? Mari berdiskusi dan ciptakan solusi digital yang tepat untuk kebutuhanmu.');

        // Primary Button
        $response->assertSee('Hubungi Saya');

        // Column 1: Personal Identity & Location
        $response->assertSee('Ahmad Nur Hidayat.');
        $response->assertSee('Web &amp; Mobile Developer', false);
        $response->assertSee('Building thoughtful digital experiences.');
        $response->assertSee('Yogyakarta, Indonesia');

        // Column 2: Expertise
        $response->assertSee('Expertise');
        $response->assertSee('Web Development');
        $response->assertSee('Mobile App Development');
        $response->assertSee('Backend &amp; API Development', false);
        $response->assertSee('UI Development');

        // Column 3: Explore Navigation
        $response->assertSee('Explore');
        $response->assertSee('href="#hero"', false);
        $response->assertSee('href="#about"', false);
        $response->assertSee('href="#skills"', false);
        $response->assertSee('href="#projects"', false);
        $response->assertSee('href="#certificates"', false);
        $response->assertSee('href="#services"', false);

        // Column 4: Let's Connect
        $response->assertSee("Let's Connect", false);
        $response->assertSee('mailto:nurhidayata062.stu@pnc.ac.id', false);
        $response->assertSee('nurhidayata062.stu@pnc.ac.id');
        $response->assertSee('https://www.linkedin.com/in/ahmad-nur-hidayat-071169414/');
        $response->assertSee('https://github.com/AhmadNurHidayat-23');

        // Bottom Bar: Copyright & Back To Top
        $currentYear = date('Y');
        $response->assertSee("© {$currentYear} Ahmad Nur Hidayat. All rights reserved.");
        $response->assertSee('Back to top');
    }

    /**
     * Test that navigation anchors in footer map to existing sections on the page.
     */
    public function test_footer_explore_anchors_exist_on_page(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $content = $response->getContent();

        $this->assertStringContainsString('id="hero"', $content);
        $this->assertStringContainsString('id="about"', $content);
        $this->assertStringContainsString('id="skills"', $content);
        $this->assertStringContainsString('id="projects"', $content);
        $this->assertStringContainsString('id="certificates"', $content);
        $this->assertStringContainsString('id="services"', $content);
        $this->assertStringContainsString('id="contact"', $content);
    }

    /**
     * Verify that no inline CSS/JS exists in the output.
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
