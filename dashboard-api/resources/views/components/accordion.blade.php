
@props(['endpoints'])

<div id="accordion-collapse" data-accordion="collapse" class="w-[600px] text-sm">
    @foreach($endpoints as $endpoint)
    <div class="mt-4" x-data="{ hidden: false }" >
        <h3 class="font-medium text-sm text-gray-700 mb-2">{{$endpoint['name']}}</h3>
        <div id="accordion-collapse-heading-1"  class="bg-violet-50 cursor-pointer flex items-baseline justify-between w-full p-5 font-medium rtl:text-right text-gray-900 border border-b-0 border-gray-100 rounded-t-xl focus:ring-4 focus:ring-violet-200 dark:focus:ring-violet-800 dark:border-gray-700 dark:text-gray-400 hover:bg-violet-200 dark:hover:bg-violet-800 gap-3">

        <x-clipboard  :text="$endpoint['endpoint']" />

        <div x-on:click="hidden = ! hidden"  class="flex items-center grow justify-between gap-4">
            <div>{{$endpoint['endpoint']}}</div>
            <svg  data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
        </div>

        </div>
        <div id="accordion-collapse-body-1" x-show="hidden" aria-labelledby="accordion-collapse-heading-1" >
            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900" >
                <div x-data="{{$endpoint['data']}}" >
                    <p class="whitespace-pre-wrap " x-text="JSON.stringify(data, null, 4)"></p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

