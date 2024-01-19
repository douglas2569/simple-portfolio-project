<?php

use App\Models\CoverPhoto;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    #[Validate('required|string|min:10')]
    public string $name;
    #[Validate('required|string|min:10')]
    public string $url;
    #[Validate('required|string|min:10')]
    public string $size;

    public function create(){
        $validated = $this->validate();
        $validated['about_id'] = (auth()->user()->about()->get()[0])->id;
        CoverPhoto::created($validated);
     }

}; ?>

<div>
    <form wire:submit="store">
        <input
            wire:model="name"
            placeholder="{{ __('Nome') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <input
            wire:model="url"
            placeholder="{{ __('URL') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />


        <select wire:model="size" id="photo-size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Qual o tamanho da imagem?</option>
            <option value="md">Média</option>
            <option value="lg">Grande</option>
        </select>


        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-error :messages="$errors->get('url')" class="mt-2" />
        <x-input-error :messages="$errors->get('size')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>

    </form>
</div>
