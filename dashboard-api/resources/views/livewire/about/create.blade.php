<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Rule;
use Illuminate\Http\Request;

new class extends Component {
    #[Rule('required|string|min:10')]
    public string $cover_photo;
    #[Rule('required|string|min:10')]
    public string $profile_photo;
    #[Rule('required|string|max:255')]
    public string $name;
    #[Rule('required|string|max:100')]
    public string $position;
    #[Rule('required|string|max:100')]
    public string $title;
    #[Rule('required|string|min:20')]
    public string $description;    

    // public function store(Request $request)
    public function store()
    {
        $validated = $this->validate();                
        auth()->user()->about()->create($validated);        
    }

}; ?>

<div>
    <form wire:submit="store">
        <input
            wire:model="cover_photo"
            placeholder="{{ __('Cover Photo') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />
        <input
            wire:model="profile_photo"
            placeholder="{{ __('Profile Photo') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />
        <input
            wire:model="name"
            placeholder="{{ __('Name') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <input
            wire:model="position"
            placeholder="{{ __('Position') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <input
            wire:model="title"
            placeholder="{{ __('Title') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <input
            wire:model="description"
            placeholder="{{ __('Description') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <x-input-error :messages="$errors->get('cover_photo')" class="mt-2" />
        <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
        <x-input-error :messages="$errors->get('position')" class="mt-2" />
        <x-input-error :messages="$errors->get('description')" class="mt-2" />        
        <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>

    </form>
</div>
