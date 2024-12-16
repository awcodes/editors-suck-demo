@props([
    'color' => null,
])

<div
    {{ $attributes->class([
        '
        prose max-w-none
        prose-headings:font-display prose-headings:mb-6
        prose-h1:text-2xl prose-h1:md:text-4xl
        ',
        match ($color) {
            'primary', 'bg-gradient-bars-primary', 'bg-gradient-radial-primary' => 'prose-primary dark dark:prose-invert text-white',
            'secondary', 'bg-gradient-bars-secondary', 'bg-gradient-radial-secondary' => 'prose-secondary',
            'tertiary', 'bg-gradient-bars-tertiary', 'bg-gradient-radial-tertiary' => 'prose-tertiary',
            'accent', 'bg-gradient-bars-accent', 'bg-gradient-radial-accent' => 'prose-accent',
            'gray', 'bg-gradient-bars-gray', 'bg-gradient-radial-gray' => 'prose-gray',
            default => null,
        },
    ])->merge() }}
>
    {!! $slot !!}
</div>
