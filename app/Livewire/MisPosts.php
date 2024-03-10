<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdatePost;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MisPosts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public Post $miPost;

    public UpdatePost $form;
    public bool $openUpdateModal = false;

    public $busqueda = "";
    public $orden = "desc";
    public $campo = "id";

    public bool $openShowModal = false;

    #[On('crearOK')]
    public function render()
    {
        $posts = Post::where('user_id', auth()->user()->id) //  Solo los posts del usuario autenticado
            ->where(function ($q) {
                $q->where('nombre', 'LIKE', '%' . $this->busqueda . '%')
                    ->orWhere('duracion', 'LIKE', '%' . $this->busqueda . '%');
            })
            ->orderBy($this->campo, $this->orden)
            ->paginate(5);
        return view('livewire.mis-posts', compact('posts'));
    }
    /* --------------------------------- BUSCAR --------------------------------- */
    public function updatingBusqueda() //actualizar la pagina cada vez que cambia el valor de busqueda
    {
        $this->resetPage();
    }
    /* --------------------------------- ORDENAR -------------------------------- */
    public function ordenar($ordCampo)
    {
        $this->orden = ($this->orden == "desc") ? "asc" : "desc";
        $this->campo = $ordCampo;
    }
    /* --------------------------------- BORRAR --------------------------------- */
    public function pedirPermiso(Post $post)
    {
        $this->authorize('delete', $post);
        $this->dispatch('borrarConfirmadoP', $post->id);
    }

    #[On('borrarOK')]
    public function borrar(Post $post)
    {
        $this->authorize('delete', $post);
        if (basename($post->image->url) != 'default.png') {
            Storage::delete($post->image->url);
        }
        $post->delete();
        $this->dispatch('mensaje', 'Post Borrado');
    }
    /* --------------------------------- UPDATE --------------------------------- */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $this->form->setPost($post);
        $this->openUpdateModal = true;
    }

    public function update()
    {
        $this->form->updatePost();
        $this->form->limpiarCampos();
        $this->dispatch('mensaje', 'Post Actualizado');
    }

    public function cerrarUpdate()
    {
        $this->openUpdateModal = false;
    }
    /* ---------------------------------- SHOW ---------------------------------- */
    public function show(Post $post)
    {
        $this->miPost = $post;
        $this->openShowModal = true;
    }

    public function cerrarModal()
    {
        $this->openShowModal = false;
    }
}
