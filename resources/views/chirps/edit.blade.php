<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="#">
                        @csrf
                        <textarea
                            name="message"
                            class="block w-full rounded-md border-gray-300 @error('message') border-red @enderror bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50" placeholder="{{__('What\'s on your maind?')}}">{{ old('message', $chirp->message) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('message')" />
                        <x-primary-button class="mt-4">{{__('Chirp')}}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
