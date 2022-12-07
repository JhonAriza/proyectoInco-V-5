<?php

namespace App\Http\Livewire\shared;
use App\Models\Tag;
use Livewire\Component;

class Tags extends Component
{
    public $show = false;
    public $name_tag;
    public $categoria_id;
    public $tags;
    protected $rules = [
        'name_tag' =>'required|min:3|max:20'     
    ];
    protected $messages = [
        'name_tag.required' => 'el nombre de la etiqueta es  obligatorio.',
        'name_tag.min' => 'la etiqueta debe tener mas de 3 caracteres.',
        'name_tag.max' => 'maximo 20 caracteres.',

    ];
    //-- usamos el modelo para traer todos los registros
    public function render()
    {
        $tag = Tag::where('categoria_id',$this->categoria_id)->get();
        return view('livewire.shared.tags',compact("tag"));
    }
     //-- guardar
     public function save()
     {          
       $this->validate();
       $new = new Tag();
       $new->categoria_id = $this->categoria_id;
       $new->name_tag = $this->name_tag;
       $new->save();
       $this->reset(['name_tag','show']);
     }
//--eliminar
public function delete(Tag $id)
{
    $id->delete();
}
}