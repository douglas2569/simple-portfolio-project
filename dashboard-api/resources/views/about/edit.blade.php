<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('About') }}
            </h2>

            <p class="mt-1 text-base text-gray-600">
                {{ __("Update information about you.") }}
            </p>
        </header>

        <form class="py-4 px-8 space-y-4" method="POST" action="{{ route('about.update',$about) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="flex flex-col">
                <x-input-label  for="profilePhoto" class="mb-2" :value="__('Profile photo')" />
                <x-file-input-image
                    type="file"
                    :imagePath="$about->profile_photo"
                    name="profilePhoto"
                    id="profilePhoto"
                    :rounded="__('full')"
                    :height="__('h-16')"
                    :width="__('w-16')"

                />
            </div>

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $about->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="position" :value="__('Position')" />
                <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position', $about->position)" required autofocus autocomplete="position" />
                <x-input-error class="mt-2" :messages="$errors->get('position')" />
            </div>


            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $about->title)" required autofocus autocomplete="title" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div>
                <x-input-label for="title" :value="__('Description')" />
                <x-text-area name="description" rows="8" :value="old('description', $about->description)" ></x-text-area>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>


            <div>
                <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
            </div>

        </form>




    </div>
</x-app-layout>
