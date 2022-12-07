<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Jornada;
use Livewire\WithPagination;


class Horarios extends Component
{
    use WithPagination;
    public $tipojornada, $jornada;
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
        'jornada.tipojornada' => 'required'
    ];

    //-- guardar
    public function save()
    {
        $this->open_save = true;
    }
    public function create()
    {
        jornada::create([
            'tipojornada' => $this->tipojornada
        ]);
        $this->reset(['open_save', 'tipojornada']);
        $this->emitTo('horarios', 'render');
        $this->emit('alert', 'La jornada se creo Exitosamente');
    }



    //-- busacador

    public function render()
    {
        $jornadas = Jornada::where('tipojornada', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.horarios', compact('jornadas'));
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

    public function edit(Jornada $jornada)
    {
        $this->jornada = $jornada;
        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate();
        $this->jornada->save();
        $this->reset(['open_edit']);
        $this->emit('alert', 'la jornada se actialiso exitosamente');
    }

    //--eliminar

    public function delete(Jornada $jornada)
    {
        $jornada->delete();
    }
}
