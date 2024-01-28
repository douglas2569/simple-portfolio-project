<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
         <form method="POST" action="{{ route('coverphoto.update', $coverPhoto) }}" enctype="multipart/form-data">
            @method('patch')

                <div class="flex items-center space-x-6">
                    @if($coverPhoto->image)
                            <div class="shrink-0">
                                <img
                                    class="h-16 w-16 object-cover rounded-full"
                                    src="{{asset('storage/images/'.$coverPhoto->image)}}" />
                            </div>
                    @endif

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
                </div>

            @csrf
            <input
                name="name"
                placeholder="{{ __('Nome') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{$coverPhoto->name}}"
            />


            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
            <x-input-error :messages="$errors->get('size')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
        </form>

    </div>
</x-app-layout>
