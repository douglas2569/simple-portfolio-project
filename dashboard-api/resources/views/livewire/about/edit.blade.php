<?php

use App\Models\About;
use App\Models\CoverPhoto;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {
    public About $about;
    // public $cover_photos;

    #[Validate('required|string|min:10')]
    public string $large_cover_photo;
    #[Validate('required|string|min:10')]
    public string $medium_cover_photo;

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

    public function mount():void    {
        $this->about = (auth()->user()->about()->get())[0];

        $this->cover_photos = CoverPhoto::where('about_id', $this->about->id)->get();
        // print_r($this->cover_photos); die();

        // $this->large_cover_photo = $this->cover_photo->large_cover_photo;
        // $this->medium_cover_photo = $this->cover_photo->medium_cover_photo;
        $this->profile_photo = $this->about->profile_photo;
        $this->name = $this->about->name;
        $this->position = $this->about->position;
        $this->title = $this->about->title;
        $this->description = $this->about->description;
    }


    public function update():void
    {
        $this->authorize('update',$this->about);
        $validated = $this->validate();
        $this->about->update($validated);

    }

}; ?>

<div>
    <form wire:submit="update">
        <input
            wire:model="large_cover_photo"
            placeholder="{{ __('Cover Photo Large') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <input
            wire:model="medium_cover_photo"
            placeholder="{{ __('Cover Photo Medium') }}"
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
        <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>

    </form>
</div>
