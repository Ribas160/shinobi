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
                    You're logged in!
                </div>
                <div class="p-6 flex flex-col-reverse lg:flex-row items-start justify-around">
                    <div class="w-full sm:w-8/12 md:w-5/12 mt-5 lg:m-0">
                        <x-country-form 
                            :title="__('Add New Country')" 
                            :action="__('country.store')" 
                            :method="__('POST')" />
                    </div>
                    <div class="w-full lg:ml-5">
                        <x-list-of-countries :countries="$countries" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
