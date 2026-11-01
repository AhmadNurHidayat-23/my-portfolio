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
            width="52"
            height="52"
        />
    </div>

    {{-- Interactive Minimalist Tooltip on Hover / Focus / Tap --}}
    <span class="tech-logo-tooltip" role="tooltip" aria-hidden="true">
        {{ $name }}
    </span>
</div>
