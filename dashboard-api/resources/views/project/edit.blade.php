<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
         <form method="POST" action="{{ route('project.update', $project) }}" enctype="multipart/form-data">
            @method('patch')

                <div class="flex items-center space-x-6">
                    @if($project->thumbnail)
                            <div class="shrink-0">
                                <img
                                    class="h-16 object-cover rounded-md"
                                    src="{{asset('storage/images/'.$project->thumbnail)}}" />
                            </div>
                    @endif

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
                </div>

                @csrf
                <input
                    name="name"
                    placeholder="{{ __('Name') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    value="{{$project->name}}"
                />

                @csrf
                <input
                    name="video_youtube_id"
                    placeholder="{{ __('ID video Youtube') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    value="{{$project->video_youtube_id}}"
                />

                @csrf
                <textarea
                    name="description"
                    placeholder="{{ __('Write your description here...') }}"
                    rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >{{$project->description}}
                </textarea>

                <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <x-input-error :messages="$errors->get('video_youtube_id')" class="mt-2" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
            </form>

    </div>
</x-app-layout>
