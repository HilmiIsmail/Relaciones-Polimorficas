<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CrearPost extends Component
{
    use WithFileUploads;
    use WithPagination;

    public bool $modalCrear = false;

    #[Validate(['nullable', 'image', 'max:2048'])]
    public $imagen;

    #[Validate(['required', 'string', 'min:3', 'unique:posts,nombre'])]
    public string $nombre;

    #[Validate(['required', 'string', 'min:10'])]
    public string $descripcion;



    public function render()
    {
        return view('livewire.crear-post');
    }

    public function store()
    {
        $this->validate();
        $post = Post::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'user_id' => auth()->user()->id
        ]);

        $post->image()->create([
            'url' => ($this->imagen) ? ($this->imagen)->store('imagenes') : 'default.png',
            'descripcion' => $this->nombre // en la descripcion de la imagen voy a guardar el nombre del post
        ]);

        $this->dispatch('mensaje', 'Post Creado');
        $this->dispatch('crearOK')->to(MisPosts::class);
        $this->cerrarModalCrear();
    }


    public function cerrarModalCrear()
    {
        $this->reset(['modalCrear', 'nombre', 'descripcion', 'imagen']);
    }
}
