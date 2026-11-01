<?php

declare(strict_types=1);

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProjectCurationService
{
    /**
     * Organize projects placing the top 9 priority projects first, then all others.
     * Excludes repositories marked as hidden in configuration.
     *
     * @param  array<int, array<string, mixed>>  $repos
     * @return array<int, array<string, mixed>>
     */
    public function applyPriorityAndCuration(array $repos, string $defaultUsername): array
    {
        // Exclude hidden repositories at the source
        $repos = array_values(array_filter($repos, fn (array $r): bool => ! $this->isRepositoryHidden($r)));

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
                'image_url' => (! empty($curated['cover_image']) && File::exists(public_path($curated['cover_image'])))
                    ? asset($curated['cover_image'])
                    : ($this->resolveProjectImage($curated['name'], $prioritySlug) ?? ($foundRepo['image_url'] ?? null)),
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
            ->map(function (array $r) use ($seedMap): array {
                $r['is_priority'] = false;
                $r['category'] = $r['category'] ?? ($r['language'] ? "{$r['language']} Project" : 'Software Project');
                $r['technology'] = $r['technology'] ?? ($r['language'] ?? 'Web Technology');
                $img = $this->resolveProjectImage((string) ($r['name'] ?? ''), (string) ($r['slug'] ?? '')) ?? ($r['image_url'] ?? null);
                $r['image_url'] = $img;
                $r['image_type'] = $r['image_type'] ?? 'web';
                $r['gallery_images'] = $img ? [$img] : [];

                $rName = Str::lower((string) ($r['name'] ?? ''));
                $rSlug = Str::lower((string) ($r['slug'] ?? ''));
                $seed = $seedMap[$rSlug] ?? $seedMap[$rName] ?? null;
                if ($seed && ! empty($seed['description'])) {
                    $r['description'] = $seed['description'];
                }

                return $r;
            })
            ->values()
            ->all();

        return array_merge($prioritySection, $remaining);
    }

    /**
     * Determine if a repository is in the hidden list based on its name, slug, or full_name.
     *
     * @param  array<string, mixed>|string  $repo
     */
    public function isRepositoryHidden(array|string $repo): bool
    {
        $hiddenList = (array) config('portfolio.hidden_repositories', config('projects.hidden_repositories', []));
        if (empty($hiddenList)) {
            return false;
        }

        $candidates = [];
        if (is_array($repo)) {
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
        } else {
            $candidates[] = $repo;
        }

        $normalize = static fn (string $val): string => Str::lower(preg_replace('/[^a-zA-Z0-9]/', '', $val) ?? '');
        $normalizedHidden = array_map($normalize, $hiddenList);

        foreach ($candidates as $candidate) {
            $candidateNorm = $normalize($candidate);
            if ($candidateNorm !== '' && in_array($candidateNorm, $normalizedHidden, true)) {
                return true;
            }

            $candidateLower = Str::lower(trim($candidate));
            foreach ($hiddenList as $hidden) {
                if (Str::lower(trim($hidden)) === $candidateLower || Str::slug($hidden) === $candidateLower) {
                    return true;
                }
            }
        }

        return false;
    }

    public function resolveProjectImage(string $name, ?string $slug = null): ?string
    {
        $slug = $slug ?: Str::slug($name);
        $extensions = ['png', 'jpg', 'jpeg', 'webp'];
        $variants = array_unique(array_filter([
            $slug,
            Str::slug($name),
            Str::slug($slug),
            Str::lower($name),
            Str::lower($slug),
            Str::replace('_', '-', Str::lower($name)),
            Str::replace('_', '-', Str::lower($slug)),
            Str::replace('-', '_', Str::lower($name)),
            Str::replace('-', '_', Str::lower($slug)),
            Str::snake($name),
            Str::snake($slug),
            $name,
        ]));

        foreach ($variants as $variant) {
            foreach ($extensions as $ext) {
                if (File::exists(public_path("images/projects/{$variant}/dashboard.{$ext}"))) {
                    return asset("images/projects/{$variant}/dashboard.{$ext}");
                }
                if (File::exists(public_path("images/projects/{$variant}/cover.{$ext}"))) {
                    return asset("images/projects/{$variant}/cover.{$ext}");
                }
                $filename = "{$variant}.{$ext}";
                if (File::exists(public_path("images/projects/{$filename}"))) {
                    return asset("images/projects/{$filename}");
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
