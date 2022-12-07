<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Programa;
use Livewire\WithPagination;

class Programas extends Component
{
    use WithPagination;
    public $nombreprograma, $programa;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '20';
    public $open_save = false;
    public $open_edit = false;
    protected $listeners = ['render', 'delete'];
    protected $queryString = [
        'cant' => ['except' => '20'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];
    protected $rules = [
        'programa.nombreprograma' => 'required'
    ];

    //-- guardar
    public function save(Programa $nombreprograma)
    {
        $this->programa = $nombreprograma;
        $this->open_save = true;
    }
    public function create()
    {
        programa::create([
            'nombreprograma' => $this->nombreprograma
        ]);
        $this->reset(['open_save', 'nombreprograma']);
        $this->emitTo('programas', 'render');
        $this->emit('alert', 'La programa se creo Exitosamente');
    }



    //-- busacador

    public function render()
    {
        $programas = Programa::where('nombreprograma', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.programas', compact('programas'));
    }








    public function order($sort)
    {

        if ($this->sort == $sort) {

            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //--modificar

    public function edit(Programa $programa)
    {
        $this->programa = $programa;
        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate();
        $this->programa->save();
        $this->reset(['open_edit']);
        $this->emit('alert', 'el programa se actialiso exitosamente');
    }

    //--eliminar

    public function delete(Programa $programa)
    {
        $programa->delete();
    }
}
