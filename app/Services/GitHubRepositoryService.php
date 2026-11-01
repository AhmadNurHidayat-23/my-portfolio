<?php

declare(strict_types=1);

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class GitHubRepositoryService
{
    public const CACHE_KEY = 'github_repositories_ahmadnurhidayat';

    public const FALLBACK_CACHE_KEY = 'github_repositories_ahmadnurhidayat_fallback';

    public const CACHE_TTL_MINUTES = 60;

    public const GITHUB_API_URL = 'https://api.github.com';

    public function __construct(
        protected ProjectCurationService $curationService,
        protected ?string $username = null,
        protected ?string $token = null,
    ) {
        $this->username = $username ?: (string) config('services.github.username', 'AhmadNurHidayat-23');
        $this->token = $token ?: config('services.github.token');
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getAll(bool $forceRefresh = false): array
    {
        if (! $forceRefresh) {
            $cached = Cache::get(self::CACHE_KEY);
            if (is_array($cached) && ! empty($cached)) {
                return $cached;
            }
        }

        try {
            $repositories = $this->fetchAllFromApi();
            if (! empty($repositories)) {
                $ordered = $this->curationService->applyPriorityAndCuration($repositories, $this->username);
                Cache::put(self::CACHE_KEY, $ordered, now()->addMinutes(self::CACHE_TTL_MINUTES));
                Cache::put(self::FALLBACK_CACHE_KEY, $ordered, now()->addDays(30));

                return $ordered;
            }
        } catch (Throwable $e) {
            Log::warning('GitHub API fetch failed: '.$e->getMessage(), ['user' => $this->username]);
        }

        $fallback = Cache::get(self::FALLBACK_CACHE_KEY);
        if (is_array($fallback) && ! empty($fallback)) {
            return $fallback;
        }

        return $this->curationService->applyPriorityAndCuration($this->curationService->loadSeedFallback(), $this->username);
    }

    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
        Cache::forget(self::FALLBACK_CACHE_KEY);
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findBySlug(string $slug): ?array
    {
        $normalized = Str::lower(trim($slug));
        foreach ($this->getAll() as $repo) {
            if (Str::lower((string) ($repo['slug'] ?? '')) === $normalized || Str::lower((string) ($repo['name'] ?? '')) === $normalized) {
                return $repo;
            }
        }

        return null;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function fetchAllFromApi(): array
    {
        $allRepos = [];
        $page = 1;
        $perPage = 100;

        do {
            $res = $this->httpClient()->get(self::GITHUB_API_URL."/users/{$this->username}/repos", [
                'per_page' => $perPage,
                'page' => $page,
                'type' => 'all',
                'sort' => 'updated',
                'direction' => 'desc',
            ]);

            if ($res->failed()) {
                break;
            }

            $pageData = $res->json();
            if (! is_array($pageData) || empty($pageData)) {
                break;
            }

            foreach ($pageData as $item) {
                if (is_array($item) && isset($item['id'])) {
                    $allRepos[$item['id']] = $this->formatRepository($item);
                }
            }
            $page++;
        } while (count($pageData) === $perPage);

        $additionalTargets = array_unique(array_merge(
            $this->fetchContributedRepoNames(),
            (array) config('services.github.collaborations', [])
        ));

        $existing = collect($allRepos)->pluck('full_name')->map(fn ($n) => Str::lower((string) $n))->all();
        foreach ($additionalTargets as $target) {
            if (! in_array(Str::lower((string) $target), $existing, true)) {
                $extra = $this->fetchSingleFromApi((string) $target);
                if ($extra !== null && isset($extra['id'])) {
                    $allRepos[$extra['id']] = $extra;
                    $existing[] = Str::lower((string) $extra['full_name']);
                }
            }
        }

        return array_values($allRepos);
    }

    /**
     * @return array<int, string>
     */
    protected function fetchContributedRepoNames(): array
    {
        try {
            $res = $this->httpClient()->get(self::GITHUB_API_URL.'/search/commits', [
                'q' => "author:{$this->username}",
                'per_page' => 100,
            ]);

            if ($res->successful()) {
                return collect($res->json('items') ?? [])->pluck('repository.full_name')->filter()->unique()->values()->all();
            }
        } catch (Throwable) {
        }

        return [];
    }

    /**
     * @return array<string, mixed>|null
     */
    protected function fetchSingleFromApi(string $name): ?array
    {
        $endpoint = str_contains($name, '/')
            ? self::GITHUB_API_URL."/repos/{$name}"
            : self::GITHUB_API_URL."/repos/{$this->username}/{$name}";

        $res = $this->httpClient()->get($endpoint);
        if ($res->successful() && is_array($res->json()) && isset($res->json()['id'])) {
            return $this->formatRepository($res->json());
        }

        return null;
    }

    protected function httpClient(): PendingRequest
    {
        $client = Http::timeout(10)->accept('application/vnd.github.v3+json')->withUserAgent('Ahmad-Portfolio-App');

        return ! empty($this->token) ? $client->withToken($this->token) : $client;
    }

    /**
     * @param  array<string, mixed>  $raw
     * @return array<string, mixed>
     */
    protected function formatRepository(array $raw): array
    {
        $name = (string) ($raw['name'] ?? '');
        $owner = (string) ($raw['owner']['login'] ?? $this->username);
        $fullName = (string) ($raw['full_name'] ?? "{$owner}/{$name}");
        $isOwner = Str::lower($owner) === Str::lower((string) $this->username);
        $homepage = ! empty($raw['homepage']) && filter_var($raw['homepage'], FILTER_VALIDATE_URL) ? (string) $raw['homepage'] : null;

        return [
            'id' => (int) ($raw['id'] ?? 0),
            'name' => $name,
            'slug' => Str::slug($name),
            'full_name' => $fullName,
            'owner_login' => $owner,
            'is_owner' => $isOwner,
            'is_collaborator' => ! $isOwner,
            'category' => ! empty($raw['language']) ? "{$raw['language']} Application" : 'Software Project',
            'technology' => ! empty($raw['language']) ? (string) $raw['language'] : 'Web Technology',
            'description' => ! empty($raw['description']) ? trim((string) $raw['description']) : 'Public repository on GitHub.',
            'language' => ! empty($raw['language']) ? (string) $raw['language'] : null,
            'html_url' => (string) ($raw['html_url'] ?? "https://github.com/{$fullName}"),
            'homepage' => $homepage,
            'updated_at' => (string) ($raw['updated_at'] ?? now()->toIso8601String()),
            'updated_year' => Carbon::parse((string) ($raw['updated_at'] ?? now()))->format('Y'),
            'updated_formatted' => Carbon::parse((string) ($raw['updated_at'] ?? now()))->format('M Y'),
            'created_at' => (string) ($raw['created_at'] ?? now()->toIso8601String()),
            'created_formatted' => Carbon::parse((string) ($raw['created_at'] ?? now()))->format('M Y'),
            'stargazers_count' => (int) ($raw['stargazers_count'] ?? 0),
            'forks_count' => (int) ($raw['forks_count'] ?? 0),
            'open_issues_count' => (int) ($raw['open_issues_count'] ?? 0),
            'is_fork' => (bool) ($raw['fork'] ?? false),
            'is_archived' => (bool) ($raw['archived'] ?? false),
            'default_branch' => (string) ($raw['default_branch'] ?? 'main'),
            'license_name' => isset($raw['license']['name']) ? (string) $raw['license']['name'] : null,
            'topics' => is_array($raw['topics'] ?? null) ? $raw['topics'] : [],
            'image_url' => $this->curationService->resolveProjectImage($name, Str::slug($name)),
        ];
    }
}
