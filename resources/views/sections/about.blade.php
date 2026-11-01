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
                    I am Ahmad Nur Hidayat, a Web & Mobile Developer and Diploma III Informatics Engineering student at Politeknik Negeri Cilacap, passionate about building modern, functional, and meaningful digital experiences.
                </p>

                <p class="about-editorial-paragraph">
                    I focus on developing responsive web applications, mobile applications, reliable backend systems, and intuitive user interfaces. Working with technologies such as PHP, Laravel, and modern development tools, I aim to create solutions that are efficient, maintainable, and built with attention to detail.
                </p>

                <p class="about-editorial-paragraph">
                    For me, software development is more than just writing code. It's about solving real problems, creating better user experiences, and continuously learning to turn ideas into meaningful digital solutions.
                </p>

                {{-- Editorial Metadata Grid --}}
                <div class="about-meta-grid">
                    <div class="about-meta-item">
                        <span class="about-meta-label">Identity</span>
                        <span class="about-meta-value">Ahmad Nur Hidayat</span>
                    </div>

                    <div class="about-meta-item">
                        <span class="about-meta-label">Primary Role</span>
                        <span class="about-meta-value">Web & Mobile Developer</span>
                    </div>

                    <div class="about-meta-item">
                        <span class="about-meta-label">Core Focus</span>
                        <span class="about-meta-value">Web, Mobile & Backend</span>
                    </div>

                    <div class="about-meta-item">
                        <span class="about-meta-label">Status</span>
                        <span class="about-meta-value">Open for Opportunities & Collaboration</span>
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

