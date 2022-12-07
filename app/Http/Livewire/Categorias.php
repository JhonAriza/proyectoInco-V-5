<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithPagination;

class Categorias extends Component
{
    use WithPagination;
    public $nombreCategoria, $categoria, $categoria_id;
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
        'categoria.nombreCategoria' => 'required'
    ];

    // Ejecutar Modal
    public function modal()
    {
        $this->open_save = true;
    }

    public function mount()
    {

    }

    //Crear el registro
    public function create()
    {
        //Validaciones

        //Crear el registro
        categoria::create([
            'nombreCategoria' => $this->nombreCategoria
        ]);

        //Rectear las variables
        $this->reset(['open_save', 'nombreCategoria']);

        //Enviando la alerta para registro creado
        $this->emit('alert', 'La categoria se creo Exitosamente');
    }

    //Vistar principal
    public function render()
    {

        $categorias = Categoria::where('nombrecategoria', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.categorias', compact('categorias'));
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


    public function edit(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->categoria_id = $categoria->id;
        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate();
        $this->categoria->save();
        //Rectear las variables
        $this->reset(['open_save', 'nombreCategoria']);

        $this->emit('alert', ' ls categoria se actualizo exitosamente');
    }

    //--eliminar

    public function delete(Categoria $categoria)
    {
        $categoria->delete();
    }
}

