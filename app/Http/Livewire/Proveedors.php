<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proveedor;
use App\Models\Categoria;
use Livewire\WithPagination;

class Proveedors extends Component
{
    use WithPagination;
    public $nombre, $nit, $telefono, $proveedor, $proveedorid;
    public $category,$id_categorias, $SelectCategory;
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
       'nombre' => 'required',
        'nit' => 'required',
        'telefono' => 'required',
        'SelectCategory' => 'required',
    ];

    //-- guardar
    public function save()
    {
    //    $this->validate(); no funciona la validacion de campos
        $this->open_save = true;

    }
    public function create()
    {
        $this->validate();
        proveedor::create([
            'nombre' => $this->nombre,
            'nit' => $this->nit,
            'telefono' => $this->telefono,
            'id_categorias' => $this->SelectCategory
        ]);
        $this->reset(['open_save', 'nombre','nit','telefono', 'id_categorias']);
        $this->emitTo('proveedors', 'render');
        $this->emit('alert', 'La proveedor se creo Exitosamente');
    }

    public function mount()
    {
        $this->category = Categoria::all();

    }


    //-- busacador

    public function render()
    {
        $proveedors = Proveedor::where('nombre', 'like', '%' . $this->search . '%')
        ->orwhere('nit','like', '%' . $this->search . '%')
        ->orwhere('telefono','like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.proveedors', compact('proveedors'));
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

    public function edit(Proveedor $proveedor)
    {
        $this->proveedor = $proveedor;
        $this->proveedorid = $proveedor->id;
        $this->nombre = $proveedor->nombre;
        $this->nit = $proveedor->nit;
        $this->telefono = $proveedor->telefono;
        $this->SelectCategory = $proveedor->id_categorias;
        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate();
        //Trayedon el registro y lo guardo una variable = $Proveedor
        $Proveedor = Proveedor::find($this->proveedorid);
        //Actualizao el registro anteorimente recibido


        if ($update = Proveedor::where('id', $this->proveedorid)->first()) {
            $update->nombre = $this->nombre;
            $update->nit = $this->nit;
            $update->telefono = $this->telefono;
            $update->id_categorias = $this->SelectCategory;

            $update->save();
        }
        $this->reset(['open_edit']);
        $this->emit('alert', 'el proveedor se actialiso exitosamente');
    }

    //--eliminar

    public function delete(Proveedor $proveedor)
    {
        $proveedor->delete();
    }
}
