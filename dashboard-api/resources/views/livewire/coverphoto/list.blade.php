<?php

use App\Models\CoverPhoto;
use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {

    public Collection $cover_photos;
    public ?CoverPhoto $editing = null;

    public function mount():void
    {
        $this->getCoverPhotos();
    }

    public function getCoverPhotos():void
    {
        $about = auth()->user()->about()->get()[0];
        $this->cover_photos = CoverPhoto::where('about_id',$about->id)->get();

    }

    public function edit(CoverPhoto $cover_photo):void
    {
        $this->editing = $cover_photo;
        $this->getCoverPhotos();
    }


}; ?>

<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($cover_photos as $cover_photo)

        <div class="p-6 flex space-x-2" wire:key="{{ $cover_photo->id }}">

            <div class="flex-1">
                <div class="flex justify-between items-center">

                    <div>
                        <small class="ml-2 text-sm text-gray-600">{{ $cover_photo->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($cover_photo->created_at->eq($cover_photo->updated_at))
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
                            <x-dropdown-link wire:click="edit({{ $cover_photo->id }})">
                                {{ __('Edit') }}
                            </x-dropdown-link>

                        </x-slot>

                    </x-dropdown>
                </div>

                @php
                    $url = asset(Storage::url('images/'.$cover_photo->url));
                    $size =  ($cover_photo->size == "sm")? "Pequena":"Média";
                @endphp

                @if ($cover_photo->is($editing))
                    <livewire:coverphoto.edit :socialMedia="$cover_photo" :key="$cover_photo->id" />
                @else
                    <img src="{{ $url }}" alt="{{ $cover_photo->name }}" srcset="">
                    <p class="mt-4 text-lg text-gray-900">{{ $size }}</p>
                    <p class="mt-4 text-lg text-gray-900">{{ $cover_photo->name }}</p>
                @endif

            </div>
        </div>

    @endforeach

</div>
