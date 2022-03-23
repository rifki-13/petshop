<label for="{{ $name }}" class="{{ $showLabel ? 'text-white-900' : 'hidden' }}">{{ $label }}</label>
<select name="{{ $name }}" id="{{ $name }}"
    class="w-100 mt-2 py-3 px-6 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
    @foreach ($options as $key => $label)
        <option value="{{ $key }}" @isset($value)
            @if ($value === $key)
                selected
            @endif
        @endisset>{{ $label }}
        </option>
    @endforeach

</select>
@error($name)
    <p class="text-red-900">{{ $message }}</p>
@enderror
