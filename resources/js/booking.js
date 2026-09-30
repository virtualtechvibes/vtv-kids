const picker = document.querySelector('[data-program-picker]');
if (picker) {
    const tabs = [...picker.querySelectorAll('[role="tab"]')];
    const panel = picker.querySelector('[role="tabpanel"]');
    const cta = document.querySelector('[data-program-cta]');

    const selectProgram = (tab) => {
        tabs.forEach(item => {
            item.setAttribute('aria-selected', String(item === tab));
            item.tabIndex = item === tab ? 0 : -1;
        });
        panel.textContent = tab.dataset.description;
        panel.setAttribute('aria-labelledby', tab.id);
        const target = new URL(cta.dataset.baseUrl);
        target.searchParams.set('program', tab.dataset.program);
        cta.href = target.toString();
    };

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', () => selectProgram(tab));
        tab.addEventListener('keydown', event => {
            let next;
            if (event.key === 'ArrowRight') next = (index + 1) % tabs.length;
            if (event.key === 'ArrowLeft') next = (index + tabs.length - 1) % tabs.length;
            if (event.key === 'Home') next = 0;
            if (event.key === 'End') next = tabs.length - 1;
            if (next === undefined) return;
            event.preventDefault();
            selectProgram(tabs[next]);
            tabs[next].focus();
        });
    });
}

const form = document.querySelector('[data-booking-form]');
if (form) {
    const steps = [...form.querySelectorAll('[data-step]')];
    const progress = document.querySelector('.booking-progress');
    const next = form.querySelector('[data-next]');
    const back = form.querySelector('[data-back]');
    const submit = form.querySelector('[data-submit]');
    const summary = form.querySelector('.booking-summary');
    const age = form.elements.child_age;
    let currentStep = 0;

    form.noValidate = true;
    progress.hidden = false;
    summary.hidden = false;

    const updateAgeRule = () => {
        const program = form.querySelector('[name="interested_in"]:checked')?.value;
        age.min = program === 'Tuition' ? '3' : '7';
        age.setCustomValidity(age.value && Number(age.value) < Number(age.min)
            ? (program === 'Tuition' ? 'Please enter an age between 3 and 18.' : 'The AI program starts at age 7. Choose Tuition for a younger child.')
            : '');
    };

    const showSummary = () => {
        summary.replaceChildren();
        const values = [
            ['Learning path', form.querySelector('[name="interested_in"]:checked')?.value || ''],
            ['Learner', form.elements.child_name.value],
            ['Class & age', (form.elements.class.value === '0' ? 'Prep' : 'Class ' + form.elements.class.value) + ' · Age ' + age.value],
            ['Parent / guardian', form.elements.parent_name.value],
            ['Contact number', form.elements.phone.value],
        ];
        values.forEach(([label, value]) => {
            const row = document.createElement('div');
            const term = document.createElement('dt');
            const detail = document.createElement('dd');
            term.textContent = label;
            detail.textContent = value;
            row.append(term, detail);
            summary.append(row);
        });
    };

    const showStep = (index, focus = true) => {
        currentStep = index;
        steps.forEach((step, position) => { step.hidden = position !== index; });
        [...progress.children].forEach((item, position) => {
            if (position === index) item.setAttribute('aria-current', 'step');
            else item.removeAttribute('aria-current');
            item.classList.toggle('is-complete', position < index);
        });
        back.hidden = index === 0;
        next.hidden = index === steps.length - 1;
        submit.hidden = index !== steps.length - 1;
        form.querySelector('.step-announcement').textContent = 'Step ' + (index + 1) + ' of 3: ' + steps[index].querySelector('legend').textContent;
        if (index === steps.length - 1) showSummary();
        if (focus) {
            const legend = steps[index].querySelector('legend');
            legend.tabIndex = -1;
            legend.focus({ preventScroll: true });
            if (matchMedia('(max-width: 800px)').matches) document.querySelector('.booking-card').scrollIntoView({ behavior: 'instant', block: 'start' });
        }
    };

    const validateStep = (index) => {
        updateAgeRule();
        const invalid = [...steps[index].querySelectorAll('input, select, textarea')].find(input => !input.checkValidity());
        if (!invalid) return true;
        showStep(index, false);
        invalid.reportValidity();
        invalid.focus();
        return false;
    };

    next.addEventListener('click', () => {
        if (validateStep(currentStep)) showStep(currentStep + 1);
    });
    back.addEventListener('click', () => showStep(currentStep - 1));
    age.addEventListener('input', updateAgeRule);
    form.querySelectorAll('[name="interested_in"]').forEach(input => input.addEventListener('change', updateAgeRule));
    form.addEventListener('submit', event => {
        if (currentStep < steps.length - 1) {
            event.preventDefault();
            if (validateStep(currentStep)) showStep(currentStep + 1);
            return;
        }
        for (let index = 0; index < steps.length; index++) {
            if (!validateStep(index)) {
                event.preventDefault();
                return;
            }
        }
        submit.disabled = true;
        submit.textContent = 'Sending your request…';
    });

    const invalidField = form.querySelector('[aria-invalid="true"]');
    showStep(invalidField ? Number(invalidField.closest('[data-step]').dataset.step) : 0, false);
}
