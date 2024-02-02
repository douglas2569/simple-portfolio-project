<x-app-layout>
    <div class="mt-4 max-w-2xl mx-auto sm:p-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('End points') }}
            </h2>

            <p class="mt-1 text-base text-gray-600">
                {{ __("Access your data anywhere with endpoints.") }}
            </p>
        </header>


<div class="bg-white shadow-sm rounded-lg">

    <div class="flex mt-2">
        <div class="flex-1">

             <x-accordion :endpoints="$endpoints"  />

        </div>
    </div>

</div>
</x-app-layout>



