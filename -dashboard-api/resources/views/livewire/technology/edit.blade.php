<?php

use Livewire\Volt\Component;
use App\Models\Technology;
use Livewire\Attributes\Validate;

new class extends Component {

    public Technology $technology;

    #[Validate('string|max:50|required')]
    public $color;
    #[Validate('string|max:50|required')]
    public string $name;

    public function mount():void
    {
        $this->name = $this->technology->name;
        $this->color = $this->technology->color;
    }

    public function update():void
    {
        $validated= $this->validate();

        $this->authorize('update',$this->technology);
        $this->technology->update($validated);

        redirect('technology');
    }

    public function cancel():void
    {
        $this->dispatch('technology-canceled');
    }

}; ?>

<div>
    <form wire:submit="update">

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
        <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
        <button class="mt-4 ml-4" wire:click.prevent="cancel" >{{__('Cancel')}}</button>

    </form>
</div>
