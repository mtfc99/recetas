<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{

    //Campos que se agregarán
    protected $fillable = [
        'titulo', 'ingredientes', 'preparacion', 'imagen', 'categoria_id'
    ];


    //Obtener la categoría de la receta via FK
    public function categoria(){
        return $this->belongsTo(CategoriaReceta::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
