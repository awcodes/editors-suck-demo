<x-filament-panels::page>
    <form wire:submit="save" spellcheck="false">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit" >Save</x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
