@props(['disabled' => false, 'rounded', 'imagePath', 'height', 'width'])
<div class="flex items-center gap-4">

    @if($imagePath)
        <div class="shrink-0">
            <img
                class="{{$height}} {{$width}} object-cover rounded-{{$rounded}}"
                src="{{asset('storage/images/'.$imagePath)}}"
            />

        </div>
    @endif

    <input
    {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => 'block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-violet-50 file:text-violet-700
                            hover:file:bg-violet-100']) !!}

    />
</div>





