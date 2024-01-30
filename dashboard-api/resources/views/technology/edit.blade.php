<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
         <form method="POST" action="{{ route('technology.update', $technology) }}" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <input
                name="name"
                placeholder="{{ __('Name') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{$technology->name}}"
            />

            <select name="color" id="photo-size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>{{ __('What color is your technology?') }}</option>
                <option {{ ($technology->color == 'default') ? 'selected' : '' }} value="default" style="font-weight:bold">Padrão</option>
                <option {{ ($technology->color == 'blue') ? 'selected' : '' }} value="blue" style="color:blue; font-weight:bold">Azul</option>
                <option {{ ($technology->color == 'gray') ? 'selected' : '' }} value="gray" style="color:gray; font-weight:bold">Cinza</option>
                <option {{ ($technology->color == 'red') ? 'selected' : '' }} value="red" style="color:red; font-weight:bold">Vermelho</option>
                <option {{ ($technology->color == 'green') ? 'selected' : '' }} value="green" style="color:green; font-weight:bold">Verde</option>
                <option {{ ($technology->color == 'yellow') ? 'selected' : '' }} value="yellow" style="color:yellow; font-weight:bold">Amarelo</option>
                <option {{ ($technology->color == 'indigo') ? 'selected' : '' }} value="indigo" style="color:indigo; font-weight:bold">Índigo</option>
                <option {{ ($technology->color == 'purple') ? 'selected' : '' }} value="purple" style="color:purple; font-weight:bold">Roxo</option>
                <option {{ ($technology->color == 'pink') ? 'selected' : '' }} value="pink" style="color:pink; font-weight:bold">Rosa</option>
            </select>

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <x-input-error :messages="$errors->get('color')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('technology.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>

    </div>
</x-app-layout>
