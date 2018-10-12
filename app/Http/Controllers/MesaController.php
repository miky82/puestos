<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Yajra\Datatables;
use App\Mesa;
use App\Local;

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
                return '<a href="votacion/mostrar/'.$mesa->id_mesa.'/1" class="btn btn-primary btn-xs" role="button" aria-pressed="true">Distrital</a>
                    <a href="votacion/mostrar/'.$mesa->id_mesa.'/2" class="btn btn-primary btn-xs" role="button" aria-pressed="true">Provincial</a>';
            })
            ->make(true);
    }
    public function create()
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        
        $locales = Local::all();

        return view ('mesa.create')->with(compact('locales'));
    }
}
