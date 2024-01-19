<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        @php
            $about = auth()->user()->about()->get();
        @endphp

        @if(count($about) > 0)
            <livewire:about.edit />
        @else
            <livewire:about.create />
        @endif

    </div>
</x-app-layout>
