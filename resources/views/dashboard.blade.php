<x-app-layout>
    <x-principal>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!--Home -->
            <a href="{{ route('home') }}"
                class="bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 rounded-lg p-4 flex flex-col justify-center items-center text-white">
                <i class="fas fa-home text-3xl mb-2"></i>
                <span class="text-sm font-medium">Home</span>
            </a>
            <!--Gestión de Posts -->
            <a href="{{ route('posts.index') }}"
                class="bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 rounded-lg p-4 flex flex-col justify-center items-center text-white">
                <i class="fas fa-file-alt text-3xl mb-2"></i>
                <span class="text-sm font-medium">Gestión de Posts</span>
            </a>
            <!--Gestión de Vídeos -->
            <a href="{{ route('videos.index') }}"
                class="bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 rounded-lg p-4 flex flex-col justify-center items-center text-white">
                <i class="fas fa-video text-3xl mb-2"></i>
                <span class="text-sm font-medium">Gestión de Vídeos</span>
            </a>
        </div>
    </x-principal>
</x-app-layout>
