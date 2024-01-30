<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
         <form method="POST" action="{{ route('skill.update', $skill) }}" enctype="multipart/form-data">
            @method('patch')

                <div class="flex items-center space-x-6">
                    @if($skill->icon)
                            <div class="shrink-0">
                                <img
                                    class="h-16 object-cover rounded-md"
                                    src="{{asset('storage/images/'.$skill->icon)}}" />
                            </div>
                    @endif

                    <label class="block" for="">
                    <span class="sr-only">{{__('Choose the icon')}}</span>
                    @csrf
                    <input
                        name="icon"
                        type="file"
                        class="block w-full text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-violet-50 file:text-violet-700
                                hover:file:bg-violet-100"
                    />
                    </label>
                </div>

            @csrf
            <input
                name="name"
                placeholder="{{ __('Name') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{$skill->name}}"
            />

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

            <x-input-error :messages="$errors->get('icon')" class="mt-2" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('skill.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>

    </div>
</x-app-layout>
