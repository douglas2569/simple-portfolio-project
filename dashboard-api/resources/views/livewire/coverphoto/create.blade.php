<?php
use App\Models\CoverPhoto;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

new class extends Component {
    use WithFileUploads;

    public string $display = '';

    #[Validate('image|max:1024')]
    public $image;
    #[Validate('required|string|min:4')]
    public string $name;
    #[Validate('required|string|min:2')]
    public string $size;

    public function store(){
        if(count(auth()->user()->about()->get()[0]->coverPhoto()->get()) >= 2)
            return;
        $validated = $this->validate();
        $this->image->store('public/images');
        $validated['image'] = $this->image->hashName();
        $validated['about_id'] = (auth()->user()->about()->get()[0])->id;
        auth()->user()->about()->get()[0]->coverPhoto()->create($validated);
        // CoverPhoto::create($validated);

        $this->dispatch('cover-photo-created');
     }

     #[On('hidden-create-cover-photo')]
     public function hiddenCreateCoverPhoto():void
     {
        // $this->display = 'hidden';
        $this->display = '';
     }

}; ?>

<div class="{{$this->display}}" >
    <form wire:submit="store">
        <label class="block" for="">
            <span class="sr-only">Choose cover photo</span>
            <input
                type="file"
                wire:model="image"
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
        <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>

    </form>
</div>
