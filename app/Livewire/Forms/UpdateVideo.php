<?php

namespace App\Livewire\Forms;

use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UpdateVideo extends Form
{
    use WithFileUploads;
    use WithPagination;

    public ?Video $video = null;
    public $imagen;
    public string $nombre = "";
    public string $descripcion = "";
    public float $duracion = 0.0;

    public function setVideo(Video $miVideo)
    {
        $this->video = $miVideo;
        $this->nombre = $miVideo->nombre;
        $this->descripcion = $miVideo->descripcion;
        $this->duracion = $miVideo->duracion;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:3', 'unique:videos,nombre,' . $this->video->id],
            'descripcion' => ['required', 'string', 'min:10'],
            'duracion' => ['required', 'decimal:0,2', 'min:1', 'max:59.99'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function updateVideo()
    {
        // Si subimos una otra imagen, la actualizamos y borramos la iagen anterior si no es default
        if ($this->imagen) {
            if (basename($this->video->image->url) != 'default.png') {
                Storage::delete($this->video->image->url);
            }

            // Actualizar la imagen del video de la relación polimórfica
            $this->video->image()->update([
                'url' => $this->imagen->store('imagenes'),
                'descripcion' => $this->descripcion, //en la descripcion guardamos el nombre del video simplemente
            ]);
        }

        //Actualizamos el video
        $this->video->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'duracion' => $this->duracion,
        ]);
    }
    public function limpiarCamposs()
    {
        $this->reset(['video', 'imagen', 'descripcion', 'nombre', 'duracion']);
    }
}
