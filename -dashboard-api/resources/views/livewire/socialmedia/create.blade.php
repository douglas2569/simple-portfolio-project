<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;


new class extends Component {
    use WithFileUploads;

    public string $display = '';

    #[Validate('image|max:50')]
    public $icon;
    #[Validate('required|string|max:100')]
    public string $name;
    #[Validate('required|string|max:255')]
    public string $url;

    public function store()
    {
        $validated = $this->validate();
        $this->icon->store('public/images');
        $validated['icon'] = $this->icon->hashName();
        $about = auth()->user()->about()->get();
        $validated['about_id'] = $about[0]->id;
        auth()->user()->about()->get()[0]->socialMedia()->create($validated);
        // SocialMedia::create($validated);

        $this->dispatch('social-media-created');
    }

    #[On('hidden-create-social-media-photo')]
     public function hiddenCreateSocialMediaPhoto():void
     {
        // $this->display = 'hidden';
        $this->display = '';
     }


}; ?>

<div class="{{$this->display}}">
    <form wire:submit="store">

        <label class="block" for="">
            <span class="sr-only">choose icon</span>
            <input
                type="file"
                wire:model="icon"
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

        <input
            wire:model="url"
            placeholder="{{ __('URL') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-error :messages="$errors->get('url')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>

    </form>
</div>