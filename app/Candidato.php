<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $fillable = ['nombre', 'representante', 'imagen','tipo_candidato', 'orden'];
    protected $primaryKey = 'id_candidato';

    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }
}
