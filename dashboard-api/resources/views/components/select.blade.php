@props(['options', 'message', 'conditionSelect'=>'nothing'])
<select
    {!! $attributes->merge(['class' => 'bg-violet-50  border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-violet-700 focus:border-violet-700  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-violet-50  dark:text-white dark:focus:ring-violet-700  dark:focus:border-blue-500']) !!}>
        <option>{{$message}}</option>
        @foreach($options as $option)
            <option
                {{ $conditionSelect == $option['value']?'selected':'' }}
                value="{{$option['value']}}">{{$option['name']}}</option>
        @endforeach
</select>
