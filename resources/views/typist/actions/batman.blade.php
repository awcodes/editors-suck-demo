@props([
    'name' => null,
    'color' => null,
    'side' => null
])

<div
    @class([
      'p-4 flex items-center gap-6 rounded-xl border-x-4',
      match($color) {
        'yellow' => 'border-yellow-500 bg-yellow-500/10',
        'purple' => 'border-purple-500 bg-purple-500/10',
        'green' => 'border-emerald-600 bg-emerald-600/10',
        'red' => 'border-red-600 bg-red-600/10',
        default => 'border-gray-800 bg-gray-950',
      }
    ])
>
    <div class="text-5xl">
        <img src="{{ asset('images/' . str($name)->slug() . '.png') }}" alt="{{ $name }}" width="100" height="100" class="not-prose"/>
    </div>
    <div>
        <h2 class="mt-0 mb-0">{{ $name }}</h2>
        <p class="mt-0">{{ str($side)->ucfirst() }}</p>
    </div>
</div>
