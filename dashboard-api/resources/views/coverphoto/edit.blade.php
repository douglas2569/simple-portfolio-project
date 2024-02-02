<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Cover Photo') }}
            </h2>

            <p class="mt-1 text-base text-gray-600">
                {{ __("Update your cover images. Small for cell phones and medium for devices with larger screens.") }}
            </p>
        </header>
         <form class="py-4 px-8 space-y-4" method="POST" action="{{ route('coverphoto.update', $coverphoto) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="flex flex-col">
                <x-input-label for="image" class="mb-2" :value="__('Cover photo')" />
                <x-file-input-image
                    type="file"
                    :imagePath="$coverphoto->image"
                    name="image"
                    id="image"
                    :rounded="__('sm')"
                    :height="__('h-16')"
                    :width="__('w-auto')"
                />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $coverphoto->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
            <x-input-label for="size" :value="__('Size')" />
                <x-select
                    :message="__('How big is the image?')"
                    :options="[ ['value' =>'sm', 'name'=> 'Small'],
                                ['value' =>'md', 'name'=> 'Medium'] ]"
                    id="size"
                    name="size"
                    :conditionSelect="$coverphoto->size"
                />
                <x-input-error :messages="$errors->get('size')" class="mt-2" />
            </div>


            <div class="mt-4 space-x-2">
                <div class="flex gap-8 items-center">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                    <a href="{{ route('coverphoto.index') }}">{{ __('Cancel') }}</a>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>
