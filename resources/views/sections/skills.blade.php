@php
    $technologies = config('portfolio.technologies', []);
    if (empty($technologies)) {
        // Fallback to flattening legacy skills configuration if needed
        $categories = config('portfolio.skills', []);
        $technologies = collect($categories)->pluck('items')->flatten(1)->unique('name')->values()->all();
    }
@endphp

<section class="skills-editorial-section" id="skills">
    <div class="skills-container">
        
        {{-- Section Header --}}
        <div class="skills-header-wrapper">
            <span class="skills-section-index">
                02 / Expertise
            </span>
            <h2 class="skills-editorial-heading">
                Tools & Technologies.
            </h2>
            <p class="skills-editorial-intro">
                A curated collection of languages, frameworks, and developer tools powering high-performance, maintainable web and mobile applications.
            </p>
        </div>

        {{-- Unified Responsive Logo Gallery (No category cards/dividers/numbers) --}}
        <div class="skills-unified-grid">
            @foreach ($technologies as $tech)
                <x-technology-logo
                    :name="$tech['name']"
                    :icon="$tech['icon']"
                />
            @endforeach
        </div>

    </div>
</section>
