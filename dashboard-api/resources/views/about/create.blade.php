<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('About') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Enter information about yourself.") }}
            </p>
        </header>

        <form class="mt-6 space-y-6" method="POST" action="{{ route('about.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col">
                <x-input-label  for="profilePhoto" class="mb-2" :value="__('Profile photo')" />
                <x-file-input
                    name="profilePhoto"
                    type="file"
                    id="profilePhoto"
                />
            </div>


            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="position" :value="__('Position')" />
                <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position')" required autofocus autocomplete="position" />
                <x-input-error class="mt-2" :messages="$errors->get('position')" />
            </div>


            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="title" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div>
                <x-input-label for="title" :value="__('Description')" />
                <x-text-area name="description" rows="8" :value="old('description')" ></x-text-area>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>


            <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>

        </form>
    </div>
</x-app-layout>
