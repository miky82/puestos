<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Votacion;
use App\Candidato;

class VotacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*public function index()
    {
        return view('votacion.index');
    }*/
    public function mostrar($id_mesa)
    {
        if(!$id_mesa){return false;}
        $candidatos = Candidato::leftJoin('votacions','votacions.id_votacion', '=', 'candidatos.id_candidato')
            //->join('mesas', 'mesas.id_mesa', '=', 'votacions.mesa_id')
            ->leftJoin('puestos', 'puestos.id_puesto', '=', 'votacions.puesto_id')
            ->where('mesa_id', $id_mesa)
            ->select('candidatos.*', 'votacions.cant_votos', 'candidatos.imagen','candidatos.orden','candidatos.tipo_candidato')
            ->orderBy('candidatos.tipo_candidato', 'asc')
            ->orderBy('candidatos.orden', 'asc')
            ->get();
        ;

        /*$candidatos = Votacion::join('mesas', 'mesas.id_mesa', '=', 'votacions.mesa_id')
            ->join('candidatos', 'candidatos.id_candidato', '=', 'votacions.candidato_id')
            ->where('mesa_id', $id_mesa)
            ->select('votacions.*', 'candidatos.nombre', 'candidatos.imagen','candidatos.orden','candidatos.tipo_candidato')
            ->orderBy('candidatos.tipo_candidato', 'asc')
            ->orderBy('candidatos.orden', 'asc')
            ->get();*/

        /*$votos = Votacion::where('mesa_id', '=', $id_mesa)
            ->take(10)->get();
        $votos->mesa();*/

        return \View::make('votacion.index',compact('candidatos'));

    }
}
