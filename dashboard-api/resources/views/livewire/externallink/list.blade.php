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
    @foreach ($externalLinksProjects as $key => $externalLinkProject)
        <div class="flex-1 mb-4">
            <h4>{{$externalLinksProjects[$key][0]->project_name}}</h4>
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

                    @if ($externalLinkProjectItem->is($editing))
                    <livewire:externallink.edit :externalLinkProject="$externalLinkProjectItem" :key="$externalLinkProject->external_link_id" />
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

