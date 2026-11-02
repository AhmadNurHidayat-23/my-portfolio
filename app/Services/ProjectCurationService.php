<?php

declare(strict_types=1);

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProjectCurationService
{
    /**
     * Organize projects placing priority showcase first, then all curated others.
     *
     * @param  array<int, array<string, mixed>>  $repos
     * @return array<int, array<string, mixed>>
     */
    public function applyPriorityAndCuration(array $repos, string $defaultUsername): array
    {
        $repos = array_values(array_filter(
            $repos,
            fn (array $r): bool => ! $this->isRepositoryHidden($r) && $this->isRepositoryAllowed($r)
        ));

        $priorityOrder = (array) config('projects.priority_order', []);
        $curatedMap = (array) config('projects.curated', []);
        $matchedRepoIds = [];
        $prioritySection = [];

        foreach ($priorityOrder as $prioritySlug) {
            $curated = $curatedMap[$prioritySlug] ?? null;
            if (! $curated) {
                continue;
            }

            $targetNames = array_map('strtolower', (array) ($curated['matched_repos'] ?? [$prioritySlug]));
            $foundRepo = null;

            foreach ($repos as $repo) {
                $rName = Str::lower((string) ($repo['name'] ?? ''));
                $rSlug = Str::lower((string) ($repo['slug'] ?? ''));
                if (in_array($rName, $targetNames, true) || in_array($rSlug, $targetNames, true)) {
                    $foundRepo = $repo;
                    $matchedRepoIds[] = $repo['id'] ?? 0;
                    break;
                }
            }

            $coverImage = (! empty($curated['cover_image']) && File::exists(public_path($curated['cover_image'])))
                ? asset($curated['cover_image'])
                : ($this->resolveProjectImage($curated['name'], $prioritySlug) ?? ($foundRepo['image_url'] ?? null));

            $prioritySection[] = [
                'id' => $foundRepo['id'] ?? crc32($prioritySlug),
                'name' => $curated['name'],
                'slug' => $prioritySlug,
                'full_name' => $foundRepo['full_name'] ?? "{$defaultUsername}/{$prioritySlug}",
                'owner_login' => $foundRepo['owner_login'] ?? $defaultUsername,
                'is_owner' => $foundRepo['is_owner'] ?? true,
                'is_collaborator' => $foundRepo['is_collaborator'] ?? false,
                'category' => $curated['category'] ?? 'Web Application',
                'description' => $curated['description'],
                'overview' => $curated['overview'] ?? null,
                'features' => $curated['features'] ?? [],
                'technical' => $curated['technical'] ?? null,
                'language' => $foundRepo['language'] ?? explode(' / ', (string) ($curated['technology'] ?? ''))[0],
                'technology' => $curated['technology'] ?? ($foundRepo['language'] ?? 'Modern Web Stack'),
                'html_url' => $foundRepo['html_url'] ?? ($curated['github_url'] ?? null),
                'homepage' => $foundRepo['homepage'] ?? ($curated['live_url'] ?? null),
                'updated_at' => $foundRepo['updated_at'] ?? now()->toIso8601String(),
                'updated_year' => $curated['year'] ?? ($foundRepo['updated_year'] ?? '2026'),
                'updated_formatted' => $foundRepo['updated_formatted'] ?? ($curated['year'] ?? '2026'),
                'created_at' => $foundRepo['created_at'] ?? now()->toIso8601String(),
                'created_formatted' => $foundRepo['created_formatted'] ?? 'N/A',
                'stargazers_count' => $foundRepo['stargazers_count'] ?? 0,
                'forks_count' => $foundRepo['forks_count'] ?? 0,
                'open_issues_count' => $foundRepo['open_issues_count'] ?? 0,
                'is_fork' => $foundRepo['is_fork'] ?? false,
                'is_archived' => $foundRepo['is_archived'] ?? false,
                'default_branch' => $foundRepo['default_branch'] ?? 'main',
                'license_name' => $foundRepo['license_name'] ?? null,
                'topics' => $foundRepo['topics'] ?? [],
                'image_url' => $coverImage,
                'image_type' => $curated['image_type'] ?? 'web',
                'gallery_images' => array_map(
                    fn (string $path) => str_starts_with($path, 'http') ? $path : asset($path),
                    (array) ($curated['gallery_images'] ?? [])
                ),
                'is_priority' => true,
            ];
        }

        $seedMap = [];
        foreach ($this->loadSeedFallback() as $seedItem) {
            $sName = Str::lower((string) ($seedItem['name'] ?? ''));
            $sSlug = Str::lower((string) ($seedItem['slug'] ?? ''));
            if ($sName !== '') {
                $seedMap[$sName] = $seedItem;
            }
            if ($sSlug !== '') {
                $seedMap[$sSlug] = $seedItem;
            }
        }

        $remaining = collect($repos)
            ->filter(fn (array $r) => ! in_array($r['id'] ?? 0, $matchedRepoIds, true))
            ->sortByDesc(fn (array $r): int => Carbon::parse($r['updated_at'] ?? now())->timestamp)
            ->map(function (array $r) use ($seedMap, $curatedMap): array {
                $rName = Str::lower((string) ($r['name'] ?? ''));
                $rSlug = Str::lower((string) ($r['slug'] ?? ''));

                $r['is_priority'] = false;
                $r['category'] = $r['category'] ?? ($r['language'] ? "{$r['language']} Project" : 'Software Project');
                $r['technology'] = $r['technology'] ?? ($r['language'] ?? 'Web Technology');

                $img = $this->resolveProjectImage((string) ($r['name'] ?? ''), (string) ($r['slug'] ?? '')) ?? ($r['image_url'] ?? null);
                $r['image_url'] = $img;
                $r['image_type'] = $r['image_type'] ?? 'web';
                $r['gallery_images'] = $img ? [$img] : [];

                $seed = $seedMap[$rSlug] ?? $seedMap[$rName] ?? null;
                if ($seed && ! empty($seed['description'])) {
                    $r['description'] = $seed['description'];
                }

                $curatedItem = $curatedMap[$rSlug] ?? $curatedMap[$rName] ?? null;
                if ($curatedItem) {
                    foreach (['description', 'overview', 'features', 'technical'] as $field) {
                        if (! empty($curatedItem[$field])) {
                            $r[$field] = $curatedItem[$field];
                        }
                    }
                }

                return $r;
            })
            ->values()
            ->all();

        return array_merge($prioritySection, $remaining);
    }

    /**
     * Determine if a repository is in the curated allowlist.
     *
     * @param  array<string, mixed>|string  $repo
     */
    public function isRepositoryAllowed(array|string $repo): bool
    {
        if ($this->isRepositoryHidden($repo)) {
            return false;
        }

        $curatedList = (array) config('projects.curated_repositories', config('projects.allowed_repositories', []));
        $priorityOrder = (array) config('projects.priority_order', []);
        $curatedMeta = (array) config('projects.curated', []);

        $allowedTargets = array_merge($curatedList, $priorityOrder, array_keys($curatedMeta));
        foreach ($curatedMeta as $meta) {
            if (! empty($meta['matched_repos']) && is_array($meta['matched_repos'])) {
                $allowedTargets = array_merge($allowedTargets, $meta['matched_repos']);
            }
        }

        return $this->matchesRepoList($repo, $allowedTargets);
    }

    /**
     * Determine if a repository is excluded from public showcase.
     *
     * @param  array<string, mixed>|string  $repo
     */
    public function isRepositoryHidden(array|string $repo): bool
    {
        $hiddenList = (array) config('portfolio.hidden_repositories', config('projects.hidden_repositories', []));

        return $this->matchesRepoList($repo, $hiddenList);
    }

    /**
     * @param  array<string, mixed>|string  $repo
     * @param  array<int, string>  $targetList
     */
    protected function matchesRepoList(array|string $repo, array $targetList): bool
    {
        if (empty($targetList)) {
            return false;
        }

        $candidates = $this->extractCandidates($repo);
        $normalize = static fn (string $val): string => Str::lower(preg_replace('/[^a-zA-Z0-9]/', '', $val) ?? '');
        $normalizedTargets = array_map($normalize, $targetList);

        foreach ($candidates as $candidate) {
            $candidateNorm = $normalize($candidate);
            if ($candidateNorm !== '' && in_array($candidateNorm, $normalizedTargets, true)) {
                return true;
            }

            $candidateLower = Str::lower(trim($candidate));
            foreach ($targetList as $target) {
                $targetStr = (string) $target;
                if (Str::lower(trim($targetStr)) === $candidateLower || Str::slug($targetStr) === $candidateLower) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param  array<string, mixed>|string  $repo
     * @return array<int, string>
     */
    protected function extractCandidates(array|string $repo): array
    {
        if (! is_array($repo)) {
            return [trim((string) $repo)];
        }

        $candidates = [];
        if (! empty($repo['name'])) {
            $candidates[] = (string) $repo['name'];
        }
        if (! empty($repo['slug'])) {
            $candidates[] = (string) $repo['slug'];
        }
        if (! empty($repo['full_name'])) {
            $parts = explode('/', (string) $repo['full_name']);
            $candidates[] = end($parts);
        }

        return array_values(array_filter($candidates));
    }

    public function resolveProjectImage(string $name, ?string $slug = null): ?string
    {
        $slug = $slug ?: Str::slug($name);
        $extensions = ['png', 'jpg', 'jpeg', 'webp'];
        $variants = array_unique(array_filter([
            $slug, Str::slug($name), Str::slug($slug), Str::lower($name), Str::lower($slug),
            Str::replace('_', '-', Str::lower($name)), Str::replace('_', '-', Str::lower($slug)),
            Str::replace('-', '_', Str::lower($name)), Str::replace('-', '_', Str::lower($slug)),
            Str::snake($name), Str::snake($slug), $name,
        ]));

        foreach ($variants as $variant) {
            foreach ($extensions as $ext) {
                foreach (["{$variant}/dashboard.{$ext}", "{$variant}/cover.{$ext}", "{$variant}.{$ext}"] as $subPath) {
                    if (File::exists(public_path("images/projects/{$subPath}"))) {
                        return asset("images/projects/{$subPath}");
                    }
                }
            }
        }

        return null;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function loadSeedFallback(): array
    {
        $seedPath = resource_path('data/github_projects_seed.json');
        if (File::exists($seedPath)) {
            $data = json_decode(File::get($seedPath), true);
            if (is_array($data)) {
                return $data;
            }
        }

        return [];
    }
}
