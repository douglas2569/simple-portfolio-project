<?php
use App\Models\ExternalLink;
use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\ViewProjectExternalLink;
new class extends Component {
    public $externalLinksProjects = array();
    public ?ExternalLink $editing = null;

    public function mount() : void {
            $this->getAllExternalLinksByProjects();
    }

    public function getAllExternalLinksByProjects():void{
        $this->projects = auth()->user()->project()->get();

        foreach($this->projects as $project){
            array_push($this->externalLinksProjects, ViewProjectExternalLink::where('project_id', $project->id)->get());
        }

    }

    public function edit(ExternalLink $externalLink):void{
        $this->editing = $externalLink;
        $this->getAllExternalLinksByProjects();
        $this->dispatch('hidden-create-external-link-photo');
    }

    public function delete(externalLink $externalLink):void
    {
        $this->authorize('delete', $externalLink);
        $externalLink->delete();
        $this->getAllExternalLinksByProjects();
    }

    #[On('external-link-canceled')]
    public function selfdirectExternalLink():void{
        redirect('externallink');
    }

}; ?>

<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($externalLinksProjects as $externalLinkProject)
        @foreach ($externalLinkProject as $externalLinkProjectItem)

        <div class="p-6 flex space-x-2" wire:key="{{ $externalLinkProjectItem->project_id }}">

            <div class="flex-1">
                <div class="flex justify-between items-center">

                    <div>
                        <small class="ml-2 text-sm text-gray-600">{{ $externalLinkProjectItem->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($externalLinkProjectItem->created_at->eq($externalLinkProjectItem->updated_at))
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
                                <x-dropdown-link wire:click="edit({{ $externalLinkProjectItem->id }})">
                                    {{ __('Edit') }}
                                </x-dropdown-link>

                                <x-dropdown-link wire:click="delete({{ $externalLinkProjectItem->id }})" wire:confirm="{{ __('Realmente deseja apagar?')}} ">
                                    {{ __('Delete') }}
                                </x-dropdown-link>

                            </x-slot>
                        </x-dropdown>
                    @endif

                </div>
                @php
                    $icon =  asset(Storage::url("images/$externalLinkProjectItem->icon"));
                @endphp

                @if ($externalLinkProjectItem->is($editing))
                    <livewire:socialmedia.edit :socialMedia="$externalLinkProjectItem" :key="$externalLinkProjectItem->id" />
                @else
                    <img src="{{ $icon }}" alt="{{ $externalLinkProjectItem->name }}" srcset="" class="w-10 h-10">
                    <p class="mt-4 text-lg text-gray-900">{{ $externalLinkProjectItem->name }}</p>
                    <p class="mt-4 text-lg text-gray-900">{{ $externalLinkProjectItem->url }}</p>
                @endif

            </div>
        </div>

        @endforeach
    @endforeach

</div>

