<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Projects') }}
            </h2>

            <p class="mt-1 text-base text-gray-600">
                {{ __("Register your projects.") }}
            </p>
        </header>

        @if(count($technologies) > 0)
            <form class="p-8" method="POST" action="{{ route('project.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col">
                <x-input-label  for="thumbnail" class="mb-2" :value="__('Thumbnail')" />
                <x-file-input
                    name="thumbnail"
                    type="file"
                    id="thumbnail"
                />
            </div>

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="video-youtube-id" :value="__('ID video youtube')" />
                <x-text-input id="video-youtube-id" name="video_youtube_id" type="text" class="mt-1 block w-full" :value="old('video_youtube_id')" required autocomplete="video_youtube_id" />
                <x-input-error class="mt-2" :messages="$errors->get('video_youtube_id')" />
            </div>

            <div>
                <x-input-label for="title" :value="__('Description')" />
                <x-text-area name="description" rows="8" :value="old('description')" ></x-text-area>
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
                                    id="{{$technology->name}}-checkbox"
                                    type="checkbox"
                                    value="{{$technology->id}}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="{{$technology->name}}-checkbox" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$technology->name}}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <x-input-error :messages="$errors->get('technologiesIds')" class="mt-2" />
            </div>
            <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
            </form>
        @else
            {{ $message['content'] }}
        @endif

        @if(count($technologies) > 0 && count($projects) <= 0)
            {{ $message['content'] }}
        @endif

        <div class="flex grid sm:grid-cols-2 gap-3 mt-4">
        @foreach ($projects as $project)

                <div class="flex-1">
                    <div class="flex justify-between items-center">

                        <div>
                            <small class="ml-2 text-sm text-gray-600">{{ $project->created_at->format('j M Y, g:i a') }}</small>
                            @unless ($project->created_at->eq($project->updated_at))
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
                                    <x-dropdown-link :href="route('project.edit', $project)">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('project.destroy', $project) }}">
                                        @csrf
                                        @method('delete')
                                        <x-dropdown-link :href="route('project.destroy', $project)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>

                            </x-dropdown>

                    </div>

                    @php
                        $thumbnail = asset(Storage::url('images/'.$project->thumbnail));
                        $myTechnologies = App\Models\ViewProjectTechnology::where('project_id', $project->id)->get();
                    @endphp

                    <div>
                        <img src="{{ $thumbnail }}" alt="{{ $project->name }}" srcset="">
                        <p class="mt-4 text-base text-gray-600">{{ $project->name }}</p>
                        <ul class="grid text-base grid-cols-4">
                            @foreach($myTechnologies as $technology)
                                <li>{{$technology->technology_name}}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            @endforeach
        </div>
</x-app-layout>
