<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use App\Models\SocialMedia;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;


new class extends Component {
    #[Validate('required|string|max:255')]
    public string $icon;
    #[Validate('required|string|max:255')]
    public string $name;

    public Collection $about;

    public function store()
    {
        if (!Auth::check()) return;

        $validated = $this->validate();
        $about = auth()->user()->about()->get();
        $validated['about_id'] = $about[0]->id;
        SocialMedia::create($validated);

        $this->dispatch('social-media-created');
    }
}; ?>

<div>
    <form wire:submit="store">
        <input
            wire:model="icon"
            placeholder="{{ __('Icone') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />
        <input
            wire:model="name"
            placeholder="{{ __('Name') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>

    </form>
</div>
