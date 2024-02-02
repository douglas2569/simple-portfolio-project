<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Technology') }}
            </h2>

            <p class="mt-1 text-base text-gray-600">
                {{ __("Update your technology.") }}
            </p>
        </header>
         <form class="py-4 px-8 space-y-4" method="POST" action="{{ route('technology.update', $technology) }}" enctype="multipart/form-data">
            @method('patch')
            @csrf

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $technology->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="color" :value="__('Color')" />
                <select name="color" id="photo-size" class="bg-violet-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-violet-500 focus:border-violet-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-violet-500 dark:focus:border-violet-500">
                    <option>{{ __('What color is your technology?') }}</option>
                    <option {{ ($technology->color == 'default') ? 'selected' : '' }} value="default" style="font-weight:bold">Padrão</option>
                    <option {{ ($technology->color == 'violet') ? 'selected' : '' }} value="violet" style="color:violet; font-weight:bold">Azul</option>
                    <option {{ ($technology->color == 'gray') ? 'selected' : '' }} value="gray" style="color:gray; font-weight:bold">Cinza</option>
                    <option {{ ($technology->color == 'red') ? 'selected' : '' }} value="red" style="color:red; font-weight:bold">Vermelho</option>
                    <option {{ ($technology->color == 'green') ? 'selected' : '' }} value="green" style="color:green; font-weight:bold">Verde</option>
                    <option {{ ($technology->color == 'yellow') ? 'selected' : '' }} value="yellow" style="color:yellow; font-weight:bold">Amarelo</option>
                    <option {{ ($technology->color == 'indigo') ? 'selected' : '' }} value="indigo" style="color:indigo; font-weight:bold">Índigo</option>
                    <option {{ ($technology->color == 'purple') ? 'selected' : '' }} value="purple" style="color:purple; font-weight:bold">Roxo</option>
                    <option {{ ($technology->color == 'pink') ? 'selected' : '' }} value="pink" style="color:pink; font-weight:bold">Rosa</option>
                </select>
                <x-input-error :messages="$errors->get('color')" class="mt-2" />
            </div>

            <div class="flex gap-8 items-center">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('technology.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>

    </div>
</x-app-layout>
