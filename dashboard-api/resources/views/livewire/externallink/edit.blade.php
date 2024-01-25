<?php
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use App\Models\ExternalLink;

new class extends Component{

    public ExternalLink $externalLinkProjectItem;

    #[Validate('required|string|max:50')]
    public string $name;
    #[Validate('required|string|max:255')]
    public string $url;
    #[Validate('required|string|max:50')]
    public string $projectId;

    public function mount():void
    {
        $this->projects = auth()->user()->project()->get();
        // $this->name = $this->externalLink->name;
        // $this->url = $this->externalLink->url;
        // $this->projectId = $this->externalLink->project_id;
    }

    public function update():void
    {
        $validated= $this->validate();
        $this->authorize('update', $this->externalLink);
        $validated['project_id'] = $this->projectId;
        $this->externalLink->update($validated);
        redirect('externalLink');
    }


    public function cancel():void
    {
        $this->dispatch('external-link-canceled');
    }


} ?>

<div>
    <form wire:submit="update">

        <select wire:model="projectId" id="photo-size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>{{ __('Choose the project this link belongs to') }}</option>
            @foreach($projects as $project)
                <option  value="{{$project->id}}">{{$project->name}}</option>
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

        <x-input-error :messages="$errors->get('projectId')" class="mt-2" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-error :messages="$errors->get('url')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
        <button class="mt-4 ml-4" wire:click.prevent="cancel" >{{__('Cancel')}}</button>

    </form>
</div>
