@php
    $skillCategories = config('portfolio.skills', []);
@endphp

<section class="skills-editorial-section" id="skills">
    <div class="skills-container">
        
        {{-- Section Header --}}
        <div>
            <span class="skills-section-index">
                02 / Expertise
            </span>
            <h2 class="skills-editorial-heading">
                Tools & Technologies.
            </h2>
            <p class="skills-editorial-intro">
                A curated collection of languages, frameworks, and developer tools powering high-performance, maintainable web applications.
            </p>
        </div>

        {{-- Category Rows with Horizontal Dividers --}}
        <div class="skills-list-wrapper">
            @foreach ($skillCategories as $cat)
                <div class="skills-category-row">
                    
                    {{-- Category Header --}}
                    <div class="skills-category-header">
                        <span class="skills-category-numeral">{{ $cat['index'] ?? sprintf('%02d', $loop->iteration) }}</span>
                        <h3 class="skills-category-title">{{ $cat['category'] }}</h3>
                    </div>

                    {{-- Technology Logos Grid / Row --}}
                    <div class="skills-logos-flex">
                        @foreach ($cat['items'] as $item)
                            <x-technology-logo
                                :name="$item['name']"
                                :icon="$item['icon']"
                            />
                        @endforeach
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>
