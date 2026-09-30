@php
    $requestedProgram = request()->query('program');
    $selectedProgram = old('interested_in', in_array($requestedProgram, ['Tuition', 'AI', 'Tuition + AI'], true) ? $requestedProgram : 'Tuition');
@endphp
@if($errors->any())
    <div class="form-errors" role="alert" tabindex="-1" data-form-feedback>
        <strong>Let’s check a few details.</strong>
        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif
<ol class="booking-progress" aria-label="Free-class request progress" hidden>
    <li aria-current="step"><span>1</span> Your class</li>
    <li><span>2</span> Your child</li>
    <li><span>3</span> Review</li>
</ol>
<form method="post" action="{{ route('inquiries.store') }}" class="booking-form" data-booking-form>
    @csrf
    <p class="step-announcement sr-only" aria-live="polite"></p>
    <fieldset data-step="0">
        <legend>Your learning path</legend>
        
        <p class="program-eligibility">All subjects: Prep–Class 8 <span>·</span> AI: age 7+</p><div class="booking-programs">
            @foreach([['Tuition', 'book', 'Tuition', 'All Subjects · Prep–Class 8'], ['AI', 'spark', 'AI for Kids', 'Creative AI learning · Age 7+'], ['Tuition + AI', 'bulb', 'Tuition + AI', 'The best of both · AI Age 7+']] as [$value, $icon, $label, $description])
                <label class="program-choice">
                    <input type="radio" name="interested_in" value="{{ $value }}" required @checked($selectedProgram === $value) @error('interested_in') aria-invalid="true" @enderror>
                    <span class="choice-content"><x-icon :name="$icon"/><span><strong>{{ $label }}</strong><small>{{ $description }}</small></span><span class="choice-check"><x-icon name="check"/></span></span>
                </label>
            @endforeach
        </div>
        <div class="field">
            <label for="phone">Parent’s mobile number <span>*</span></label>
            <input id="phone" name="phone" type="tel" autocomplete="tel" inputmode="tel" placeholder="Your 10-digit mobile number" value="{{ old('phone') }}" maxlength="15" pattern="(?:\+91[ \-]?)?[6-9][0-9]{9}" required aria-describedby="phone-help" @error('phone') aria-invalid="true" @enderror>
            <small id="phone-help">We’ll contact you to arrange your free class. Optional +91 prefix.</small>
        </div>
        <div class="field">
            <label for="class">Child’s class <span>*</span></label>
            <select id="class" name="class" required @error('class') aria-invalid="true" @enderror>
                <option value="">Select class</option>
                <option value="0" @selected((string) old('class', '') === '0')>Prep</option>
                @for($class = 1; $class <= 8; $class++)<option value="{{ $class }}" @selected(old('class') == $class)>Class {{ $class }}</option>@endfor
            </select>
        </div>
    </fieldset>
    <fieldset data-step="1">
        <legend>A little about your child</legend>
        <p class="step-intro">Help us make their first class feel personal.</p>
        @foreach([['parent_name', 'Parent / guardian name', 'Your full name', 'name'], ['child_name', 'Child’s name', 'What should we call your child?', 'off']] as [$name, $label, $placeholder, $autocomplete])
            <div class="field"><label for="{{ $name }}">{{ $label }} <span>*</span></label><input id="{{ $name }}" name="{{ $name }}" type="text" autocomplete="{{ $autocomplete }}" placeholder="{{ $placeholder }}" value="{{ old($name) }}" maxlength="100" required @error($name) aria-invalid="true" @enderror></div>
        @endforeach
        <div class="field"><label for="child_age">Child’s age <span>*</span></label><input id="child_age" name="child_age" type="number" min="3" max="18" placeholder="Age in years" value="{{ old('child_age') }}" required aria-describedby="age-help" @error('child_age') aria-invalid="true" @enderror><small id="age-help">Tuition is for Prep–Class 8. The separate AI program starts at age 7.</small></div>
        <div class="friendly-note"><x-icon name="heart"/><p>Every child learns differently. We start by getting to know yours.</p></div>
    </fieldset>
    <fieldset data-step="2">
        <legend>One last look. Then let’s begin.</legend>
        <p class="step-intro">We’ll get in touch to agree on a class time.</p>
        <dl class="booking-summary" hidden></dl>
        <div class="field"><label for="message">Anything we should know? <span class="optional">(optional)</span></label><textarea id="message" name="message" rows="3" maxlength="2000" placeholder="Learning goals, questions or a preferred time to call…">{{ old('message') }}</textarea></div>
        <label class="consent"><input name="consent" type="checkbox" value="1" required @checked(old('consent')) @error('consent') aria-invalid="true" @enderror><span>I’m the parent or guardian and agree to be contacted about this inquiry. <a href="{{ route('privacy') }}" target="_blank" rel="noopener">Privacy notice</a>.</span></label>
        <p class="booking-disclaimer">This is a class request. We’ll confirm the date and time with you personally.</p>
    </fieldset>
    <div class="honeypot" aria-hidden="true"><label for="website">Leave this field empty</label><input id="website" name="website" tabindex="-1" autocomplete="off"></div>
    <div class="booking-actions">
        <button class="button button-outline" type="button" data-back hidden>Back</button>
        <button class="button button-red" type="button" data-next hidden>Continue <x-icon/></button>
        <button class="button button-red" type="submit" data-submit>Request my free class <x-icon/></button>
    </div>
    <p class="booking-assurance"><x-icon name="shield"/> No payment required for your first class.</p>
</form>
