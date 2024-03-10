    <x-principal>
        <div class="mb-4 flex justify-center items-center">
            <x-input class="w-96" wire:model.live='busqueda' type='search' placeholder='Buscar por nombre...' />
            <i class="fa-solid fa-magnifying-glass ml-2"></i>
        </div>
        @if ($posts->count() || $videos->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <a href={{ route('show.post', $post->id) }}>
                            <div class="w-full h-72 bg-cover bg-no-repeat rounded-t-lg relative"
                                style="background-image: url({{ Storage::url($post->image->url) }})">
                            </div>
                        </a>

                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-900">{{ $post->nombre }}</h3>
                            <p class="text-gray-400 text-sm">{{ $post->user->email }}</p>
                            <p class="text-gray-400 text-sm">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach

                @foreach ($videos as $video)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="w-full h-72 bg-cover bg-no-repeat rounded-t-lg relative"
                            style="background-image: url({{ Storage::url($video->image->url) }})">
                            <a href="{{ route('show.video', $video->id) }}">
                                <!-- Aquí hay un error, debería ser $video->id -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <i class="far fa-play-circle text-white text-4xl"></i>
                                </div>
                            </a>
                            <span
                                class="absolute bottom-2 right-2 bg-gray-700 text-white px-2 py-1 rounded">{{ $video->duracion }}
                                min</span>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-900">{{ $video->nombre }}</h3>
                            <p class="text-gray-400 text-sm">{{ $video->user->email }}</p>
                            <p class="text-gray-400 text-sm">{{ $video->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- Pagination links -->
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-xl text-white font-bold bg-slate-500 rounded-lg p-4 text-center">
                ¡¡¡No hay publicaciones!!!
            </p>
        @endif
    </x-principal>
