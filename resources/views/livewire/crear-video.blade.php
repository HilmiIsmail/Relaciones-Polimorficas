<div>
    <button wire:click="$set('modalCrear',true)"
        class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"><i
            class="fa-solid fa-plus"></i>Nuevo video
    </button>
    <x-dialog-modal wire:model='modalCrear'>
        <x-slot name="title">NUEVO VIDEO</x-slot>
        <x-slot name="content">
            {{-- NOMBRE --}}
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de video</label>
                <input id="nombre" type="text" placeholder="Nombre..." wire:model="nombre"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <x-input-error for="nombre" />
            </div>

            {{-- DESCRIPCION --}}
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripcion video</label>
                <textarea id="descripcion" rows="4" placeholder="Descripcion..." wire:moDel="descripcion"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                <x-input-error for="descripcion" />
            </div>

            {{-- DURACION --}}
            <div class="mb-4">
                <label for="duracion" class="block text-sm font-medium text-gray-700">Duracion de video</label>
                <input id="duracion" type="number" min="1" step="0.1" placeholder="Duración..."
                    wire:model="duracion"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <x-input-error for="duracion" />
            </div>

            {{-- IMAGEN --}}
            <div class="mb-4">
                <label for="imagenC" class="block text-sm font-medium text-gray-700">Imagen del video</label>
                <div class="relative w-full h-96 ">
                    <input type="file" accept="image/*" id="imagenC" hidden wire:model="imagen" />
                    <div class="bg-gray-200 h-full w-full rounded-md flex justify-center items-center">
                        @if ($imagen)
                            <img src="{{ $imagen->temporaryUrl() }}" alt="Imagen del video" class="h-full w-full">
                        @else
                            <span class="text-gray-500">Selecciona una imagen</span>
                        @endif
                    </div>
                    <label for="imagenC"
                        class="absolute bottom-2 right-2 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                        <i class="fa-solid fa-cloud-arrow-up mr-1"></i>Upload</label>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click='store'
                class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                GUARDAR
            </button>
            <button wire:click='cerrarModalCrear'
                class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                CANCELAR
            </button>

        </x-slot>
    </x-dialog-modal>
</div>
