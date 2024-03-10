<?php

namespace App\Livewire;

use App\Models\Video;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CrearVideo extends Component
{
    use WithFileUploads;
    use WithPagination;

    public bool $modalCrear = false;

    #[Validate(['nullable', 'image', 'max:2048'])]
    public $imagen;

    #[Validate(['required', 'string', 'min:3', 'unique:videos,nombre'])]
    public string $nombre;

    #[Validate(['required', 'string', 'min:10'])]
    public string $descripcion;

    #[Validate(['required', 'decimal:0,2', 'min:1', 'max:59.99'])]
    public float $duracion;


    public function render()
    {
        return view('livewire.crear-video');
    }

    public function store()
    {
        $this->validate();
        $video = Video::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'duracion' => $this->duracion,
            'user_id' => auth()->user()->id
        ]);

        $video->image()->create([
            'url' => ($this->imagen) ? ($this->imagen)->store('imagenes') : 'default.png',
            'descripcion' => $this->nombre // en la descripcion de la imagen voy a guardar el nombre del video
        ]);

        $this->dispatch('mensaje', 'Video Creado');
        $this->dispatch('crearOK')->to(MisVideos::class);
        $this->cerrarModalCrear();
    }


    public function cerrarModalCrear()
    {
        $this->reset(['modalCrear', 'nombre', 'descripcion', 'imagen', 'duracion']);
    }
}
