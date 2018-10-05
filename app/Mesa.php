<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    // El framework le aumenta la S para buscar el nombre de la tabla
    protected $fillable = ['numero', 'total_electores', 'local_id'];
    protected $primaryKey = 'id_mesa';

    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function candidato()
    {
        return $this->hasMany(Candidato::class);
    }
}
