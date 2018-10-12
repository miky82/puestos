<?php

namespace App\Http\Controllers;

use App\Puesto;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Mesa;
use App\Candidato;
use App\Votacion;
use Symfony\Component\Console\Input\Input;

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
    public function mostrar($id_mesa,$id_puesto)
    {
        if(!$id_mesa){return false;}

        $candidatos = Candidato::
            join('votacions as vot', 'vot.id_votacion', '=', 'cd.id_candidato', 'left')
            ->leftJoin('puestos', 'puestos.id_puesto', '=', 'vot.puesto_id')
            ->select('cd.id_candidato', 'cd.nombre','cd.representante','cd.imagen', 'cd.tipo_candidato')
            ->selectRaw("(select v.cant_votos from votacions v where v.puesto_id = $id_puesto and v.mesa_id = $id_mesa and v.candidato_id = cd.id_candidato) AS cant_votos_mesa")
            ->orderBy('cd.tipo_candidato', 'asc')
            ->orderBy('cd.orden', 'asc')
            ->get();

        $total = $this->TotalVotosMesa($id_mesa,$id_puesto);

        $mesa = Mesa::select('numero','id_mesa','total_electores')->where('id_mesa', '=', $id_mesa)
            ->get()->first();
        $puesto = Puesto::where('id_puesto',$id_puesto)->get()->first();

        return \View::make('votacion.index',compact('candidatos', 'mesa','total','puesto'));
    }

    private function TotalVotosMesa($mesa, $puesto)
    {
        return Votacion::selectRaw('sum(cant_votos) votos_emitidos')
            ->where('mesa_id',$mesa)
            ->where('puesto_id',$puesto)
            ->first();
    }

    public function InsOrUpdVotacion(Request $request)
    {
        $this->layout = null;
        if($request->ajax()){
            $input = $request->except('_token');
            //dd($request->input());exit;
            foreach ($input['cantidad_votos_'] as $candidato => $cant) {
                //if($voto['enable_stock']){
                    $votoreg = Votacion::select('id_votacion')->where('mesa_id',$input['mesaId'])
                        ->where('candidato_id',$candidato)->where('puesto_id',$input['puestoId'])->get()->first();

                    if($votoreg){//No existe, entonces insertar:
                        $votoUpd = Votacion::find($votoreg->id_votacion);
                        $votoUpd->cant_votos = $cant;
                        $votoUpd->save(); //this will UPDATE the record with id=1
                    }else{//No existe, entonces insertar:
                        $voto = new Votacion();
                        $voto->mesa_id = $input['mesaId'];
                        $voto->candidato_id = $candidato;
                        $voto->puesto_id = $input['puestoId'];
                        $voto->cant_votos = $cant;
                        $voto->save();
                    }
                //}
            }
            $total = $this->TotalVotosMesa($input['mesaId'],$input['puestoId']);
            $response = array(
                'status' => 'success',
                'msg' => 'Grabado correctamente',
                'total' =>$total->votos_emitidos,
            );
            return $response;
        }else{
            return array('status'=>'error', 'msg'=>'No está autorizado','total' =>$total->votos_emitidos,);
        }
    }
}
