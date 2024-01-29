<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

            <form method="POST" action="{{ route('project.store') }}" enctype="multipart/form-data">
                <label class="block" for="">
                <span class="sr-only">{{__('Choose the thumbnail')}}</span>
                @csrf
                <input
                    name="thumbnail"
                    type="file"
                    class="block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-violet-50 file:text-violet-700
                            hover:file:bg-violet-100"
                />
                </label>

                @csrf
                <input
                    name="name"
                    placeholder="{{ __('Name') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                />

                @csrf
                <input
                    name="video_youtube_id"
                    placeholder="{{ __('ID video Youtube') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                />

                @csrf
                <textarea
                    name="description"
                    placeholder="{{ __('Write your description here...') }}"
                    rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                ></textarea>

                <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <x-input-error :messages="$errors->get('video_youtube_id')" class="mt-2" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
            </form>

        @if(count($projects) <= 0)
            {{ $message['content'] }}
        @endif

        @foreach ($projects as $project)

            <div class="p-6 flex space-x-2">
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
                    @endphp

                    <div>
                        <img  src="{{ $thumbnail }}" alt="{{ $project->name }}" srcset="">
                        <p class="mt-4 text-lg text-gray-900">{{ $project->name }}</p>
                    </div>

                </div>
            </div>

        @endforeach

    </div>
</x-app-layout>