<x-app-layout>
    <x-principal>
        @isset($post)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <img src="{{ Storage::url($post->image->url) }}" alt="{{ $post->image->descripcion }}"
                        class="w-full rounded-lg">
                </div>
                <div class="mb-4">
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <p class="text-4xl font-semibold mb-2">{{ $post->nombre }}</p>
                        <div class="mb-2">
                            <label class="block text-sm font-bold mb-1">Descripción:</label>
                            <p class="text-gray-700">{{ $post->descripcion }}</p>
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-bold mb-1">Fecha de creación:</label>
                            <p class="text-gray-700">{{ $post->created_at->toDateTimeString() }}</p>
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-bold mb-1">Autor:</label>
                            <p class="text-gray-700">{{ $post->user->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

        @isset($video)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4 relative">
                    <img src="{{ Storage::url($video->image->url) }}" alt="{{ $video->image->descripcion }}"
                        class="w-full rounded-lg">
                    <i class="fa-solid fa-circle-play absolute top-1/2 left-1/2 text-white text-4xl"></i>
                </div>

                <div class="mb-4">
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <p class="text-4xl font-semibold mb-2">{{ $video->nombre }}</p>
                        <div class="mb-2">
                            <label class="block text-sm font-bold mb-1">Descripción:</label>
                            <p class="text-gray-700">{{ $video->descripcion }}</p>
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-bold mb-1">Duración:</label>
                            <p class="text-gray-700">{{ $video->duracion }} min</p>
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-bold mb-1">Fecha de creación:</label>
                            <p class="text-gray-700">{{ $video->created_at->toDateTimeString() }}</p>
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-bold mb-1">Autor:</label>
                            <p class="text-gray-700">{{ $video->user->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </x-principal>
</x-app-layout>
