<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\GitHubRepositoryService;
use App\Services\ProjectCurationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display the full collection of all public GitHub projects.
     */
    public function index(Request $request, GitHubRepositoryService $gitHubService): View
    {
        $force = $request->boolean('refresh');
        if ($force) {
            $gitHubService->clearCache();
        }

        $projects = $gitHubService->getAll($force);

        return view('pages.projects.index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Display a specific project repository detail page with next-project navigation.
     */
    public function show(
        string $slug,
        GitHubRepositoryService $gitHubService,
        ProjectCurationService $curationService
    ): View {
        if ($curationService->isRepositoryHidden($slug) || ! $curationService->isRepositoryAllowed($slug)) {
            abort(404, 'Project not found');
        }

        $allProjects = $gitHubService->getAll();
        $project = null;
        $currentIndex = null;

        $normalizedSlug = Str::lower(trim($slug));
        foreach ($allProjects as $index => $item) {
            $itemSlug = Str::lower((string) ($item['slug'] ?? ''));
            $itemName = Str::lower((string) ($item['name'] ?? ''));

            if ($itemSlug === $normalizedSlug || $itemName === $normalizedSlug) {
                $project = $item;
                $currentIndex = $index;
                break;
            }
        }

        if ($project === null) {
            abort(404, 'Project not found');
        }

        $nextProject = null;
        if ($currentIndex !== null && count($allProjects) > 1) {
            $nextIndex = ($currentIndex + 1) % count($allProjects);
            $nextProject = $allProjects[$nextIndex] ?? null;
        }

        return view('pages.projects.show', [
            'project' => $project,
            'nextProject' => $nextProject,
        ]);
    }
}
