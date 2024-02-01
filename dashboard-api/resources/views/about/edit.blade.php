<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('About') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Update information about you.") }}
            </p>
        </header>

        <form class="mt-6 space-y-6" method="POST" action="{{ route('about.update',$about) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="flex items-center space-x-6">

                @if($about->profile_photo)
                    <div class="shrink-0">
                        <img
                            class="h-16 w-16 object-cover rounded-full"
                            src="{{asset('storage/images/'.$about->profile_photo)}}" />
                    </div>
                @endif

                <label class="block">
                    <span class="sr-only">Choose profile photo</span>

                    <input
                    name="profilePhoto"
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
                <x-text-area name="description" rows="8" :value="old('description', $about->description)" ></x-text-area>
            </div>


            <x-input-error :messages="$errors->get('profilePhoto')" class="mt-2" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
            <x-input-error :messages="$errors->get('position')" class="mt-2" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>

        </form>




    </div>
</x-app-layout>
