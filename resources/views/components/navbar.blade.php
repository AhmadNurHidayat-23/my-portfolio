<header class="editorial-navbar sticky top-0 z-40 bg-white">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-12">
        <div class="flex items-center gap-6">
            <a href="/" class="editorial-brand-link">
                Ahmad Nur Hidayat
            </a>
            <span class="hidden md:inline-block h-3 w-px bg-[#E5E5E5]"></span>
            <span class="editorial-nav-status hidden md:inline-block">
                Independent Creative Developer
            </span>
        </div>

        <nav class="flex items-center gap-6 lg:gap-8" aria-label="Main Navigation">
            <a href="#about" class="editorial-nav-link">
                Biography
            </a>

            @if (config('portfolio.cv_url'))
                <a href="{{ config('portfolio.cv_url') }}" target="_blank" rel="noopener noreferrer" class="editorial-nav-link">
                    CV
                </a>
            @else
                <span class="editorial-nav-link opacity-40 cursor-not-allowed" title="CV is being updated">
                    CV
                </span>
            @endif

            <a href="#contact" class="editorial-nav-link">
                Contact
            </a>
        </nav>
    </div>
</header>

