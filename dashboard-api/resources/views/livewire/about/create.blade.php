<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {

    #[Validate('required|string|min:10')]
    public string $profile_photo;
    #[Validate('required|string|max:255')]
    public string $name;
    #[Validate('required|string|max:100')]
    public string $position;
    #[Validate('required|string|max:100')]
    public string $title;
    #[Validate('required|string|min:20')]
    public string $description;

    public function store():void
    {
        $validated_about = $this->validate();
        auth()->user()->about()->create($validated_about);

        redirect('about');

    }

}; ?>

<div>
    <form wire:submit="store">
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

        <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
        <x-input-error :messages="$errors->get('position')" class="mt-2" />
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>

    </form>
</div>
