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
         @if(count($about) > 0)
            <form class="p-8" method="POST" action="{{ route('coverphoto.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col">
                    <x-input-label  for="image" class="mb-2" :value="__('Cover photo')" />
                        <x-file-input
                            name="image"
                            id="image"
                            type="file"
                        />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
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
                     />
                     <x-input-error :messages="$errors->get('size')" class="mt-2" />
                </div>

                <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
            </form>
        @else
            {{ $message['content'] }}
        @endif

        @if(count($about) > 0 && count($coverphotos) <= 0)
            {{ $message['content'] }}
        @endif

        @foreach ($coverphotos as $coverphoto)

            <div class="p-6 flex space-x-2">
                <div class="flex-1">
                    <div class="flex justify-between items-center">

                        <div>
                            <small class="ml-2 text-sm text-gray-600">{{ $coverphoto->created_at->format('j M Y, g:i a') }}</small>
                            @unless ($coverphoto->created_at->eq($coverphoto->updated_at))
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
                                    <x-dropdown-link :href="route('coverphoto.edit', $coverphoto)">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('coverphoto.destroy', $coverphoto) }}">

                                        @method('delete')
                                        <x-dropdown-link :href="route('coverphoto.destroy', $coverphoto)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>

                            </x-dropdown>

                    </div>

                    @php
                        $image = asset(Storage::url('images/'.$coverphoto->image));
                        $size =  ($coverphoto->size == "sm")? __("Small"):__("Medium");
                    @endphp

                    <div>
                        <img src="{{ $image }}" alt="{{ $coverphoto->name }}" srcset="">
                        <p class="mt-4 text-base text-gray-900">{{ $size }}</p>
                        <p class="mt-1 text-base text-gray-900">{{ $coverphoto->name }}</p>
                    </div>

                </div>
            </div>

        @endforeach

    </div>
</x-app-layout>
