<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
         @if(count($projects) > 0)
         <form method="POST" action="{{ route('externallink.store') }}" enctype="multipart/form-data">

                @csrf
                <select name="project_id" id="photo-size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>{{ __('Choose the project this link belongs to') }}</option>
                    @foreach($projects as $project)
                        <option value="{{$project->id}}">{{$project->name}}</option>
                    @endforeach
                </select>

                @csrf
                <input
                    name="name"
                    placeholder="{{ __('Name') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                />

                @csrf
                <input
                    name="url"
                    placeholder="{{ __('URL') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                />


                <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <x-input-error :messages="$errors->get('url')" class="mt-2" />
                <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
            </form>
        @else
            {{ $message['content'] }}
        @endif

        @if(count($projects) > 0 && count($externalLinksProjects[0]) <= 0)
            {{ $message['content'] }}
        @endif


<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

    @foreach ($externalLinksProjects as $key => $externalLinkProject)
        <div class="flex-1 mb-4">
            @if(count($externalLinksProjects[$key]) > 0)
                <h4 >{{$externalLinksProjects[$key][0]->project_name}}</h4>
            @endif

            @foreach ($externalLinkProject as $externalLinkProjectItem)

            <div class="p-6 flex space-x-2">
                <div class="flex-1">
                    <div class="flex justify-between items-center">

                        <div>
                            @php
                                date_default_timezone_set('America/Fortaleza');
                                $dateCreated = new DateTime( $externalLinkProjectItem->external_link_created_at);
                                $dateUpdated = new DateTime( $externalLinkProjectItem->external_link_updated_at);
                            @endphp

                            <small class="ml-2 text-sm text-gray-600">{{ $dateCreated->format("j M Y, g:i a") }}</small>
                            @unless ($dateCreated == $dateUpdated)
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
                                    <x-dropdown-link :href="route('externallink.edit', $externalLinkProjectItem)">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('externallink.destroy', $externalLinkProjectItem) }}">
                                        @csrf
                                        @method('delete')
                                        <x-dropdown-link :href="route('externallink.destroy', $externalLinkProjectItem)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>

                            </x-dropdown>

                    </div>

                    <div>
                        <p class="mt-4 text-lg text-gray-900">{{ $externalLinkProjectItem->external_link_name }}</p>
                        <p class="mt-4 text-lg text-gray-900">{{ $externalLinkProjectItem->external_link_url }}</p>
                    </div>

                </div>
            </div>

        @endforeach
    </div>
    @endforeach
</div>
</x-app-layout>
