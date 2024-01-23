<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

new class extends Component {

    public string $display = '';

    #[Validate('string|required|max:100')]
    public string $name;
    #[Validate('string|required|max:100')]
    public string $color;

    public function store():void
    {
        $validated = $this->validate();

        auth()->user()->technology()->create($validated);
        $this->dispatch('technology-created');
    }

    #[On('hidden-create-technology')]
    public function hiddenCreateTechnology():void
    {
        $this->display = 'hidden';
    }


}; ?>

<div class="{{$this->display}}">
    <form wire:submit="store">

        <input
            wire:model="name"
            placeholder="{{ __('Name') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        />

        <select wire:model="color" id="photo-size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Qual o cor de sua tecnologia?</option>
            <option value="default" style="font-weight:bold">Padrão</option>
            <option value="blue" style="color:blue; font-weight:bold">Azul</option>
            <option value="gray" style="color:gray; font-weight:bold">Cinza</option>
            <option value="red" style="color:red; font-weight:bold">Vermelho</option>
            <option value="green" style="color:green; font-weight:bold">Verde</option>
            <option value="yellow" style="color:yellow; font-weight:bold">Amarelo</option>
            <option value="indigo" style="color:indigo; font-weight:bold">Índigo</option>
            <option value="purple" style="color:purple; font-weight:bold">Roxo</option>
            <option value="pink" style="color:pink; font-weight:bold">Rosa</option>
        </select>


        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
        <x-input-error :messages="$errors->get('color')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>

    </form>
</div>
