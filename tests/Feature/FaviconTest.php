<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class FaviconTest extends TestCase
{
    public function test_all_pages_render_browser_title_and_portfolio_favicon_tags(): void
    {
        $routes = [
            '/',
            '/projects',
            '/projects/simaul',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);

            // Verify browser tab title
            $response->assertSee('<title>Ahmad Nur Hidayat | Web Developer</title>', false);

            // Verify modern favicon links
            $response->assertSee('rel="icon" type="image/png" sizes="16x16"', false);
            $response->assertSee('rel="icon" type="image/png" sizes="32x32"', false);
            $response->assertSee('rel="icon" type="image/png" sizes="48x48"', false);
            $response->assertSee('rel="icon" type="image/png" sizes="180x180"', false);
            $response->assertSee('rel="apple-touch-icon" sizes="180x180"', false);
            $response->assertSee('rel="shortcut icon"', false);

            $response->assertSee('favicon-16x16.png', false);
            $response->assertSee('favicon-32x32.png', false);
            $response->assertSee('favicon-48x48.png', false);
            $response->assertSee('favicon-180x180.png', false);
            $response->assertSee('apple-touch-icon.png', false);
            $response->assertSee('favicon.ico', false);
        }
    }

    public function test_favicon_files_exist_in_public_directory(): void
    {
        $this->assertFileExists(public_path('favicon.ico'));
        $this->assertFileExists(public_path('favicon-16x16.png'));
        $this->assertFileExists(public_path('favicon-32x32.png'));
        $this->assertFileExists(public_path('favicon-48x48.png'));
        $this->assertFileExists(public_path('favicon-180x180.png'));
        $this->assertFileExists(public_path('apple-touch-icon.png'));
        $this->assertFileExists(public_path('images/Logo TAB.png'));
        $this->assertFileExists(public_path('images/logo-favicon-optimized.png'));

        [$width16, $height16] = getimagesize(public_path('favicon-16x16.png'));
        $this->assertSame(16, $width16);
        $this->assertSame(16, $height16);

        [$width32, $height32] = getimagesize(public_path('favicon-32x32.png'));
        $this->assertSame(32, $width32);
        $this->assertSame(32, $height32);

        [$width48, $height48] = getimagesize(public_path('favicon-48x48.png'));
        $this->assertSame(48, $width48);
        $this->assertSame(48, $height48);

        [$width180, $height180] = getimagesize(public_path('favicon-180x180.png'));
        $this->assertSame(180, $width180);
        $this->assertSame(180, $height180);

        [$widthApple, $heightApple] = getimagesize(public_path('apple-touch-icon.png'));
        $this->assertSame(180, $widthApple);
        $this->assertSame(180, $heightApple);
    }
}
