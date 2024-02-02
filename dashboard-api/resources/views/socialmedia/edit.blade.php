<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Social Media') }}
            </h2>

            <p class="mt-1 text-base text-gray-600">
                {{ __("Update your social media.") }}
            </p>
        </header>
         <form class="mt-6 space-y-6" method="POST" action="{{ route('socialmedia.update', $socialmedia) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="flex flex-col">
                <x-input-label for="icon" class="mb-2" :value="__('Icon')" />
                <x-file-input-image
                    type="file"
                    :imagePath="$socialmedia->icon"
                    name="icon"
                    id="icon"
                    :rounded="__('full')"
                    :height="__('h-16')"
                    :width="__('w-16')"
                />
                <x-input-error :messages="$errors->get('icon')" class="mt-2" />
            </div>


            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $socialmedia->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="url" :value="__('URL')" />
                <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" :value="old('url',$socialmedia->url)" required autocomplete="url" />
                <x-input-error class="mt-2" :messages="$errors->get('url')" />
            </div>

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <x-input-error :messages="$errors->get('icon')" class="mt-2" />
            <x-input-error :messages="$errors->get('url')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('socialmedia.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>

    </div>
</x-app-layout>
