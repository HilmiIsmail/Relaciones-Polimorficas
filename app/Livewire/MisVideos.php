<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdateVideo;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MisVideos extends Component
{
    use WithPagination;
    use WithFileUploads;

    public Video $miVideo;

    public UpdateVideo $form;
    public bool $openUpdateModal = false;

    public $busqueda = "";
    public $orden = "desc";
    public $campo = "id";

    public bool $openShowModal = false;

    #[On('crearOK')]
    public function render()
    {
        $videos = Video::where('user_id', auth()->user()->id) //  Solo los videos del usuario autenticado
            ->where(function ($q) {
                $q->where('nombre', 'LIKE', '%' . $this->busqueda . '%')
                    ->orWhere('duracion', 'LIKE', '%' . $this->busqueda . '%');
            })
            ->orderBy($this->campo, $this->orden)
            ->paginate(5);
        return view('livewire.mis-videos', compact('videos'));
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
    public function pedirPermiso(Video $video)
    {
        //dd($video->id);
        $this->authorize('delete', $video);
        $this->dispatch('borrarConfirmadoV', $video->id);
    }

    #[On('borrarOK')]
    public function borrar(Video $video)
    {
        $this->authorize('delete', $video);
        if (basename($video->image->url) != 'default.png') {
            Storage::delete($video->image->url);
        }
        $video->delete();
        $this->dispatch('mensaje', 'Vídeo Borrado');
    }
    /* --------------------------------- UPDATE --------------------------------- */
    public function edit(Video $video)
    {
        $this->authorize('update', $video);
        $this->form->setVideo($video);
        $this->openUpdateModal = true;
    }

    public function update()
    {
        $this->form->updateVideo();
        $this->form->limpiarCamposs();
        $this->dispatch('mensaje', 'Video Actualizado');
    }

    public function cerrarUpdate()
    {
        $this->openUpdateModal = false;
    }
    /* ---------------------------------- SHOW ---------------------------------- */
    public function show(Video $video)
    {
        $this->miVideo = $video;
        $this->openShowModal = true;
    }

    public function cerrarModal()
    {
        $this->openShowModal = false;
    }
}
