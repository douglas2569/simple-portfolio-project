<?php

use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\On;


new class extends Component {
    public Collection $skills;


    public function getSkills():void
    {
        $this->skills = auth()->user()->skill()->get();
    }

    #[On('skill-created')]
    public function selfdirectSocialmed():void{
        redirect('skill');
    }

}; ?>

<div>

</div>
