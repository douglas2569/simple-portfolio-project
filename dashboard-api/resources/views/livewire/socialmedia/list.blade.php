<?php
use App\Models\SocialMedia;
use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Collection $socialMedia;

    public function mount() : void {
        $about = auth()->user()->about()->get();
        $this->socialMedia = SocialMedia::where('about_id', $about[0]->id)->get();
    }
}; ?>

<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

    @foreach ($socialMedia as $socialMediaItem)

        <div class="p-6 flex space-x-2" wire:key="{{ $socialMediaItem->id }}">

            </svg>

            <div class="flex-1">
                <div class="flex justify-between items-center">

                    <div>
                        <small class="ml-2 text-sm text-gray-600">{{ $socialMediaItem->created_at->format('j M Y, g:i a') }}</small>
                    </div>

                </div>
                <img src="{{ $socialMediaItem->icon }}" alt="{{ $socialMediaItem->name }}" srcset="">
                <p class="mt-4 text-lg text-gray-900">{{ $socialMediaItem->name }}</p>

            </div>
        </div>

    @endforeach

</div>
