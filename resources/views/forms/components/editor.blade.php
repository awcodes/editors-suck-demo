<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <div class="toolbar"></div>
        <div class="instance"></div>
    </div>
</x-dynamic-component>
