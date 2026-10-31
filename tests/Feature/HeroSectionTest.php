<?php

namespace Tests\Feature;

use Tests\TestCase;

class HeroSectionTest extends TestCase
{
    public function test_hero_page_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('I am');
        $response->assertSee('icons/hero-i-am-style01.svg');
        $response->assertSee('Ahmad Nur Hidayat.');
        $response->assertSee('Biography');
        $response->assertSee('CV');
        $response->assertSee('Get in touch');
        $response->assertSee('images/ahmad-portrait-cutout.png');
        $response->assertSee('Contact Ahmad on WhatsApp');
    }

    public function test_blade_views_do_not_contain_inline_styles_or_scripts(): void
    {
        $response = $this->get('/');

        $content = $response->getContent();
        $this->assertStringNotContainsString('<style', $content);
        $this->assertStringNotContainsString('style=', $content);
        $this->assertStringNotContainsString('onclick=', $content);
    }
}

