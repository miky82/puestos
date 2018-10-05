<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $fillable = ['nombre', 'distrito_id'];
    protected $primaryKey = 'id_local';

    public function mesa()
    {
        return $this->hasMany(Mesa::class);
    }
    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }
}
