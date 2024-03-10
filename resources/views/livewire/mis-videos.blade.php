<x-principal>
    <div class="flex justify-between items-center mb-4">
        {{-- BÚSQUEDA --}}
        <div class="flex items-center">
            <x-input class="w-72 mr-2" wire:model.live="busqueda" type="search"
                placeholder="Buscar por nombre o duración..." />
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>

        {{-- CREAR LIVEWIRE --}}
        <div>
            @livewire('crear-video')
        </div>
    </div>


    {{-- TABLA DE VIDEOS --}}
    @if ($videos->count())
        <table class="w-full border-collapse text-center ">
            <thead class="text-xs uppercase bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-400">
                <tr>
                    <th class="py-3">Ver Detalle (Controlador)</th>
                    <th class="py-3">Ver Detalle (Modal)</th>
                    <th class="py-3">Preview</th>
                    <th class="py-3 cursor-pointer" wire:click="ordenar('nombre')">
                        <i class="fa-solid fa-sort mr-2"></i>Nombre
                    </th>
                    <th class="py-3 cursor-pointer" wire:click="ordenar('duracion')">
                        <i class="fa-solid fa-sort mr-2"></i>Duración
                    </th>
                    <th class="py-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-sm bg-white divide-y dark:divide-gray-800 dark:bg-gray-900">
                @foreach ($videos as $video)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                        <td class="p-4">
                            {{-- Usando controlador --}}
                            <a href="{{ route('show.video', $video->id) }}">
                                <i class="fa-solid fa-eye text-xl text-orange-400 "></i>
                            </a>
                        </td>
                        <td class="p-4">
                            {{-- Usando modal --}}
                            <button wire:click="show({{ $video->id }})">
                                <i class="fa-solid fa-eye text-xl text-green-500"></i>
                            </button>
                        </td>
                        <td class="p-4">
                            <img class="w-20 h-20 rounded-full" src="{{ Storage::url($video->image->url) }}"
                                alt="{{ $video->nombre }}">
                        </td>
                        <td class="px-6 py-4">{{ $video->nombre }}</td>
                        <td class="px-6 py-4">{{ $video->duracion }}</td>
                        <td class="px-6 py-4">
                            <button wire:click="pedirPermiso({{ $video->id }})">
                                <i class="fa-solid fa-trash text-xl text-red-600"></i>
                            </button>
                            <button wire:click="edit({{ $video->id }})">
                                <i class="fa-solid fa-pen-to-square text-xl text-blue-600"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $videos->links() }}
        </div>
    @else
        <p class="text-xl text-white font-bold bg-slate-500 rounded-lg p-4 text-center">
            ¡¡¡No hay Videos!!!
        </p>
    @endif

    {{-- MODAL DETALLE DE VIDEO --}}
    @isset($miVideo)
        <x-dialog-modal wire:model="openShowModal">
            <x-slot name="title">
                Detalle de Video
            </x-slot>

            <x-slot name="content">
                <div class="p-6">
                    <div class="mb-4 relative">
                        <img src="{{ Storage::url($miVideo->image->url) }}" alt="{{ $miVideo->image->descripcion }}"
                            class="w-full rounded-lg">
                        <i class="fa-solid fa-circle-play absolute top-1/2 left-1/2 text-white text-4xl"></i>
                    </div>
                    <p class="text-4xl font-semibold mb-2">{{ $miVideo->nombre }}</p>
                    <div class="mb-2">
                        <label class="block text-sm font-bold mb-1">Descripción:</label>
                        <p class="text-gray-700">{{ $miVideo->descripcion }}</p>
                    </div>
                    <div class="mb-2">
                        <label class="block text-sm font-bold mb-1">Duración:</label>
                        <p class="text-gray-700">{{ $miVideo->duracion }} min</p>
                    </div>
                    <div class="mb-2">
                        <label class="block text-sm font-bold mb-1">Fecha de creación:</label>
                        <p class="text-gray-700">{{ $miVideo->created_at->toDateTimeString() }}</p>
                    </div>
                    <div class="mb-2">
                        <label class="block text-sm font-bold mb-1">Autor:</label>
                        <p class="text-gray-700">{{ $miVideo->user->name }}</p>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button wire:click="cerrarModal()"
                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Cerrar</button>
            </x-slot>
        </x-dialog-modal>
    @endisset
    {{-- FIN MODAL DETALLE DE VIDEO --}}

    {{-- MODAL UPDATE --}}
    @isset($form->video)
        <x-dialog-modal wire:model='openUpdateModal'>
            <x-slot name="title">NUEVO VIDEO</x-slot>
            <x-slot name="content">
                {{-- NOMBRE --}}
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de video</label>
                    <input id="nombre" type="text" placeholder="Nombre..." wire:model="form.nombre"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    <x-input-error for="form.nombre" />
                </div>

                {{-- DESCRIPCION --}}
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripcion Video</label>
                    <textarea id="descripcion" rows="4" placeholder="Descripcion..." wire:moDel="form.descripcion"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                    <x-input-error for="form.descripcion" />
                </div>

                {{-- DURACION --}}
                <div class="mb-4">
                    <label for="duracion" class="block text-sm font-medium text-gray-700">Duracion de video</label>
                    <input id="duracion" type="number" min="1" step="0.1" placeholder="Duración..."
                        wire:model="form.duracion"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    <x-input-error for="form.duracion" />
                </div>

                {{-- IMAGEN --}}
                <div class="mb-4">
                    <label for="imagenU" class="block text-sm font-medium text-gray-700">Imagen del artículo</label>
                    <div class="relative w-full h-96 ">
                        <input type="file" accept="image/*" id="imagenU" hidden wire:model="form.imagen"
                            wire:loading.attr="disabled" />
                        <div class="bg-gray-200 h-full w-full rounded-md flex justify-center items-center">
                            @if ($form->imagen)
                                <img src="{{ $form->imagen->temporaryUrl() }}" alt="Imagen del artículo"
                                    class="h-full w-full">
                            @else
                                <img src="{{ Storage::url($form->video->image->url) }}" alt="Imagen del artículo"
                                    class="h-full w-full">
                            @endif
                        </div>
                        <label for="imagenU"
                            class="absolute bottom-2 right-2 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                            <i class="fa-solid fa-cloud-arrow-up mr-1"></i>Upload</label>
                    </div>
                </div>
                <x-input-error for="form.imagen" />
            </x-slot>
            <x-slot name="footer">
                <button wire:click='update'
                    class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    GUARDAR
                </button>
                <button wire:click='cerrarUpdate'
                    class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    CANCELAR
                </button>

            </x-slot>
        </x-dialog-modal>
    @endisset
    {{-- FIN MODAL UPDATE --}}
</x-principal>
