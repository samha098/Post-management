<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">  
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach ($posts as $post)
                                <div class="row">
                                    <div class="bg-white shadow-sm rounded-lg p-6">
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                            class="w-full h-40 object-cover mb-2">
                                        <h2 class="text-lg font-medium text-gray-900">{{ $post->title }}</h2>
                                        <p class="text-gray-700">{{ Str::limit($post->description, 100) }}</p>
                                        <a href="{{ route('posts.show', $post) }}"
                                            class="text-blue-500 hover:underline">Read
                                            More</a>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

</x-app-layout>