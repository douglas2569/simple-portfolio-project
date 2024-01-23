<?php

use Livewire\Volt\Component;
use App\Models\Project;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public Project $project;

    public $thumbnail;
    #[Validate('string|max:50|required')]
    public string $name;
    #[Validate('string|max:100')]
    public string $videoYotubeId;
    #[Validate('|required|string|min:10')]
    public string $description;

    public function mount():void
    {
        $this->name = $this->project->name;
        $this->description = $this->project->description;
        $this->videoYotubeId = $this->project->video_youtube_id??'';
        $this->thumbnail = asset('storage/images/'.$this->project->thumbnail);
    }

    public function update():void
    {
        $validated = $this->validate();
        $validated['video_youtube_id'] = $validated['videoYotubeId'];

        if(gettype($this->thumbnail) == 'object'){
            $this->thumbnail = Validator::make(
                ['thumbnail' => $this->thumbnail],
                ['thumbnail' => 'image|max:800'],
                ['required' => 'The :attribute field is required'],
             )->validate();

             $this->thumbnail['thumbnail']->store('public/images');
             $validated['thumbnail'] =  $this->thumbnail['thumbnail']->hashName();
             $imageName = explode('/', $this->project->thumbnail);
             Storage::delete('public/images/'.$imageName[0]);
            }

            $this->authorize('update',$this->project);

            $this->project->update($validated);

            redirect('project');
    }

    public function cancel():void
    {
        $this->dispatch('project-canceled');
    }

}; ?>

<div>
    <form wire:submit="update">
        <div class="flex items-center space-x-6">
            @if($thumbnail)
                <div class="shrink-0">
                    <img
                        class="h-20 object-cover rounded-sm"
                        src="{{$thumbnail}}" />
                </div>
            @endif


            <label class="block" for="">
                <span class="sr-only">Choose thumbnail</span>
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
        </div>

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
            wire:model="videoYotubeId"
            placeholder="{{ __('Video Youtube ID') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />


        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-error :messages="$errors->get('videoYotubeId')" class="mt-2" />
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
        <button class="mt-4 ml-4" wire:click.prevent="cancel" >{{__('Cancel')}}</button>

    </form>
</div>
