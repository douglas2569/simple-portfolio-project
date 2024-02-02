<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('External Link') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Update your external link.") }}
            </p>
        </header>
         <form class="mt-6 space-y-6" method="POST" action="{{ route('externallink.update', $externallink) }}" enctype="multipart/form-data">
            @method('patch')
            @csrf

            <div>
                @php
                    $options = [];
                    foreach($projects as $project):
                        array_push($options, ['value' =>$project->id, 'name'=> $project->name]);
                    endforeach
                @endphp
                <x-input-label for="project-id" :value="__('Project')" />
                <x-select
                    :message="__('Choose the project this link belongs to')"
                    :options="$options"
                    id="project-id"
                    name="project_id"
                    :conditionSelect="$externallink->project_id"
                    />
                    <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $externallink->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="url" :value="__('URL')" />
                <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" :value="old('url', $externallink->url)" required autofocus autocomplete="url" />
                <x-input-error class="mt-2" :messages="$errors->get('url')" />
            </div>


            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('externallink.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>

    </div>
</x-app-layout>
