<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

new class extends Component {
    use WithFileUploads;

    public string $display = '';

    #[Validate('required|image|max:800')]
    public $thumbnail;
    #[Validate('string|required|max:100')]
    public string $name;
    #[Validate('string|max:100')]
    public string $videoYoutubeId = '';
    #[Validate('required|string|min:10')]
    public string $description;

    public function store():void
    {
        $validated = $this->validate();
        $validated['video_youtube_id'] = $this->videoYoutubeId;
        $this->thumbnail->store('public/images');
        $validated['thumbnail'] =  $this->thumbnail->hashName();
        auth()->user()->project()->create($validated);
        $this->dispatch('project-created');
    }

    #[On('hidden-create-project')]
    public function hiddenCreateproject():void
    {
        // $this->display = 'hidden';
        $this->display = '';
    }


}; ?>

<div class="{{$this->display}}">
    <form wire:submit="store">

        <label class="block" for="">
            <span class="sr-only">choose thumbnail</span>
            <input
                type="file"
                wire:model="thumbnail"
                class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-violet-700
                    hover:file:bg-violet-100"
            />
        </label>

        <input
            wire:model="name"
            placeholder="{{ __('Name') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <div>
            <textarea wire:model="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your description here...">

            </textarea>
        </div>

        <input
            wire:model="videoYoutubeId"
            placeholder="{{ __('Video Youtube ID') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />


        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-error :messages="$errors->get('videoYoutubeId')" class="mt-2" />
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>

    </form>
</div>
