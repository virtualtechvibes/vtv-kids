<x-layout title="Try a free class | Virtual Tech Vibes Academy" description="Request a free class at Virtual Tech Vibes Academy. Explore tuition for Prep–Class 8 and guided AI learning for kids Age 7+." :focused="true">
    <section class="booking-section">
        <div class="wrap booking-grid">
            <aside class="booking-story">
                <div class="booking-editorial">
                    <p class="booking-kicker">A LITTLE CURIOSITY GOES A LONG WAY</p>
                    <h1>Small beginnings.<br><span>Wonderful possibilities.</span></h1>
                    <p>A teacher who listens.<br>A space to explore. A reason to smile.</p>
                    <div class="booking-subjects"><span class="subject-maths">123 <small>Maths</small></span><span class="subject-code">&lt;/&gt; <small>Computers</small></span><span class="subject-ai">✧ <small>AI · 7+</small></span></div><figure class="booking-portrait"><img src="{{ asset('images/academy-learning.jpg') }}" alt="Illustrative scene of two curious children learning together" width="1448" height="1086"><figcaption>Let their next “I can!” start here.</figcaption></figure>
                </div>
                <p class="booking-location"><x-icon name="pin"/> Swarn Jayanti Puram · In-person classes</p>
            </aside>
            <div class="booking-card" id="booking-form">
                @if(session('inquiry_success'))
                    <div class="booking-success" tabindex="-1" data-form-feedback role="status">
                        <span class="success-icon"><x-icon name="check"/></span>
                        <div class="eyebrow">A GREAT FIRST STEP</div>
                        <h2>Your free-class request is in!</h2>
                        <p>{{ session('inquiry_success') }}</p>
                        <div class="next-step-note"><x-icon name="phone"/><span>We’ll call to understand your child’s needs and confirm a suitable class time.</span></div>
                        
                        <a class="text-link" href="{{ route('home') }}">Back to the academy <x-icon/></a>
                    </div>
                @else
                    <div class="booking-heading"><h2>Let’s get started.</h2><p>A free class. A fresh possibility.</p><button class="booking-motion-control" type="button" data-motion-toggle hidden>Pause animations</button></div>
                    @include('partials.free-class-form')
                @endif
            </div>
        </div>
    </section>
</x-layout>
