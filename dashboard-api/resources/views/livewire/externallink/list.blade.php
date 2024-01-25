<?php
use App\Models\ExternalLink;
use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\ViewProjectExternalLink;
new class extends Component {
    public $externalLinksProjects = array();
    public ?ViewProjectExternalLink $editing = null;

    public function mount() : void
    {
            $this->getAllExternalLinksByProjects();
    }

    public function getAllExternalLinksByProjects():void
    {
        $this->projects = auth()->user()->project()->get();
        foreach($this->projects as $project){
            array_push($this->externalLinksProjects, ViewProjectExternalLink::where('project_id', $project->id)->get());

        }

    }

    public function edit(ViewProjectExternalLink $externalLink):void
    {
        $this->editing = $externalLink;
        // $this->getAllExternalLinksByProjects();
        // $this->dispatch('hidden-create-external-link');
    }

    public function delete(ExternalLink $externalLink):void
    {
        $this->authorize('delete', $externalLink);
        $externalLink->delete();
        $this->getAllExternalLinksByProjects();
    }

    #[On('external-link-canceled')]
    public function selfdirectExternalLink():void
    {
        redirect('externallink');
    }

}; ?>

<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($externalLinksProjects as $key => $externalLinkProject)
        <div class="flex-1 mb-4">
            @if(count($externalLinksProjects[$key]) > 0)
                <h4>{{$externalLinksProjects[$key][0]->project_name}}</h4>
            @endif

            @foreach ($externalLinkProject as $externalLinkProjectItem)
                <div class="flex justify-between items-center">
                    <div>
                        @php
                            date_default_timezone_set('America/Fortaleza');
                            $dateCreated = new DateTime( $externalLinkProjectItem->external_link_created_at);
                            $dateUpdated = new DateTime( $externalLinkProjectItem->external_link_updated_at);
                        @endphp

                        <small class="ml-2 text-sm text-gray-600">{{ $dateCreated->format("j M Y, g:i a") }}</small>
                        @unless ($dateCreated == $dateUpdated)
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
                                <x-dropdown-link wire:click="edit({{ $externalLinkProjectItem }})">
                                    {{ __('Edit') }}
                                </x-dropdown-link>

                                <x-dropdown-link wire:click="delete({{ $externalLinkProjectItem }})" wire:confirm="{{ __('Realmente deseja apagar?')}} ">
                                    {{ __('Delete') }}
                                </x-dropdown-link>

                            </x-slot>
                        </x-dropdown>
                    @endif


                    @if ($externalLinkProjectItem->is($editing))
                        <livewire:externallink.edit :externalLinkProjectItem="$externalLinkProjectItem" :key="$externalLinkProject->external_link_id" />
                    @else
                        <div class="flex flex-col" >
                            <p class="text-lg text-gray-900">{{ $externalLinkProjectItem->external_link_name }}</p>
                            <p class="text-lg text-gray-900">{{ $externalLinkProjectItem->external_link_url }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach
</div>

