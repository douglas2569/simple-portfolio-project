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

    #[On('external-link-created')]
    #[On('external-link-canceled')]
    public function selfdirectSocialmed():void{
        redirect('externallink');
    }

}; ?>
<div></div>
