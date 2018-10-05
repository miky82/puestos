<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votacion extends Model
{
    protected $fillable = ['cant_votos'];
    protected $primaryKey = 'id_votacion';

    public function candidato()
    {
        return $this->hasMany(Candidato::class);
    }
    public function mesa()
    {
        return $this->hasMany(Mesa::class);
    }
    public function puesto()
    {
        return $this->hasMany(Puesto::class);
    }
}
