<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Marca;
use App\Models\Proveedor;
use Livewire\WithPagination;

class Productos extends Component
{
    use WithPagination;
    public $nombreProducto, $cantidad, $producto, $productoid;
    public $proveedor,$id_proveedors, $SelectProveedor;
    public $marca ,$id_marcas, $SelectMarca;
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
       'nombreProducto' => 'required',
        'cantidad' => 'required',
        'SelectProveedor' => 'required',
        'SelectMarca' => 'required',
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
        producto::create([
            'nombreProducto' => $this->nombreProducto,
            'cantidad' => $this->cantidad,
            'id_proveedors' => $this->SelectProveedor,
            'id_marcas' => $this->SelectMarca
        ]);
        $this->reset(['open_save', 'nombreProducto','cantidad' ,'id_proveedors','id_marcas']);
        $this->emitTo('productos', 'render');
        $this->emit('alert', 'La proveedor se creo Exitosamente');
    }

    public function mount()
    {
        $this->proveedor = Proveedor::all();
        $this->marca = Marca::all();
    }


    //-- busacador

    public function render()
    {
        $productos = Producto::where('nombreProducto',  'like', '%' . $this->search . '%')
        ->orwhere('cantidad','like', '%' . $this->search . '%')
          ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.productos', compact('productos'));
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

    public function edit(Producto $producto)
    {
        $this->producto = $producto;
        $this->productoid = $producto->id;
        $this->nombreProducto = $producto->nombreProducto;
        $this->cantidad = $producto->cantidad;
         $this->SelectProveedor = $producto->id_proveedors;
         $this->SelectMarca = $producto->id_marcas;
        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate();
        //Trayendo el registro y lo guardo una variable = $Proveedor
        $Producto = Producto::find($this->productoid);
        //Actualizao el registro anteorimente recibido


        if ($update = Producto::where('id', $this->productoid)->first()) {
            $update->nombreProducto = $this->nombreProducto;
            $update->cantidad = $this->cantidad;
             $update->id_proveedors = $this->SelectProveedor;

            $update->save();
        }
        $this->reset(['open_edit']);
        $this->emit('alert', 'el producto  se actualizo  exitosamente');
    }

    //--eliminar

    public function delete(Producto $producto)
    {
        $producto->delete();
    }
}
