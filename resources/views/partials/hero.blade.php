<section class="hero" id="home" aria-labelledby="hero-title">
    <div class="wrap hero-grid">
        <div class="hero-copy">
            <div class="eyebrow"><span></span> ACADEMICS + AI + SMART LEARNING</div>
            <h1 id="hero-title">From Screen Time<br>to <span class="skill-time">Skill Time<svg viewBox="0 0 330 16" preserveAspectRatio="none" aria-hidden="true"><path d="M3 12C93 1 231 1 326 8" stroke="currentColor" stroke-width="5" fill="none" stroke-linecap="round"/></svg></span><span class="red-dot">.</span></h1>
            <p class="hero-description">Stronger academics. Curious minds. Future-ready skills.<br>Give your child a learning space where it all comes together.</p>
            <ul class="hero-benefits">
                <li><span class="benefit-symbol"><x-icon name="book"/></span> All Subjects tuition for Prep–Class 8</li>
                <li><span class="benefit-symbol"><x-icon name="spark"/></span> Guided AI learning for kids Age 7+</li>
                <li><span class="benefit-symbol"><x-icon name="users"/></span> Small batches. Personal attention.</li>
            </ul>
            <div class="program-picker" data-program-picker>
                <p class="picker-label" id="program-picker-label">What would your child love to explore?</p>
                <div class="program-tabs" role="tablist" aria-labelledby="program-picker-label">
                    <button type="button" role="tab" id="tab-tuition" aria-controls="hero-program-panel" aria-selected="true" data-program="Tuition" data-description="Clear concepts, homework help and more confidence in school.">Tuition</button>
                    <button type="button" role="tab" id="tab-ai" aria-controls="hero-program-panel" aria-selected="false" tabindex="-1" data-program="AI" data-description="Safe, creative AI activities and hands-on exploration for Age 7+.">AI for Kids <x-icon name="spark"/></button>
                    <button type="button" role="tab" id="tab-both" aria-controls="hero-program-panel" aria-selected="false" tabindex="-1" data-program="Tuition + AI" data-description="Academic support and guided AI learning, growing together.">Both together</button>
                </div>
                <p id="hero-program-panel" role="tabpanel" aria-labelledby="tab-tuition" aria-live="polite">Clear concepts, homework help and more confidence in school.</p>
            </div>
            <div class="hero-actions">
                <a class="button button-red" data-program-cta data-base-url="{{ route('free-class') }}" href="{{ route('free-class', ['program' => 'Tuition']) }}">Try a free class <x-icon/></a>
                <a class="hero-phone" href="https://wa.me/919999373837"><x-icon name="chat"/> Talk to us</a>
            </div>
            <p class="hero-reassurance"><x-icon name="shield"/> Meet the teacher. Explore the approach. No commitment.</p>
        </div>
        <figure class="hero-visual">
            <div class="hero-photo"><img src="{{ asset('images/academy-learning.jpg') }}" alt="Illustrative scene of children learning with books and a laptop" width="1448" height="1086" fetchpriority="high"><span class="photo-label"><span class="status-dot"></span> BIG IDEAS START SMALL</span></div>
            <div class="floating-note note-top"><span class="icon-box blue"><x-icon name="book"/></span><div>A little guidance.<span>A lot more confidence.</span></div></div>
            <div class="floating-note note-bottom"><span class="icon-box coral"><x-icon name="spark"/></span><div>Made for curious minds<span>Learn · Practice · Create · Grow</span></div></div>
            <span class="decor-plus" aria-hidden="true">+</span>
            <figcaption><x-icon name="pin"/> Your neighbourhood academy in Swarn Jayanti Puram</figcaption>
        </figure>
    </div>
</section>
<section class="trust-bar" aria-label="Our learning commitments"><div class="wrap trust-grid">
    <div class="experience"><strong>20<span>+</span></strong><div>YEARS OF IT EXPERIENCE<span>Guiding the next generation</span></div></div>
    @foreach(['users' => 'Small Batches', 'heart' => 'Personal Attention', 'bulb' => 'Practical Learning', 'shield' => 'Parent-Friendly Guidance'] as $icon => $label)
        <div class="trust-item"><x-icon :name="$icon"/><span>{{ $label }}</span></div>
    @endforeach
</div></section>
