<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        @foreach ($getActions() as $action)
            {{ $action }}
        @endforeach
    </div>
</x-dynamic-component>
