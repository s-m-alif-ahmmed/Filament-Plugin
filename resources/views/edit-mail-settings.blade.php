<x-filament::page>
    <form wire:submit.prevent="save">
        {{ $this->form }}
        <button type="submit" class="filament-button filament-button-primary mt-4">Save</button>
    </form>

    @if(session()->has('success'))
        <div class="mt-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif
</x-filament::page>
