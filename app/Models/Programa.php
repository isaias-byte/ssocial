<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;
    //! Esto usamos con el metodo create en vez de save para guardar los datos en la BD
    protected $fillable = ['calendario', 'folio', 'nombre', 'dependencia', 'titular', 'user_id'];

    //! Se usa para hacer lo de la relación uno a muchos
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function prestadores() {
        return $this->belongsToMany(Prestador::class);
    }
}
