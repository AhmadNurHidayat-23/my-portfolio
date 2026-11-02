<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Services\GitHubRepositoryService;
use App\Services\ProjectCurationService;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::prefix('projects')->name('projects.')->group(function (): void {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProjectController::class, 'show'])->name('show');
});

Route::get('/documents/{filename}', function (string $filename) {
    $path = public_path('documents/'.$filename);

    abort_unless(file_exists($path) && str_ends_with($filename, '.pdf'), 404);

    return response()->file($path, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="'.basename($path).'"',
    ]);
})->name('documents.show');

Route::get('/sitemap.xml', function (GitHubRepositoryService $gitHubService, ProjectCurationService $curationService) {
    $projects = collect($gitHubService->getAll())
        ->filter(fn ($p) => ! $curationService->isRepositoryHidden($p['slug'] ?? $p['name'] ?? '') && $curationService->isRepositoryAllowed($p['slug'] ?? $p['name'] ?? ''))
        ->values();

    return response()
        ->view('sitemap', ['projects' => $projects])
        ->header('Content-Type', 'application/xml; charset=utf-8');
})->name('sitemap');

Route::get('/robots.txt', function () {
    $sitemapUrl = url('/sitemap.xml');

    return response("User-agent: *\nAllow: /\n\nSitemap: {$sitemapUrl}\n", 200)
        ->header('Content-Type', 'text/plain; charset=utf-8');
})->name('robots');
