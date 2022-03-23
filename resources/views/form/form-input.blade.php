<label for="{{ $name }}" class="{{ $showLabel ? 'text-white-900' : 'hidden' }}">{{ $label }}</label>
<input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
    placeholder="{{ $placeholder ?? '' }}" value="{{ $value }}"
    class="w-100 mt-2 py-3 px-6 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
@error($name)
    <p class="text-red-900">{{ $message }}</p>
@enderror
