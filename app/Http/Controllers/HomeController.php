<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\GitHubRepositoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the editorial portfolio homepage.
     */
    public function __invoke(Request $request, GitHubRepositoryService $gitHubService): View
    {
        $force = $request->boolean('refresh');
        if ($force) {
            $gitHubService->clearCache();
        }

        $projects = $gitHubService->getAll($force);
        $totalRepositoriesCount = $gitHubService->getTotalRepositoryCount($force);
        $certificates = config('certificates.items', []);
        $services = config('portfolio.services', []);

        return view('pages.home', [
            'projects' => $projects,
            'totalRepositoriesCount' => $totalRepositoriesCount,
            'certificates' => $certificates,
            'services' => $services,
        ]);
    }
}
