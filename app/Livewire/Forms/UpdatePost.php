<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UpdatePost extends Form
{
    use WithFileUploads;
    use WithPagination;

    public ?Post $post = null;
    public $imagen;
    public string $nombre = "";
    public string $descripcion = "";

    public function setPost(Post $miPost)
    {
        $this->post = $miPost;
        $this->nombre = $miPost->nombre;
        $this->descripcion = $miPost->descripcion;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:3', 'unique:posts,nombre,' . $this->post->id],
            'descripcion' => ['required', 'string', 'min:10'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function updatePost()
    {
        // Si subimos una otra imagen, la actualizamos y borramos la iagen anterior si no es default
        if ($this->imagen) {
            if (basename($this->post->image->url) != 'default.png') {
                Storage::delete($this->post->image->url);
            }

            // Actualizar la imagen del post de la relación polimórfica
            $this->post->image()->update([
                'url' => $this->imagen->store('imagenes'),
                'descripcion' => $this->descripcion, //en la descripcion guardamos el nombre del post simplemente
            ]);
        }

        //Actualizamos el post
        $this->post->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);
    }
    public function limpiarCampos()
    {
        $this->reset(['post', 'imagen', 'nombre', 'descripcion']);
    }
}
