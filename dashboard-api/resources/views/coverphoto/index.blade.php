<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
         @if(count($about) > 0)
            <form method="POST" action="{{ route('coverphoto.store') }}" enctype="multipart/form-data">
                <label class="block" for="">
                <span class="sr-only">Choose cover photo</span>
                @csrf
                <input
                    name="image"
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
                <select name="size" id="photo-size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Qual o tamanho da imagem?</option>
                    <option value="sm">Pequena</option>
                    <option value="md">Média</option>
                </select>


                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                <x-input-error :messages="$errors->get('size')" class="mt-2" />
                <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
            </form>
        @else
            {{ $message['content'] }}
        @endif

        @if(count($coverphotos) <= 0)
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
                                        @csrf
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
                        $size =  ($coverphoto->size == "sm")? "Pequena":"Média";
                    @endphp

                    <div>
                        <img src="{{ $image }}" alt="{{ $coverphoto->name }}" srcset="">
                        <p class="mt-4 text-lg text-gray-900">{{ $size }}</p>
                        <p class="mt-4 text-lg text-gray-900">{{ $coverphoto->name }}</p>
                    </div>

                </div>
            </div>

        @endforeach

    </div>
</x-app-layout>
