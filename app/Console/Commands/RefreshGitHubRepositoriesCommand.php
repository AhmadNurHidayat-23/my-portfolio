<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\GitHubRepositoryService;
use Illuminate\Console\Command;

class RefreshGitHubRepositoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'portfolio:refresh-github';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh GitHub public repositories cache for Ahmad Nur Hidayat portfolio';

    /**
     * Execute the console command.
     */
    public function handle(GitHubRepositoryService $service): int
    {
        $this->info('Flushing previous GitHub repository cache...');
        $service->clearCache();

        $this->info('Fetching updated repositories from GitHub API & collaborations...');
        $repositories = $service->getAll(forceRefresh: true);

        if (empty($repositories)) {
            $this->warn('No repositories were retrieved. Please check API rate limits or network.');

            return self::FAILURE;
        }

        $rows = collect($repositories)->map(function (array $repo, int $index): array {
            $role = ! empty($repo['is_collaborator']) ? 'Collaborator' : 'Owner';

            return [
                $index + 1,
                $repo['name'] ?? 'N/A',
                $repo['full_name'] ?? 'N/A',
                $role,
                $repo['language'] ?? 'None',
                $repo['updated_formatted'] ?? 'N/A',
            ];
        })->all();

        $this->table(['#', 'Name', 'Full Name', 'Role', 'Language', 'Updated'], $rows);
        $this->info('Successfully synchronized '.count($repositories).' repositories into cache.');

        return self::SUCCESS;
    }
}
