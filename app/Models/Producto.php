<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proveedor;
use App\Models\Marca;

class Producto extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function proveedor()
    {
        return $this->belongsTo(proveedor::class, 'id_proveedors');
    }
    public function marca()
    {
        return $this->belongsTo(marca::class, 'id_marcas');
    }
}
