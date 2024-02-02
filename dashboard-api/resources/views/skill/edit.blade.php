<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Skill') }}
            </h2>

            <p class="mt-1 text-base text-gray-600">
                {{ __("Update your skill.") }}
            </p>
         <form class="py-4 px-8 space-y-4" method="POST" action="{{ route('skill.update', $skill) }}" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="flex flex-col">
                <x-input-label for="icon" class="mb-2" :value="__('Skill')" />
                <x-file-input-image
                    type="file"
                    :imagePath="$skill->icon"
                    name="icon"
                    id="icon"
                    :rounded="__('sm')"
                    :height="__('h-16')"
                    :width="__('w-auto')"
                />
                <x-input-error :messages="$errors->get('icon')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $skill->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <ul class="grid sm:grid-cols-5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                @foreach($technologies as $technology)
                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input
                                name="technologiesIds[]"
                                id="{{$technology->id}}-checkbox"
                                type="checkbox"
                                value="{{$technology->id}}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                {{ ( in_array($technology->id, $myTechnologies) ) ? 'checked' : '' }}
                                >
                            <label for="{{$technology->id}}-checkbox" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$technology->name}}</label>
                        </div>
                    </li>
                @endforeach
             </ul>
             <x-input-error :messages="$errors->get('technologiesIds')" class="mt-2" />


            <div class="flex gap-8 items-center">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('skill.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>

    </div>
</x-app-layout>
