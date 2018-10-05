<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Yajra\Datatables;
use App\Mesa;

class MesaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        /*$mesas = Mesa::select(['id_mesa','numero','total_electores','local_id'])->get();
        return view('mesa.index', ['mesas' => $mesas]);*/
        return view('mesa.index');
    }
    public function lista()
    {
        $mesa = Mesa::query();
        return Datatables\Datatables::of($mesa)
            ->addColumn('local_name', function($row){
                return $row->local->nombre;
            })->addColumn('mostrar_votos', function($mesa){
                return '<a href="votacion/mostrar/'.$mesa->id_mesa.'" class="btn btn-primary" role="button" aria-pressed="true">Ver votos</a>';
            })
            ->make(true);
    }
}
