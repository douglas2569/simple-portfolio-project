<?php

use App\Models\ExternalLink;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;


new class extends Component {

    public string $display = '';

    #[Validate('required|string|max:50')]
    public string $name;
    #[Validate('required|string|max:255')]
    public string $url;
    #[Validate('required|string|max:255')]
    public string $projectId;

    public function store()
    {
        $validated = $this->validate();
        $validated['project_id'] = $validated['projectId'];
        ExternalLink::create($validated);

        $this->dispatch('external-link-created');
    }

    #[On('hidden-create-external-link-photo')]
     public function hiddenCreateExternalLink():void
     {
        $this->display = 'hidden';
     }


}; ?>

<div class="{{$this->display}}">
    <form wire:submit="store">

        <input
            wire:model="projectId"
            placeholder="{{ __('Project ID') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <input
            wire:model="name"
            placeholder="{{ __('Name') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <input
            wire:model="url"
            placeholder="{{ __('URL') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-error :messages="$errors->get('url')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>

    </form>
</div>
