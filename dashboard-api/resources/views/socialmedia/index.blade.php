<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Social Media') }}
            </h2>

            <p class="mt-1 text-base text-gray-600">
                {{ __("Add your social media.") }}
            </p>
        </header>
         @if(count($about) > 0)
            <form class="p-8" method="POST" action="{{ route('socialmedia.store') }}" enctype="multipart/form-data">
            @csrf

                <div class="flex flex-col">
                    <x-input-label  for="icon" class="mb-2" :value="__('Icon')" />
                        <x-file-input
                            name="icon"
                            id="icon"
                            type="file"
                        />
                    <x-input-error :messages="$errors->get('icon')" class="mt-2" />
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

        @if(count($about) > 0 && count($socialmedia) <= 0)
            {{ $message['content'] }}
        @endif

        @foreach ($socialmedia as $socialmediaitem)

            <div class="p-6 flex space-x-2">
                <div class="flex-1">
                    <div class="flex justify-between items-center">

                        <div>
                            <small class="ml-2 text-sm text-gray-600">{{$socialmediaitem->created_at->format('j M Y, g:i a')}}</small>
                            @unless ($socialmediaitem->created_at->eq($socialmediaitem->updated_at))
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
                                    <x-dropdown-link :href="route('socialmedia.edit', $socialmediaitem)">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('socialmedia.destroy', $socialmediaitem) }}">

                                        @method('delete')
                                        <x-dropdown-link :href="route('socialmedia.destroy', $socialmediaitem)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>

                            </x-dropdown>

                    </div>

                    @php
                        $icon = asset(Storage::url('images/'.$socialmediaitem->icon));
                    @endphp

                    <div class="flex items-center gap-4 pt-2">
                        <img class="w-10 h-10" src="{{ $icon }}" alt="{{ $socialmediaitem->name }}" srcset="">
                        <div>
                            <p class="text-base font-medium text-gray-600">{{$socialmediaitem->name}}</p>
                            <p class="text-base text-gray-900">{{$socialmediaitem->url}}</p>
                        </div>
                    </div>

                </div>
            </div>

        @endforeach

    </div>
</x-app-layout>
