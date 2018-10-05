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
    public function mostrar($id_mesa,$id_puesto=1)
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

        $total = Votacion::selectRaw('sum(cant_votos) votos_emitidos')
            ->where('mesa_id',$id_mesa)
            ->where('puesto_id',$id_puesto)
            ->first();

        $mesa = Mesa::select('numero','id_mesa')->where('id_mesa', '=', $id_mesa)
            ->get()->first();
        $puesto = Puesto::where('id_puesto',$id_puesto)->get()->first();

        return \View::make('votacion.index',compact('candidatos', 'mesa','total','puesto'));
    }
    public function InsOrUpdVotacion()
    {
        $this->layout = null;
        //check if its our form
        if(Request::ajax()){
            $input = Input::class;
            print_r($input->get());exit;
            $name = $input->get('name');
            //$name = Input::get( 'name' );
            $content = Input::get( 'message' );

            $comment = new Comment();
            $comment->author =  $name;
            $comment->comment_content = $content;
            $comment->save();

            $postComment = new CommentPost();
            $postComment->post_id = Input::get('post_id');
            $postComment->comment_id = Comment::max('id');
            $postComment->save();

            $response = array(
                'status' => 'success',
                'msg' => 'Setting created successfully',
            );
            return 'yea';
        }else{
            return 'no';
        }
    }
}
