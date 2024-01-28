<?php

use App\Models\CoverPhoto;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public CoverPhoto $coverPhoto;

    public $image;
    #[Validate('required|string|max:50')]
    public string $name;
    #[Validate('required|string|max:2')]
    public string $size;


    public function mount():void
    {
        $this->image = asset('storage/images/'.$this->coverPhoto->image);
        $this->name = $this->coverPhoto->name;
        $this->size = $this->coverPhoto->size;
    }

    public function update():void
    {
        $validated= $this->validate();

        if(gettype($this->image) == 'object'){
            $this->image = Validator::make(
                ['image' => $this->image],
                ['image' => 'image|max:1024'],
                ['required' => 'The :attribute field is required'],
             )->validate();

             $this->image['image']->store('public/images');
             $validated['image'] =  $this->image['image']->hashName();
             $imageName = explode('/', $this->coverPhoto->image);
             Storage::delete('public/images/'.$imageName[0]);
            }

            $this->authorize('update',$this->coverPhoto);
            $this->coverPhoto->update($validated);
            redirect('coverphoto');

    }

    public function cancel(): void
    {
        $this->dispatch('cover-photo-edit-canceled');

    }

}; ?>


<div >
    <form wire:submit="update">
        <div class="flex items-center space-x-6">
                @if($image)
                    <div class="shrink-0">
                        <img
                            class="h-16 object-cover rounded-sm"
                            src="{{$image}}" />
                    </div>
                @endif

                <label class="block">
                    <span class="sr-only">Choose cover photo</span>
                    <input
                        wire:model="image"
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
            placeholder="{{ __('Nome') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <select wire:model="size" id="photo-size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Qual o tamanho da imagem?</option>
            <option value="sm">Pequena</option>
            <option value="md">Média</option>
        </select>


        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
        <x-input-error :messages="$errors->get('size')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
        <button class="mt-4 ml-4" wire:click.prevent="cancel">{{ __('Cancel') }}</button>

    </form>
</div>