<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($posts as $post)
                        <div class="bg-white shadow-sm rounded-lg p-6 flex justify-between">
                            <div>
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                    class="w-full h-40 object-cover mb-2">
                                <h2 class="text-lg font-medium text-gray-900">{{ $post->title }}</h2>
                                <p class="text-gray-700">{{ Str::limit($post->description, 100) }}</p>
                            </div>
                            <div class="flex items-center">
                                @if(auth()->user()->hasPermission('update'))
                                <a href="{{ route('posts.edit', $post) }}"
                                    class="text-blue-500 hover:underline mr-2">Edit</a>
                                @endif
                                @if(auth()->user()->hasPermission('delete'))
                                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                                @endif

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>