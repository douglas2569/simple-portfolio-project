<?php
use App\Models\SocialMedia;
use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;

new class extends Component {
    public Collection $socialMedia;
    public ?SocialMedia $editing = null;


    public function mount() : void {
            $this->getSocialMedia();
    }

    public function getSocialMedia():void{
        $about = auth()->user()->about()->get();
        $this->socialMedia = SocialMedia::where('about_id', $about[0]->id)->get();
    }


    public function edit(SocialMedia $socialMedia):void{
        $this->editing = $socialMedia;
        $this->getSocialMedia();
        $this->dispatch('hidden-create-social-media-photo');
    }

    public function delete(SocialMedia $socialMedia):void
    {
        $this->authorize('delete', $socialMedia);
        $socialMedia->delete();
        $this->getSocialMedia();
    }

    #[On('social-media-created')]
    #[On('social-media-canceled')]
    public function selfdirectSocialmed():void{
        redirect('socialmedia');
    }

}; ?>

<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($socialMedia as $socialMediaItem)

        <div class="p-6 flex space-x-2" wire:key="{{ $socialMediaItem->id }}">

            <div class="flex-1">
                <div class="flex justify-between items-center">

                    <div>
                        <small class="ml-2 text-sm text-gray-600">{{ $socialMediaItem->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($socialMediaItem->created_at->eq($socialMediaItem->updated_at))
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
                                <x-dropdown-link wire:click="edit({{ $socialMediaItem->id }})">
                                    {{ __('Edit') }}
                                </x-dropdown-link>

                                <x-dropdown-link wire:click="delete({{ $socialMediaItem->id }})" wire:confirm="{{ __('Realmente deseja apagar?')}} ">
                                    {{ __('Delete') }}
                                </x-dropdown-link>

                            </x-slot>
                        </x-dropdown>
                    @endif

                </div>
                @php
                    $icon =  asset(Storage::url("images/$socialMediaItem->icon"));
                @endphp

                @if ($socialMediaItem->is($editing))
                    <livewire:socialmedia.edit :socialMedia="$socialMediaItem" :key="$socialMediaItem->id" />
                @else
                    <img src="{{ $icon }}" alt="{{ $socialMediaItem->name }}" srcset="" class="w-10 h-10">
                    <p class="mt-4 text-lg text-gray-900">{{ $socialMediaItem->name }}</p>
                    <p class="mt-4 text-lg text-gray-900">{{ $socialMediaItem->url }}</p>
                @endif

            </div>
        </div>

    @endforeach

</div>
