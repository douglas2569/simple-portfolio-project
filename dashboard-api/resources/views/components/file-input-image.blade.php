@props(['disabled' => false, 'rounded', 'imagePath'])
<div class="flex items-center">

    @if($imagePath)
        <div class="shrink-0">
            @if($rounded == 'full')
                <img
                    class="h-16 w-16 object-cover rounded-full"
                    src="{{asset('storage/images/'.$imagePath)}}"
                />
            @else
                <img
                    class="h-16 object-cover rounded-sm"
                    src="{{asset('storage/images/'.$imagePath)}}"
                    />
            @endif
        </div>
    @endif

    <input
    {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => 'block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-violet-50 file:text-violet-700
                            hover:file:bg-violet-100']) !!}

    />
</div>





