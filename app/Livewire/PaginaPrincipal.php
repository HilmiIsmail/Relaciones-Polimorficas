<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Video;
use Livewire\Component;
use Livewire\WithPagination;

class PaginaPrincipal extends Component
{
    use WithPagination;
    public $busqueda = "";

    public function render()
    {
        $posts = Post::where('nombre', 'like', '%' . $this->busqueda . '%')
            ->orderBy('id', 'desc')
            ->paginate(4);

        $videos = Video::where('nombre', 'like', '%' . $this->busqueda . '%')
            ->orderBy('id', 'desc')
            ->paginate(4);

        return view('livewire.pagina-principal', compact('posts', 'videos'));
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }
}
