import '../css/refresh.css';
import './booking.js';
const toggle = document.querySelector('.menu-toggle');
const navigation = document.querySelector('#main-nav');

function closeNavigation() {
    toggle?.setAttribute('aria-expanded', 'false');
    toggle?.setAttribute('aria-label', 'Open navigation');
    navigation?.classList.remove('is-open');
}

toggle?.addEventListener('click', () => {
    const expanded = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', String(!expanded));
    toggle.setAttribute('aria-label', expanded ? 'Open navigation' : 'Close navigation');
    navigation?.classList.toggle('is-open', !expanded);
});
navigation?.querySelectorAll('a').forEach(link => link.addEventListener('click', closeNavigation));
document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && toggle?.getAttribute('aria-expanded') === 'true') {
        closeNavigation();
        toggle.focus();
    }
});
document.addEventListener('click', event => {
    if (!event.target.closest('.site-header')) closeNavigation();
});
const feedback = document.querySelector('[data-form-feedback]');
if (feedback) {
    feedback.scrollIntoView({ block: 'center' });
    feedback.focus({ preventScroll: true });
}

import '../css/calm.css';
const patternGame = document.querySelector('[data-pattern-game]');
if (patternGame) {
    patternGame.querySelector('.pattern-choices').hidden = false;
    patternGame.querySelector('.pattern-fallback').hidden = true;
    patternGame.querySelectorAll('[data-answer]').forEach(button => {
        button.setAttribute('aria-pressed', 'false');
        button.addEventListener('click', () => {
            patternGame.querySelectorAll('[data-answer]').forEach(choice => choice.setAttribute('aria-pressed', String(choice === button)));
            const correct = button.dataset.answer === 'circle';
            patternGame.querySelector('.pattern-feedback').textContent = correct
                ? 'Great spotting! The circle and triangle take turns.'
                : 'Take another look. Which shape comes after each triangle?';
        });
    });
}
import '../css/booking-premium.css';
import './discovery.js';
import '../css/discovery.css';
