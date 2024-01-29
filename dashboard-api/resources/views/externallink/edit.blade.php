<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
         <form method="POST" action="{{ route('externallink.update', $externallink) }}" enctype="multipart/form-data">
            @method('patch')

            @csrf
            <select name="project_id" id="photo-size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>{{ __('Choose the project this link belongs to') }}</option>
                @foreach($projects as $project)
                    <option {{ ($project->id == $externallink->project_id )? 'selected' : '' }}  value="{{$project->id}}">{{$project->name}}</option>
                @endforeach
            </select>

            @csrf
            <input
                name="name"
                placeholder="{{ __('Name') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{$externallink->name}}"
            />

            @csrf
            <input
                name="url"
                placeholder="{{ __('URL') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{$externallink->url}}"
            />


            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <x-input-error :messages="$errors->get('url')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('externallink.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>

    </div>
</x-app-layout>
