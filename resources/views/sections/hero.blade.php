<section class="hero-reference-section" id="hero">
    {{-- Content Area: Typography (Top) & Vertical Navigation (Bottom) --}}
    <div class="hero-content-wrapper">
        
        {{-- Headline: Calligraphic Signature "I am" (Style 01) + Bold Serif Name --}}
        <div class="hero-headline-container">
            <div class="hero-signature-wrap" role="img" aria-label="I am">
                <img
                    src="{{ asset('icons/hero-i-am-style01.svg') }}"
                    alt="I am"
                    class="hero-signature-svg"
                    loading="eager"
                    fetchpriority="high"
                    width="356"
                    height="88"
                />
            </div>

            <h1 class="hero-editorial-title">
                <span class="hero-name-line">Ahmad Nur Hidayat.</span>
            </h1>
        </div>

        {{-- Bottom-Left Navigation: Vertical Stack --}}
        <div class="hero-bottom-nav">
            <a href="#about" class="hero-vertical-link">
                Biography
            </a>

            @if (config('portfolio.cv_url'))
                <a href="{{ config('portfolio.cv_url') }}" target="_blank" rel="noopener noreferrer" class="hero-vertical-link">
                    CV
                </a>
            @else
                <span class="hero-vertical-link is-disabled" title="CV will be available soon">
                    CV
                </span>
            @endif

            <a href="#contact" class="hero-touch-rectangle-btn">
                Get in touch
            </a>
        </div>

    </div>

    {{-- Right Area: Large Cutout Portrait Photography --}}
    <div class="hero-portrait-stage">
        <picture>
            <source srcset="{{ asset('images/ahmad-portrait-cutout.webp') }}" type="image/webp">
            <img
                src="{{ asset('images/ahmad-portrait-cutout.png') }}"
                alt="Ahmad Nur Hidayat — Portrait"
                class="hero-cutout-img"
                loading="eager"
                fetchpriority="high"
                width="996"
                height="1208"
            />
        </picture>
    </div>
</section>
