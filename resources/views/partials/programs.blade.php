<section class="section" id="programs" aria-labelledby="programs-title"><div class="wrap">
<div class="section-heading"><div><div class="eyebrow">ROOM TO LEARN. SPACE TO GROW.</div><h2 id="programs-title">Strong foundations.<br><span class="muted-heading">A world of possibilities.</span></h2></div><p>Help children grow in academics and technology with All Subjects support, guided AI learning, and creative skill development in one structured learning environment.</p></div>
<div class="program-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
@foreach([
['book', 'blue', '01', 'Tuition Classes', 'PREP–CLASS 8', 'A little guidance. A lot more confidence.', ['All Subjects', 'Strong Concepts', 'Homework Support', 'Test Preparation'], 'tuition', 'Explore tuition'],
['spark', 'coral', '02', 'AI for Kids', 'AGE 7+', 'Turn curious questions into creative ideas.', ['AI Basics & Safe AI Use', 'Creativity & Prompting', 'Logical Thinking'], 'ai', 'Discover AI learning'],
['computer', 'blue', '03', 'Computer & Digital Skills', 'BUILD DIGITAL CONFIDENCE', 'Make technology a tool for learning.', ['Computer Basics', 'Digital Awareness', 'Coding Exposure', 'Smart Learning Tools'], 'contact', 'Let’s talk skills'],
['bulb', 'gold', '04', 'Creative Skill Development', 'LEARNING BEYOND BOOKS', 'Give bright ideas a place to take shape.', ['Problem Solving', 'Communication', 'Hands-on Projects', 'Curiosity-based Learning'], 'contact', 'Explore the possibilities']
] as [$icon, $color, $number, $title, $tag, $copy, $items, $anchor, $cta])
<article class="program-card"><div class="flex items-center justify-between"><span class="icon-box {{ $color }}"><x-icon :name="$icon"/></span><span class="card-number">{{ $number }}</span></div><p class="program-tag">{{ $tag }}</p><h3>{{ $title }}</h3><p class="card-copy">{{ $copy }}</p><ul class="check-list">@foreach($items as $item)<li><x-icon name="check"/>{{ $item }}</li>@endforeach</ul><a class="text-link" href="#{{ $anchor }}">{{ $cta }} <x-icon/></a></article>
@endforeach
</div>
</div></section>
