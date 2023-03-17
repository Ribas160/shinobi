<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Edit country
                </div>
                <div class="p-6 flex items-start justify-around">
                    <div class="w-full sm:w-8/12 md:w-5/12">
                        <x-country-form 
                            :title="__('Edit Country')" 
                            :action="__('country.update')" 
                            :method="__('PATCH')"
                            :buttonText="__('Update')"  
                            :country="$country ?? null" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
