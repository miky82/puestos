@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Votos de la mesa <b>{{$mesa->numero}}</b> para el puesto de <b>{{$puesto->descripcion}}</b><div>En total hay {{$mesa->total_electores}} electores</div></div>

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
                                        <input id="cantidad_votos_[<?php echo $cv->id_candidato; ?>]" type="text" class="form-control" name="cantidad_votos_[<?php echo $cv->id_candidato; ?>]" value="{{ ($cv->cant_votos_mesa)?$cv->cant_votos_mesa : 0 }}">
                                    </td>
                                </tr>
                            @endforeach
                            <tr style="border-top:1pt solid black;">
                                <td colspan="2" style="height:50px;"></td>
                                <td><b>TOTAL DE VOTOS EMITIDOS </b></td>
                                <td><b><div id="total_votos_index">{{$total->votos_emitidos}}</div></b></td>
                            </tr>
                            </tbody>
                        </table>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <button id="guardarv" type="submit" class="btn btn-warning">Guardar Votos</button>
                                    <input type="button" value="Cerrar" id="atras" name="atras" onclick= "self.location.href = '/mesa'" class="btn btn-default" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="cargando"><div id="cargador">Cargando...</div></div>
@endsection
@section('script')
    <script type="text/javascript">
            $('#formVotos').submit(function (e) {
                e.preventDefault();
                $('#guardarv').attr('disabled','disabled');
                $.ajax({
                    type: "POST",
                    url: '/guardarVotos',
                    data: $(this).serialize(),
                    success: function(r) {
                        $('#total_votos_index').html(r.total);
                        //alert(r.msg);
                        $('#guardarv').removeAttr('disabled');
                    }
                });
            });

            // tu elemento que quieres activar.
            var cargando = $("#cargando");

            // evento ajax start
            $(document).ajaxStart(function() {
            cargando.show();
            });

            // evento ajax stop
            $(document).ajaxStop(function() {
            cargando.hide();
            });
    </script>
@endsection
@push('css')
<style type="text/css">
    #cargando{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    opacity:0.6;
    background-color: #a7a2d6;
    display:none;
    z-index:1;
}

#cargador{
    position:absolute;
    top:50%;
    left: 50%;
    margin-top: -25px;
    margin-left: -25px;
}
</style>
@endpush