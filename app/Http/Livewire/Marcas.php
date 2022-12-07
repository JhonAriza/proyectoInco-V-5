<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Marca;
use Livewire\WithPagination;

class Marcas extends Component
{
    use WithPagination;
    public $nombreMarca, $marca, $marcaid;
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
        'marca.nombreMarca' => 'required'
    ];

    // Ejecutar Modal
    public function modal()
    {
        $this->open_save = true;
    }



    //Crear el registro
    public function create()
    {
        //Validaciones

        //Crear el registro
        marca::create([
            'nombreMarca' => $this->nombreMarca]);

        //Rectear las variables
        $this->reset(['open_save', 'nombreMarca']);

        //Enviando la alerta para registro creado
        $this->emit('alert', 'La Marca se creo Exitosamente');
    }

    //Vistar principal
    public function render()
    {

        $marcas = Marca::where('nombreMarca', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.marcas', compact('marcas'));
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

    //
    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function edit(Marca $marca)
    {
        $this->marca = $marca;
        $this->marcaid = $marca->id;
        $this->open_edit = true;
    }

    public function update()
    {

        $this->marca->save();
        //Rectear las variables
        $this->reset(['open_save', 'nombreMarca']);

        $this->emit('alert', ' ls Marcase actualizo exitosamente');
    }

    //--eliminar

    public function delete(Marca $marca)
    {
        $marca->delete();
    }
}

