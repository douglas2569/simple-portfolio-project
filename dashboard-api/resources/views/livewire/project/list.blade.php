<?php

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\On;


new class extends Component {
    public Collection $projects;
    public ?Project $editing = null;

    public function mount():void
    {
        $this->getProjects();
    }

    public function getProjects():void
    {
        $this->projects = auth()->user()->project()->get();
    }

    public function edit(Project $project):void
    {
        $this->editing = $project;
        $this->dispatch('hidden-create-project');
    }

    public function delete(Project $project):void
    {   $this->authorize('delete', $project);
        $project->delete();
        $this->getProjects();
    }


    #[On('project-canceled')]
    #[On('project-created')]
    public function selfdirectProject():void{
        redirect('project');
    }

}; ?>


<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($projects as $project)

        <div class="p-6 flex space-x-2" wire:key="{{ $project->id }}">

            <div class="flex-1">
                <div class="flex justify-between items-center">

                    <div>
                        <small class="ml-2 text-sm text-gray-600">{{ $project->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($project->created_at->eq($project->updated_at))
                            <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless
                    </div>

                    @if(!$editing)
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link wire:click="edit({{ $project->id }})">
                                    {{ __('Edit') }}
                                </x-dropdown-link>

                                <x-dropdown-link wire:click="delete({{ $project->id }})" wire:confirm="{{ __('Realmente deseja apagar?')}} ">
                                    {{ __('Delete') }}
                                </x-dropdown-link>

                            </x-slot>
                        </x-dropdown>
                    @endif
                </div>
                @php
                    $thumbnail =  asset(Storage::url("images/$project->thumbnail"));
                    $technologies = App\Models\ViewProjectTechnology::where('project_id', $project->id)->get();
                @endphp

                @if ($project->is($editing))
                    <livewire:project.edit :myTechnologies="$technologies" :project="$project" :key="$project->id" />
                @else
                    <img src="{{ $thumbnail }}" alt="{{ $project->name }}" srcset="" class="w-30">
                    <p class="mt-4 text-lg text-gray-900">{{ $project->name }}</p>
                    <p class="mt-4 text-lg text-gray-900">{{ $project->description }}</p>
                @endif

            </div>
        </div>

    @endforeach

</div>
