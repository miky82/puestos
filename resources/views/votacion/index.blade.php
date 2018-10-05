@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Votos de la mesa <b>{{$mesa->numero}}</b> para el puesto de <b>{{$puesto->descripcion}}</b></div>

                    <div class="panel-body">
                        <form action="" id="formVotos" >
                            <input id="mesaId" name="mesaId" hidden="hidden" type="text" value="{{$mesa->id_mesa}}">
                            <input id="puestoId" name="puestoId" hidden="hidden" type="text" value="{{$puesto->id_puesto}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <table id="demo_table" class="form-group display" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Candidato</th>
                                <th>Total de votos</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $num = 0; ?>
                            @foreach($candidatos as $cv)
                                <?php $num++; ?>
                                <tr>
                                    <td>{{ $num }}</td>
                                    <td><img src="{{ $cv->imagen }}"></td>
                                    <td>{{ $cv->nombre }}</td>
                                    <td>
                                        <input id="cantidad_votos_<?php echo $cv->id_candidato; ?>" type="text" class="form-control" name="cantidad_votos_<?php echo $cv->id_candidato; ?>" value="{{ ($cv->cant_votos_mesa)?$cv->cant_votos_mesa : 0 }}">
                                    </td>
                                </tr>
                            @endforeach
                            <tr style="border-top:1pt solid black;">
                                <td colspan="2" style="height:50px;"></td>
                                <td><b>TOTAL DE VOTOS EMITIDOS </b></td>
                                <td><b>{{$total->votos_emitidos}}</b></td>
                            </tr>
                            </tbody>
                        </table>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <input type="button" href="/mesa" class="btn btn-default" value="Atrás">
                                    <button type="submit" class="btn btn-warning">Guardar Votos</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
            $('#formVotos').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '/guardarVotos',
                    data: $(this).serialize(),
                    success: function(msg) {
                        alert(msg);
                    }
                });
            });
    </script>
@endsection