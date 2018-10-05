<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $fillable = ['nombre', 'provincia_id'];
    protected $primaryKey = 'id_distrito';

    public function local()
    {
        return $this->hasMany(Local::class);
    }
    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }
}
