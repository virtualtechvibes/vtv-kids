<section class="section" id="why-us" aria-labelledby="why-title"><div class="wrap">
<div class="center-heading"><div class="eyebrow">A LITTLE MORE CARE. A LOT MORE GROWTH.</div><h2 id="why-title">Your child is more than a roll number.</h2><p>A welcoming local academy where every question matters<br class="desktop-break"> and every learner gets the attention they deserve.</p></div>
<div class="why-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
@foreach([
['book', 'All Subjects Support', 'One familiar learning space for school subjects, stronger concepts, and everyday progress.'],
['spark', 'AI Learning for Kids', 'Guided exploration of tomorrow’s tools, designed for curious learners age 7 and above.'],
['users', 'Small Batches', 'More room to ask questions, take part, and learn at a comfortable pace.'],
['heart', 'Personal Attention', 'Support that starts with understanding your child’s strengths and learning needs.'],
['target', 'Homework & Test Support', 'Clear explanations and purposeful practice that help children prepare with confidence.'],
['bulb', 'Creative Skill Development', 'Projects that encourage problem solving, communication, and independent thinking.']
] as [$icon, $title, $copy])<article class="why-card"><span class="icon-box blue"><x-icon :name="$icon"/></span><div><h3>{{ $title }}</h3><p>{{ $copy }}</p></div></article>@endforeach
</div><div class="experience-banner"><x-icon name="shield"/><strong>Guided by 20+ Years of IT Experience</strong><span>Real-world knowledge. Thoughtfully brought into learning.</span></div>
</div></section>
