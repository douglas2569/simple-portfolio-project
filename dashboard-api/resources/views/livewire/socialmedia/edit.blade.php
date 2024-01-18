<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use App\Models\SocialMedia;

new class extends Component {
    public SocialMedia $socialMedia;

    #[Validate('required|string|max:255')]
    

}; ?>

<div>
    //
</div>
