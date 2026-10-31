<section class="about-editorial-section" id="about">
    <div class="about-container">
        <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-start">
            
            {{-- Left Column: Section Index & Heading --}}
            <div class="lg:col-span-5 mb-10 lg:mb-0">
                <span class="about-section-index">
                    01 / About
                </span>
                <h2 class="about-editorial-heading">
                    A little<br class="hidden sm:inline"> about me.
                </h2>
            </div>

            {{-- Right Column: Biography Content & Details --}}
            <div class="lg:col-span-7 flex flex-col gap-6">
                <p class="about-editorial-lead">
                    I am Ahmad Nur Hidayat, a web developer and programmer focused on engineering clean, dependable, and thoughtfully crafted web applications.
                </p>

                <p class="about-editorial-paragraph">
                    My development methodology centers on structural clarity, maintainability, and precise execution. Working primarily within the modern PHP and Laravel ecosystem alongside utility-first CSS, I build applications that prioritize stability, seamless responsiveness, and long-term readability over unnecessary complexity.
                </p>

                <p class="about-editorial-paragraph">
                    I view software design through the lens of Swiss typography: eliminating noise, honoring whitespace, and ensuring that every component serves a distinct purpose.
                </p>

                {{-- Editorial Metadata Grid --}}
                <div class="about-meta-grid">
                    <div class="about-meta-item">
                        <span class="about-meta-label">Identity</span>
                        <span class="about-meta-value">Ahmad Nur Hidayat</span>
                    </div>

                    <div class="about-meta-item">
                        <span class="about-meta-label">Primary Role</span>
                        <span class="about-meta-value">Web Developer / Programmer</span>
                    </div>

                    <div class="about-meta-item">
                        <span class="about-meta-label">Core Focus</span>
                        <span class="about-meta-value">Web Applications & Backend Systems</span>
                    </div>

                    <div class="about-meta-item">
                        <span class="about-meta-label">Status</span>
                        <span class="about-meta-value">Available for Projects & Roles</span>
                    </div>
                </div>

                {{-- Optional Link to Full Page if Route Exists --}}
                @if (Route::has('about'))
                    <div>
                        <a href="{{ route('about') }}" class="about-more-link">
                            <span>Read detailed biography</span>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

