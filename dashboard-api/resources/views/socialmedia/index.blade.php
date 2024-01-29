<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
         @if(count($about) > 0)
            <form method="POST" action="{{ route('socialmedia.store') }}" enctype="multipart/form-data">
                <label class="block" for="">
                <span class="sr-only">{{__('Choose social media')}}</span>
                @csrf
                <input
                    name="icon"
                    type="file"
                    class="block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-violet-50 file:text-violet-700
                            hover:file:bg-violet-100"
                />
                </label>

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

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                <x-input-error :messages="$errors->get('url')" class="mt-2" />
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
                            <small class="ml-2 text-sm text-gray-600">{{ $socialmediaitem->created_at->format('j M Y, g:i a') }}</small>
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
                                        @csrf
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

                    <div>
                        <img class="w-10 h-10" src="{{ $icon }}" alt="{{ $socialmediaitem->name }}" srcset="">
                        <p class="mt-4 text-lg text-gray-900">{{ $socialmediaitem->name }}</p>
                        <p class="mt-4 text-lg text-gray-900">{{ $socialmediaitem->url }}</p>
                    </div>

                </div>
            </div>

        @endforeach

    </div>
</x-app-layout>
