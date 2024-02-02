<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('External Link') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Add your external link.") }}
            </p>
        </header>
         @if(count($projects) > 0)
        <form class="mt-6 space-y-6" method="POST" action="{{ route('externallink.store') }}" enctype="multipart/form-data">
                @csrf

                <div>
                    @php
                        $options = [];
                        foreach($projects as $project):
                            array_push($options, ['value' =>$project->id, 'name'=> $project->name]);
                        endforeach
                    @endphp
                    <x-input-label for="project-id" :value="__('Size')" />
                    <x-select
                        :message="__('Choose the project this link belongs to')"
                        :options="$options"
                        id="project-id"
                        name="project_id"
                     />
                     <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="url" :value="__('URL')" />
                    <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" :value="old('url')" required autocomplete="url" />
                    <x-input-error class="mt-2" :messages="$errors->get('url')" />
                </div>

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

            <div class="flex space-x-2">
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
                        <p class="mt-2 font-medium text-sm text-gray-600">{{ $externalLinkProjectItem->external_link_name }}</p>
                        <p class="mt-2 text-sm text-gray-900">{{ $externalLinkProjectItem->external_link_url }}</p>
                    </div>

                </div>
            </div>

        @endforeach
    </div>
    @endforeach
</div>
</x-app-layout>
