<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use \Spatie\Permission\Models\Role;
class Users extends Component
{
    use WithPagination;
    public $name ,$email, $user,$userid;
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
       'name' => 'required',
        'email' => 'required',
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
        //$this->validate();
        user::create([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        $this->reset(['open_save', 'name','email']);
        $this->emitTo('users', 'render');
        $this->emit('alert', 'La proveedor se creo Exitosamente');
    }


    //-- busacador

    public function render()
    {
        $users = User::where('name',  'like', '%' . $this->search . '%')
        ->orwhere('email','like', '%' . $this->search . '%')
          ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.users', compact('users'));
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

    public function edit(User $user)
    {
        $roles = Role::all();
        $this->user = $user;
        $this->userid = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->open_edit = true;
    }

    public function update()
    {
                    //  $this->validate();
        //Trayendo el registro y lo guardo una variable = $Proveedor
        $User = User::find($this->userid);
        //Actualizao el registro anteorimente recibido


        if ($update = User::where('id', $this->userid)->first()) {
            $update->name = $this->name;
            $update->email = $this->email;
            $update->save();
        }
        $this->reset(['open_edit']);
        $this->emit('alert', 'el users  se actualizo  exitosamente');
    }

    //--eliminar

    public function delete(User $user)
    {
        $user->delete();
    }
}
