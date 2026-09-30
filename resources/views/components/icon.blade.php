@props(['name' => 'arrow'])
<svg {{ $attributes->merge(['class' => 'icon']) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
@switch($name)
@case('book') <path d="M12 5C8 2 3 3 2 4v15c3-2 7-1 10 1 3-2 7-3 10-1V4c-3-2-7-1-10 1v15"/><path d="M5 8h3m-3 4h3m8-4h3m-3 4h3"/> @break
@case('spark') <path d="m12 3 2.5 6.5L21 12l-6.5 2.5L12 21l-2.5-6.5L3 12l6.5-2.5L12 3ZM20 2v4m-2-2h4"/> @break
@case('computer') <rect x="3" y="3" width="18" height="13" rx="2"/><path d="M8 21h8m-4-5v5m-4-14 2 2-2 2m5 0h3"/> @break
@case('bulb') <path d="M9 18h6m-5 3h4M8 14a7 7 0 1 1 8 0l-1 2H9l-1-2Z"/> @break
@case('users') <circle cx="9" cy="7" r="3"/><path d="M2 21v-3a7 7 0 0 1 14 0v3m1-17a3 3 0 0 1 0 6m3 11v-3a6 6 0 0 0-2-4"/> @break
@case('check') <path d="m5 12 4 4L19 6"/> @break
@case('shield') <path d="m12 2 8 4v6c0 5-8 10-8 10S4 17 4 12V6l8-4Z"/><path d="m8 12 3 3 5-6"/> @break
@case('phone') <path d="m7 3 3 5-3 3a14 14 0 0 0 6 6l3-3 5 3c0 3-2 5-5 4A21 21 0 0 1 3 8C2 5 4 3 7 3Z"/> @break
@case('chat') <path d="M21 11a9 9 0 0 1-13 8l-6 3 2-6a9 9 0 1 1 17-5Z"/><path d="M8 9h8m-8 4h5"/> @break
@case('pin') <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/> @break
@case('heart') <path d="M20 5c-3-3-7-1-8 2-1-3-5-5-8-2s-1 7 1 9l7 7 7-7c2-2 4-6 1-9Z"/> @break
@case('target') <circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/> @break
@case('globe') <circle cx="12" cy="12" r="9"/><ellipse cx="12" cy="12" rx="4" ry="9"/><path d="M3 12h18"/> @break
@default <path d="M4 12h16m-6-6 6 6-6 6"/>
@endswitch
</svg>
