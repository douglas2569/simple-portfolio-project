<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Technologies') }}
            </h2>

            <p class="mt-1 text-base text-gray-600">
                {{ __("Add your technologies.") }}
            </p>
        </header>

        <form class="p-8" method="POST" action="{{ route('technology.store') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="color" :value="__('Color')" />
                <select name="color" id="color" class="bg-violet-50  border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-violet-700 focus:border-violet-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-violet-500 dark:focus:border-violet-500">
                    <option selected>{{ __('What color is your technology?') }}</option>
                    <option value="default" style="font-weight:bold">Padrão</option>
                    <option value="violet" style="color:violet; font-weight:bold">Azul</option>
                    <option value="gray" style="color:gray; font-weight:bold">Cinza</option>
                    <option value="red" style="color:red; font-weight:bold">Vermelho</option>
                    <option value="green" style="color:green; font-weight:bold">Verde</option>
                    <option value="yellow" style="color:yellow; font-weight:bold">Amarelo</option>
                    <option value="indigo" style="color:indigo; font-weight:bold">Índigo</option>
                    <option value="purple" style="color:purple; font-weight:bold">Roxo</option>
                    <option value="pink" style="color:pink; font-weight:bold">Rosa</option>
                </select>

                <x-input-error :messages="$errors->get('color')" class="mt-2" />
            </div>

            <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
        </form>

        @if(count($technologies) <= 0)
            {{ $message['content'] }}
        @endif


<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

    @foreach ($technologies as $technology)

        <div class="p-6 flex space-x-2">
            <div class="flex-1">
                <div class="flex justify-between items-center">

                    <div>
                        <small class="ml-2 text-sm text-gray-600">{{ $technology->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($technology->created_at->eq($technology->updated_at))
                            <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless
                    </div>

                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('technology.edit', $technology)">
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('technology.destroy', $technology) }}">
                                    @csrf
                                    @method('delete')
                                    <x-dropdown-link :href="route('technology.destroy', $technology)" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Delete') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>

                        </x-dropdown>

                </div>

                <div>

                    <p class="mt-1 text-base text-gray-900">{{ $technology->name }}</p>
                    <p class="mt-1 text-base text-gray-900">{{ $technology->color }}</p>

                </div>

            </div>
        </div>

    @endforeach
</div>
</x-app-layout>
