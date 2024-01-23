<?php

use App\Models\Technology;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\On;


new class extends Component {
    public Collection $technologys;
    public ?Technology $editing = null;

    public function mount():void
    {
        $this->getTechnologies();
    }

    public function getTechnologies():void
    {
        $this->technologys = auth()->user()->technology()->get();
    }

    public function edit(Technology $technology):void
    {
        $this->editing = $technology;
        $this->dispatch('hidden-create-technology');
    }

    public function delete(Technology $technology):void
    {   $this->authorize('delete', $technology);
        $technology->delete();
        $this->getTechnologies();
    }


    #[On('technology-canceled')]
    #[On('technology-created')]
    public function selfdirectSocialmed():void{
        redirect('technology');
    }

}; ?>


<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($technologys as $technology)

        <div class="p-6 flex space-x-2" wire:key="{{ $technology->id }}">

            <div class="flex-1">
                <div class="flex justify-between items-center">

                    <div>
                        <small class="ml-2 text-sm text-gray-600">{{ $technology->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($technology->created_at->eq($technology->updated_at))
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
                                <x-dropdown-link wire:click="edit({{ $technology->id }})">
                                    {{ __('Edit') }}
                                </x-dropdown-link>

                                <x-dropdown-link wire:click="delete({{ $technology->id }})" wire:confirm="{{ __('Realmente deseja apagar?')}} ">
                                    {{ __('Delete') }}
                                </x-dropdown-link>

                            </x-slot>
                        </x-dropdown>
                    @endif

                </div>

                @if ($technology->is($editing))
                    <livewire:technology.edit :technology="$technology" :key="$technology->id" />
                @else
                    <p class="mt-4 text-lg text-gray-900">{{ $technology->name }}</p>
                    <p class="mt-4 text-lg text-gray-900">{{ $technology->color }}</p>
                @endif

            </div>
        </div>

    @endforeach

</div>
