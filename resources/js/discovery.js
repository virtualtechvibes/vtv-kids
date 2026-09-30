const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
const motionButtons = document.querySelectorAll('[data-motion-toggle]');
let motionPaused = reducedMotion.matches;
function applyMotion() {
    document.documentElement.classList.toggle('subject-motion', !motionPaused);
    motionButtons.forEach(button => {
        button.hidden = false;
        button.textContent = motionPaused ? 'Play animations' : 'Pause animations';
        button.setAttribute('aria-pressed', String(motionPaused));
    });
}
motionButtons.forEach(button => button.addEventListener('click', () => { motionPaused = !motionPaused; applyMotion(); }));
reducedMotion.addEventListener('change', event => { motionPaused = event.matches; applyMotion(); });
applyMotion();

const lab = document.querySelector('[data-discovery-lab]');
if (lab) {
    const tabs = [...lab.querySelectorAll('[role="tab"]')];
    const panels = [...lab.querySelectorAll('[role="tabpanel"]')];
    lab.querySelector('.discovery-tabs').hidden = false;
    lab.querySelector('.maths-answers').hidden = false;
    function selectTab(tab) {
        tabs.forEach(item => { item.setAttribute('aria-selected', String(item === tab)); item.tabIndex = item === tab ? 0 : -1; });
        panels.forEach(panel => { panel.hidden = panel.id !== tab.getAttribute('aria-controls'); });
    }
    tabs.forEach((tab, index) => {
        tab.addEventListener('click', () => selectTab(tab));
        tab.addEventListener('keydown', event => {
            let next;
            if (event.key === 'ArrowRight') next = (index + 1) % tabs.length;
            if (event.key === 'ArrowLeft') next = (index + tabs.length - 1) % tabs.length;
            if (event.key === 'Home') next = 0;
            if (event.key === 'End') next = tabs.length - 1;
            if (next === undefined) return;
            event.preventDefault(); selectTab(tabs[next]); tabs[next].focus();
        });
    });
    lab.querySelectorAll('[data-total]').forEach(button => button.addEventListener('click', () => {
        const correct = button.dataset.total === '5';
        lab.querySelector('[data-maths-result]').textContent = correct ? '5' : '?';
        lab.querySelector('[data-maths-feedback]').textContent = correct ? 'You did it! Two and three make five.' : 'Nearly! Try counting each dot, one at a time.';
    }));
    lab.querySelector('[data-run-code]').addEventListener('click', () => {
        lab.querySelector('[data-code-output]').textContent = 'Hello, world! 👋';
        lab.querySelector('.little-terminal').classList.add('code-ran');
    });
    const stories = {
        space: 'A friendly robot builds a moon garden. What would it plant first?',
        garden: 'A tiny robot helps a thirsty sunflower. How could it carry the water?',
        ocean: 'A curious robot meets a lost baby turtle. How could they find the way home?'
    };
    lab.querySelector('[data-make-story]').addEventListener('click', () => {
        lab.querySelector('[data-story-output]').textContent = stories[lab.querySelector('#story-setting').value];
    });
}
