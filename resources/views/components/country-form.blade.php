@props([
    'title', 
    'action', 
    'method',
    'buttonText' => 'Save', 
    'country' => null,
])

<form method="POST" action="{{ route($action, $country ? $country->id : '') }}" class="border border-gray-300 sm:rounded-md w-full">
    @csrf
    @method($method)
    <div class="bg-gray-100 p-3 px-5 border-b border-gray-300">
        {{ $title }}
    </div>
    <!-- Country name -->
    <div class="px-5 mt-5">
        <x-label for="name" :value="__('Name')" />
    
        <x-input 
            id="name" 
            class="block mt-1 w-full" 
            type="text" 
            name="name" 
            :value="$country ? $country->name : ''" 
            autofocus />
        @error('name')
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <!-- Country ISO code -->
    <div class="px-5 mt-5">
        <x-label for="iso" :value="__('ISO')" />

        <x-input 
            id="iso" 
            class="block mt-1 w-full"
            type="text"
            :value="$country ? $country->iso : ''"
            name="iso" />
        @error('iso')
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4 bg-gray-100 p-3 px-5 border-t border-gray-300">
        <x-button class="ml-3">
            {{ $buttonText }}
        </x-button>
    </div>
</form>