{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('home') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('projects.index') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@foreach ($projects as $project)
@if (!empty($project['slug']))
    <url>
        <loc>{{ route('projects.show', $project['slug']) }}</loc>
        <lastmod>{{ \Carbon\Carbon::parse($project['updated_at'] ?? now())->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
@endif
@endforeach
</urlset>

