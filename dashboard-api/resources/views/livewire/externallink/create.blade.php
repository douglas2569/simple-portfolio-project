<?php

use App\Models\ExternalLink;
use Illuminate\Database\Eloquent\Collection;
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

    public Collection $projects;

    public function store()
    {
        $validated = $this->validate();
        $validated['project_id'] = $validated['projectId'];
        ExternalLink::create($validated);

        $this->dispatch('external-link-created');
    }

    public function mount():void
    {
        $this->projects = auth()->user()->project()->get();
    }

    #[On('hidden-create-external-link-photo')]
     public function hiddenCreateExternalLink():void
     {
        $this->display = 'hidden';
     }


}; ?>

<div class="{{$this->display}}">
    <form wire:submit="store">

        <select wire:model="projectId" id="photo-size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>{{ __('Choose the project this link belongs to') }}</option>
            @foreach($projects as $project)
                <option value="{{$project->id}}">{{$project->name}}</option>
            @endforeach
        </select>

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
        <x-input-error :messages="$errors->get('projectId')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>

    </form>
</div>
