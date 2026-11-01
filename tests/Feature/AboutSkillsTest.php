<?php

namespace Tests\Feature;

use Tests\TestCase;

class AboutSkillsTest extends TestCase
{
    public function test_about_and_skills_sections_render_properly(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Verify About Section
        $response->assertSee('id="about"', false);
        $response->assertSee('A little');
        $response->assertSee('about me.');
        $response->assertSee('Ahmad Nur Hidayat');
        $response->assertSee('Web & Mobile Developer', false);
        $response->assertSee('Web, Mobile & Backend', false);
        $response->assertSee('Open for Opportunities & Collaboration', false);

        // Verify Skills Section & Header
        $response->assertSee('id="skills"', false);
        $response->assertSee('Tools & Technologies.', false);
        $response->assertSee('skills-unified-grid', false);
        $response->assertDontSee('skills-category-row', false);

        // Verify Required Technologies
        $response->assertSee('HTML5');
        $response->assertSee('CSS3');
        $response->assertSee('JavaScript');
        $response->assertSee('React');
        $response->assertSee('Tailwind CSS');
        $response->assertSee('Blade');
        $response->assertSee('PHP');
        $response->assertSee('Laravel');
        $response->assertSee('C++');
        $response->assertSee('Flutter');
        $response->assertSee('Dart');
        $response->assertSee('MySQL');
        $response->assertSee('MariaDB');
        $response->assertSee('Git');
        $response->assertSee('GitHub');
        $response->assertSee('Vite');
        $response->assertSee('Composer');
        $response->assertSee('NPM');

        // Verify Technology Logo Component structure & Accessibility
        $response->assertSee('class="tech-logo-item"', false);
        $response->assertSee('class="tech-logo-tooltip"', false);
        $response->assertSee('class="tech-logo-svg"', false);
        $response->assertSee('tabindex="0"', false);
        $response->assertSee('role="img"', false);

        // Verify Hero link to Biography targets #about
        $response->assertSee('href="#about"', false);
    }

    public function test_no_prohibited_inline_styles_or_scripts(): void
    {
        $response = $this->get('/');
        $content = $response->getContent();

        $this->assertStringNotContainsString('<style', $content);
        $this->assertStringNotContainsString('style=', $content);
        $this->assertStringNotContainsString('onclick=', $content);
        $this->assertStringNotContainsString('onchange=', $content);
    }
}
