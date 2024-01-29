<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
         <form method="POST" action="{{ route('socialmedia.update', $socialmedia) }}" enctype="multipart/form-data">
            @method('patch')

                <div class="flex items-center space-x-6">
                    @if($socialmedia->icon)
                            <div class="shrink-0">
                                <img
                                    class="w-10 h-10 object-cover rounded-md"
                                    src="{{asset('storage/images/'.$socialmedia->icon)}}" />
                            </div>
                    @endif

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
                </div>

            @csrf
            <input
                name="name"
                placeholder="{{ __('Name') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{$socialmedia->name}}"
            />

            @csrf
            <input
                name="url"
                placeholder="{{ __('URL') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{$socialmedia->name}}"
            />

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
