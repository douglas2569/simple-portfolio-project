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
                    @if ($externalLinkProjectItem->is($editing))

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

