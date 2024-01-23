<?php

use App\Models\Skill;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\On;


new class extends Component {
    public Collection $skills;
    public ?Skill $editing = null;

    public function mount():void
    {
        $this->getSkills();
    }

    public function getSkills():void
    {
        $this->skills = auth()->user()->skill()->get();
    }

    public function edit(Skill $skill):void
    {
        $this->editing = $skill;
        $this->dispatch('hidden-create-skill');
    }

    public function delete(Skill $skill):void
    {   $this->authorize('delete', $skill);
        $skill->delete();
    }


    #[On('skill-canceled')]
    #[On('skill-created')]
    public function selfdirectSocialmed():void{
        redirect('skill');
    }

}; ?>


<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($skills as $skill)

        <div class="p-6 flex space-x-2" wire:key="{{ $skill->id }}">

            <div class="flex-1">
                <div class="flex justify-between items-center">

                    <div>
                        <small class="ml-2 text-sm text-gray-600">{{ $skill->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($skill->created_at->eq($skill->updated_at))
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
                                <x-dropdown-link wire:click="edit({{ $skill->id }})">
                                    {{ __('Edit') }}
                                </x-dropdown-link>

                                <x-dropdown-link wire:click="delete({{ $skill->id }})" wire:confirm="{{ __('Realmente deseja apagar?')}} ">
                                    {{ __('Delete') }}
                                </x-dropdown-link>

                            </x-slot>
                        </x-dropdown>
                    @endif

                </div>
                @php
                    $icon =  asset(Storage::url("images/$skill->icon"));
                @endphp

                @if ($skill->is($editing))
                    <livewire:skill.edit :skill="$skill" :key="$skill->id" />
                @else
                    <img src="{{ $icon }}" alt="{{ $skill->name }}" srcset="" class="w-10 h-10">
                    <p class="mt-4 text-lg text-gray-900">{{ $skill->name }}</p>
                    <p class="mt-4 text-lg text-gray-900">{{ $skill->url }}</p>
                @endif

            </div>
        </div>

    @endforeach

</div>
