<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}

        <div class="fi-fo-actions flex flex-wrap items-center gap-3 justify-start">
            <x-filament::button
                type="submit"
                size="sm"
            >
                Simpan Perubahan
            </x-filament::button>
        </div>
    </form>

    <x-filament-actions::modals />
</x-filament-panels::page>
