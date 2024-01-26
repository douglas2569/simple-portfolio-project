<?php

use Livewire\Volt\Component;
use App\Models\Skill;
use App\Models\SkillTechnology;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

new class extends Component {
    use WithFileUploads;

    public Skill $skill;
    public Collection $myTechnologies;
    public Collection $allTechnologies;

    public $icon;
    #[Validate('string|max:50|required')]
    public string $name;
    // #[Validate('required')]
    public $technologiesIds = [];

    public function mount():void
    {
        $this->name = $this->skill->name;
        $this->icon = asset('storage/images/'.$this->skill->icon);
        $this->allTechnologies = auth()->user()->technology()->get();

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

            try {
                DB::beginTransaction();

                $this->authorize('update',$this->skill);
                $this->skill->update($validated);
                if(count($this->technologiesIds) > 0){
                    SkillTechnology::where(['skill_id'=>$this->skill->id])->delete();

                    foreach($this->technologiesIds as $technologyId){
                        SkillTechnology::create(['skill_id'=>$this->skill->id, 'technology_id'=>$technologyId]);
                    }
                }

                DB::commit();
             } catch (Exception $th) {
                echo $th->getMessage();
                DB::rollBack();
            }

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

        <ul class="grid sm:grid-cols-5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">

            @foreach($allTechnologies as $technology)
                <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input
                            wire:model="technologiesIds"
                            id="{{$technology->id}}-checkbox"
                            type="checkbox"
                            value="{{$technology->id}}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="{{$technology->id}}-checkbox" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$technology->name}}</label>
                    </div>
                </li>
            @endforeach
        </ul>

        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
        <button class="mt-4 ml-4" wire:click.prevent="cancel" >{{__('Cancel')}}</button>

    </form>
</div>
