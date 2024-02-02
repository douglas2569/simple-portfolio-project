
@props(['endpoints'])

<div id="accordion-collapse" data-accordion="collapse" class="w-[600px] text-sm">
    @foreach($endpoints as $endpoint)
    <div class="mt-4">
        <h2 id="accordion-collapse-heading-1">
            <span type="button" class="bg-gray-50 cursor-pointer flex items-baseline justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-100 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                <div class="flex items-center gap-4">
                    <x-clipboard  :text="$endpoint['endpoint']" />
                    <span>{{$endpoint['endpoint']}}</span>
                </div>
                <svg  data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </span>
        </h2>
        <div id="accordion-collapse-body-1" class="" aria-labelledby="accordion-collapse-heading-1">
            <div class="p-5 border border-b-0 hidden border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                <div x-data="{{$endpoint['data']}}" >
                    <p class="whitespace-pre-wrap " x-text="JSON.stringify(data, null, 4)"></p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

