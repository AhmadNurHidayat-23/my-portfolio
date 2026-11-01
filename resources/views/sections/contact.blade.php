@php
    $whatsappNumber = config('portfolio.whatsapp_number');
    $defaultMessage = config('portfolio.whatsapp_message', 'Halo Ahmad, saya melihat portofolio Anda dan tertarik untuk berdiskusi mengenai kerja sama atau proyek.');
    $cleanNumber = $whatsappNumber ? preg_replace('/[^0-9]/', '', (string) $whatsappNumber) : null;
    $whatsappUrl = $cleanNumber
        ? 'https://wa.me/' . $cleanNumber . '?text=' . urlencode($defaultMessage)
        : '#contact';
    $isWhatsappExternal = !empty($cleanNumber);
    $email = config('portfolio.email', 'nurhidayata062.stu@pnc.ac.id');
    $currentYear = date('Y');
@endphp

<footer class="contact-editorial-section" id="contact">
    <div class="contact-container">

        {{-- Top: Eyebrow Row --}}
        <div class="contact-eyebrow-row">
            <span class="contact-section-index">
                07 / CONTACT &amp; COLLABORATION
            </span>
            <div class="contact-status-badge">
                <span class="contact-status-dot" aria-hidden="true"></span>
                <span>OPEN FOR COLLABORATION</span>
            </div>
        </div>

        {{-- Main CTA Heading & Action Block --}}
        <div class="contact-cta-wrapper">
            <div class="contact-heading-group">
                <h2 class="contact-editorial-heading">
                    <span class="contact-heading-white">Tertarik bekerja sama?</span>
                    <span class="contact-heading-muted">Hubungi saya.</span>
                </h2>
                <p class="contact-editorial-description">
                    Punya ide, proyek, atau peluang kolaborasi? Mari berdiskusi dan ciptakan solusi digital yang tepat untuk kebutuhanmu.
                </p>
            </div>

            <div class="contact-action-group">
                <a
                    href="{{ $whatsappUrl }}"
                    @if ($isWhatsappExternal)
                        target="_blank"
                        rel="noopener noreferrer"
                    @endif
                    class="contact-primary-btn"
                    aria-label="Hubungi Ahmad Nur Hidayat via WhatsApp"
                >
                    <span>Hubungi Saya</span>
                    <span class="contact-btn-arrow" aria-hidden="true">↗</span>
                </a>
            </div>
        </div>

        {{-- Middle: 4-Column Footer Information --}}
        <div class="contact-info-grid">
            {{-- Column 1: Personal Identity --}}
            <div class="contact-col contact-identity-col">
                <h3 class="contact-identity-name">Ahmad Nur Hidayat.</h3>
                <p class="contact-identity-role">Web &amp; Mobile Developer</p>
                <p class="contact-identity-tagline">Building thoughtful digital experiences.</p>
                <div class="contact-identity-location">
                    <svg class="contact-location-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    <span>Yogyakarta, Indonesia</span>
                </div>
            </div>

            {{-- Column 2: Expertise --}}
            <div class="contact-col contact-expertise-col">
                <h4 class="contact-col-title">Expertise</h4>
                <ul class="contact-text-list" role="list">
                    <li>Web Development</li>
                    <li>Mobile App Development</li>
                    <li>Backend &amp; API Development</li>
                    <li>UI Development</li>
                </ul>
            </div>

            {{-- Column 3: Explore Navigation --}}
            <div class="contact-col contact-nav-col">
                <h4 class="contact-col-title">Explore</h4>
                <ul class="contact-nav-list" role="list">
                    <li><a href="#hero" class="contact-footer-link">Home</a></li>
                    <li><a href="#about" class="contact-footer-link">About Me</a></li>
                    <li><a href="#skills" class="contact-footer-link">Tools &amp; Technologies</a></li>
                    <li><a href="#projects" class="contact-footer-link">Projects</a></li>
                    <li><a href="#certificates" class="contact-footer-link">Certificates</a></li>
                    <li><a href="#services" class="contact-footer-link">What I Do</a></li>
                </ul>
            </div>

            {{-- Column 4: Let's Connect --}}
            <div class="contact-col contact-social-col">
                <h4 class="contact-col-title">Let's Connect</h4>
                <ul class="contact-social-list" role="list">
                    <li>
                        <a
                            href="mailto:{{ $email }}"
                            class="contact-footer-link contact-email-link"
                            aria-label="Email Ahmad Nur Hidayat"
                        >
                            <span>{{ $email }}</span>
                            <span class="contact-link-arrow" aria-hidden="true">↗</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="https://www.linkedin.com/in/ahmad-nur-hidayat-071169414/"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="contact-footer-link"
                        >
                            <span>LinkedIn</span>
                            <span class="contact-link-arrow" aria-hidden="true">↗</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="https://github.com/AhmadNurHidayat-23"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="contact-footer-link"
                        >
                            <span>GitHub</span>
                            <span class="contact-link-arrow" aria-hidden="true">↗</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="{{ $whatsappUrl }}"
                            @if ($isWhatsappExternal)
                                target="_blank"
                                rel="noopener noreferrer"
                            @endif
                            class="contact-footer-link"
                        >
                            <span>WhatsApp</span>
                            <span class="contact-link-arrow" aria-hidden="true">↗</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom: Copyright & Back To Top --}}
        <div class="contact-bottom-bar">
            <p class="contact-copyright">
                © {{ $currentYear }} Ahmad Nur Hidayat. All rights reserved.
            </p>
            <a href="#hero" class="contact-back-to-top" aria-label="Back to top of page">
                <span>Back to top</span>
                <span class="contact-top-arrow" aria-hidden="true">↑</span>
            </a>
        </div>

    </div>
</footer>
