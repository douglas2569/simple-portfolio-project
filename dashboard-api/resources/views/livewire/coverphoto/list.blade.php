<?php

use App\Models\CoverPhoto;
use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;

new class extends Component {

    public Collection $coverPhotos;
    public ?CoverPhoto $editing = null;

    public function mount():void
    {
        $this->getCoverPhotos();
    }


    #[On('cover-photo-created')]
    public function getCoverPhotos():void
    {
        $about = auth()->user()->about()->get()[0];
        $this->coverPhotos = CoverPhoto::where('about_id',$about->id)->get();

    }

    public function edit(CoverPhoto $coverPhoto):void
    {
        $this->editing = $coverPhoto;
        $this->getCoverPhotos();
        $this->dispatch('hidden-create-cover-photo');
    }

    #[On('cover-photo-updated')]
    public function disableEditing(): void

    {
        $this->editing = null;
        $this->getCoverPhotos();
    }

    #[On('cover-photo-created')]
    #[On('cover-photo-edit-canceled')]
    public function selfdirectCoverPhoto():void{
        redirect('coverphoto');
    }


}; ?>


<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($coverPhotos as $coverPhoto)

        <div class="p-6 flex space-x-2" wire:key="{{ $coverPhoto->id }}">

            <div class="flex-1">
                <div class="flex justify-between items-center">

                    <div>
                        <small class="ml-2 text-sm text-gray-600">{{ $coverPhoto->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($coverPhoto->created_at->eq($coverPhoto->updated_at))
                            <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless
                    </div>

                    <x-dropdown>
                        <x-slot name="trigger">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link wire:click="edit({{ $coverPhoto->id }})">
                                {{ __('Edit') }}
                            </x-dropdown-link>

                        </x-slot>

                    </x-dropdown>
                </div>

                @php
                    $url = asset(Storage::url('images/'.$coverPhoto->url));
                    $size =  ($coverPhoto->size == "sm")? "Pequena":"Média";
                @endphp

                @if ($coverPhoto->is($editing))
                    <livewire:coverphoto.edit :coverPhoto="$coverPhoto" :key="$coverPhoto->id" />
                @else
                    <img src="{{ $url }}" alt="{{ $coverPhoto->name }}" srcset="">
                    <p class="mt-4 text-lg text-gray-900">{{ $size }}</p>
                    <p class="mt-4 text-lg text-gray-900">{{ $coverPhoto->name }}</p>
                @endif

            </div>
        </div>

    @endforeach

</div>
