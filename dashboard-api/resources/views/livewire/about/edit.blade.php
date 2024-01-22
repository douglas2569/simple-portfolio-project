<?php

use App\Models\About;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

new class extends Component {
    use WithFileUploads;

    public About $about;

    // #[Validate('image|max:100', onUpdate:false)]
    public $profilePhoto;

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
        $this->profilePhoto = asset(Storage::url('images/'.$this->about->profile_photo));
        $this->name = $this->about->name;
        $this->position = $this->about->position;
        $this->title = $this->about->title;
        $this->description = $this->about->description;
    }


    public function update():void
    {
        $validated_about = $this->validate();

        if(gettype($this->profilePhoto) == 'object'){
            $this->profilePhoto = Validator::make(
                ['profile_photo' => $this->profilePhoto],
                ['profile_photo' => 'image|max:100'],
                ['required' => 'The :attribute field is required'],
             )->validate();

             $this->profilePhoto['profile_photo']->store('public/images');
             $validated_about['profile_photo'] =  $this->profilePhoto['profile_photo']->hashName();
             $imageName = explode('/', $this->about->profilePhoto);
             Storage::delete('public/images/'.$imageName[0]);
        }


        $this->authorize('update',$this->about);
        $this->about->update($validated_about);

        redirect('about');

    }

}; ?>

<div>
    <form wire:submit="update">

        <div class="flex items-center space-x-6">
            @if($profilePhoto)
                <div class="shrink-0">
                    <img
                        class="h-16 w-16 object-cover rounded-full"
                        src="{{$profilePhoto}}" />
                </div>
            @endif

            <label class="block">
                <span class="sr-only">Choose profile photo</span>
                <input
                    wire:model="profilePhoto"
                    type="file"
                    class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-violet-700
                    hover:file:bg-violet-100
                "/>
            </label>
        </div>

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

        <x-input-error :messages="$errors->get('profilePhoto')" class="mt-2" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
        <x-input-error :messages="$errors->get('position')" class="mt-2" />
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>

    </form>
</div>
