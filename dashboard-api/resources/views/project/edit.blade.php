<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Project') }}
            </h2>

            <p class="mt-1 text-base text-gray-600">
                {{ __("Update your project.") }}
            </p>
        </header>
         <form class="mt-6 space-y-6" method="POST" action="{{ route('project.update', $project) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="flex flex-col">
                <x-input-label  for="thumbnail" class="mb-2" :value="__('Project')" />
                <x-file-input-image
                    type="file"
                    :imagePath="$project->thumbnail"
                    name="thumbnail"
                    id="thumbnail"
                    :rounded="__('sm')"
                    :height="__('h-20')"
                    :width="__('w-auto')"

                />
                <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
            </div>


            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $project->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="video-youtube-id" :value="__('ID video youtube')" />
                <x-text-input id="video-youtube-id" name="video_youtube_id" type="text" class="mt-1 block w-full" :value="old('video_youtube_id', $project->video_youtube_id)" required autocomplete="video_youtube_id" />
                <x-input-error class="mt-2" :messages="$errors->get('video_youtube_id')" />
            </div>

            <div>
                <x-input-label for="title" :value="__('Description')" />
                <x-text-area name="description" rows="8" :value="old('description', $project->description)" ></x-text-area>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="title" :value="__('Technologies')" />
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
            </div>

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('project.index') }}">{{ __('Cancel') }}</a>
            </div>
            </form>

    </div>
</x-app-layout>
