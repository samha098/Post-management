<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('POST') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <h1 style="font-size: 36px; font-weight: bold; center; text-align: center;">{{ $post->title }}
                        </h1>
                        <h4 class="center">CATEGORY:@foreach($post->categories as $category)
                            {{ $category->name }},
                            @endforeach
                        </h4>
                        <div class=" bg-white shadow-sm rounded-lg p-6">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                class="w-full h-40 object-cover mb-2">




                            <p class="text-gray-700">{{ $post->description, 100}}</p>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>