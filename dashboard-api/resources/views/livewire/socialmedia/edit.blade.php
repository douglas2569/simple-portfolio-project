<?php
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

new class extends Component{
    use WithFileUploads;

    public SocialMedia $socialMedia;

    public $icon;
    #[Validate('required|string|max:50')]
    public string $name;
    #[Validate('required|string|max:255')]
    public string $url;

    public function mount():void
    {
        $this->icon = asset(Storage::url('images/'.$this->socialMedia->icon));
        $this->name = $this->socialMedia->name;
        $this->url = $this->socialMedia->url;
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
             $imageName = explode('/', $this->socialMedia->icon);
             Storage::delete('public/images/'.$imageName[0]);
            }

            $this->authorize('update',$this->socialMedia);

            $this->socialMedia->update($validated);

            redirect('socialmedia');
    }

    public function cancel():void
    {
        $this->dispatch('social-media-canceled');
    }


} ?>

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

        <input
            wire:model="url"
            placeholder="{{ __('URL') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-error :messages="$errors->get('url')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
        <button class="mt-4 ml-4" wire:click.prevent="cancel" >{{__('Cancel')}}</button>

    </form>
</div>
