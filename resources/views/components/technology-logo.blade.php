@props([
    'name',
    'icon',
])

<div
    class="tech-logo-item"
    tabindex="0"
    role="img"
    aria-label="{{ $name }}"
>
    <div class="tech-logo-icon-wrapper">
        <img
            src="{{ asset($icon) }}"
            alt="{{ $name }} logo"
            class="tech-logo-svg"
            loading="lazy"
            width="48"
            height="48"
        />
    </div>

    {{-- Interactive Tooltip on Hover / Focus --}}
    <span class="tech-logo-tooltip" role="tooltip" aria-hidden="true">
        {{ $name }}
    </span>

    {{-- Accessible label for touch / mobile screens --}}
    <span class="tech-logo-mobile-label">
        {{ $name }}
    </span>
</div>

