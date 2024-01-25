<?php

use App\Models\SkillTechnology;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

new class extends Component {
    use WithFileUploads;

    public string $display = '';

    #[Validate('image|max:50')]
    public $icon;
    #[Validate('string|required|max:100')]
    public string $name;
    #[Validate('required')]
    public $technologiesIds = [];

    public Collection $technologies;

    public function store():void
    {
        $validated = $this->validate();
        $this->icon->store('public/images');
        $validated['icon'] =  $this->icon->hashName();
        try {
            DB::beginTransaction();

            auth()->user()->skill()->create($validated);
            $lastSkillId = (auth()->user()->skill()->latest()->get())[0]->id;

            foreach($this->technologiesIds as $technologyId){
                SkillTechnology::create(['skill_id'=>$lastSkillId, 'technology_id'=>$technologyId]);
            }

            DB::commit();
        } catch (Exception $th) {
           echo $th->getMessage();
            DB::rollBack();
        }


        $this->dispatch('skill-created');
    }

    public function mount():void
    {
        $this->technologies = auth()->user()->technology()->get();
    }

    #[On('hidden-create-skill')]
    public function hiddenCreateSkill():void
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

    <div>
        <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Technology</h3>
        <ul class="grid sm:grid-cols-5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @foreach($technologies as $technology)
                <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input  wire:model="technologiesIds" id="{{$technology->name}}-checkbox" type="checkbox" value="{{$technology->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="{{$technology->name}}-checkbox" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$technology->name}}</label>
                    </div>
                </li>
            @endforeach

        </ul>
    </div>

        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-error :messages="$errors->get('technologiesIds')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>

    </form>
</div>
