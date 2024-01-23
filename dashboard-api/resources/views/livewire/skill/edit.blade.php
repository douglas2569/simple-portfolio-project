<?php

use Livewire\Volt\Component;
use App\Models\Skill;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public Skill $skill;

    public $icon;
    #[Validate('string|max:50|required')]
    public string $name;

    public function mount():void
    {
        $this->name = $this->skill->name;
        $this->icon = asset('storage/images/'.$this->skill->icon);
    }

    public function update():void
    {
        $validated= $this->validate();

        if(gettype($this->icon) == 'object'){
            $this->icon = Validator::make(
                ['icon' => $this->icon],
                ['icon' => 'image|max:50'],
                ['required' => 'The :attribute field is required'],
             )->validate();

             $this->icon['icon']->store('public/images');
             $validated['icon'] =  $this->icon['icon']->hashName();
             $imageName = explode('/', $this->skill->icon);
             Storage::delete('public/images/'.$imageName[0]);
            }

            $this->authorize('update',$this->skill);

            $this->skill->update($validated);

            redirect('skill');
    }

    public function cancel():void
    {
        $this->dispatch('skill-canceled');
    }

}; ?>

<div>
    <form wire:submit="update">
        <div class="flex items-center space-x-6">
            @if($icon)
                <div class="shrink-0">
                    <img
                        class="w-10 h-10 object-cover rounded-sm"
                        src="{{$icon}}" />
                </div>
            @endif


            <label class="block" for="">
                <span class="sr-only">Choose icon</span>
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
        </div>

        <input
            wire:model="name"
            placeholder="{{ __('Name') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />


        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
        <button class="mt-4 ml-4" wire:click.prevent="cancel" >{{__('Cancel')}}</button>

    </form>
</div>
