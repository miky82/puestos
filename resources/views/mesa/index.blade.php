@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Mesas</div>

                    <div class="panel-body">
            
            <div class="col-md-3">
                <a class="btn btn-block btn-primary" class="create-mesa" href="{{action('MesaController@create')}}">
                <i class="fa fa-plus"></i> Agregar Mesa</a>
            </div>
                        @include('mesa.listamesas')
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="create_mesa_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#demo_table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": 'mesaLista',
                "columns": [
                    { "data": "id_mesa" },
                    { "data": "numero" },
                    { "data": "total_electores" },
                    { "data": "local_name" },
                    { "data": "mostrar_votos"},
                ]
            });
        } );

        $(document).on('click', 'a.create-mesa', function(e){
        e.preventDefault();
        console.log($(this).attr("href"));
        $.ajax({
            url: $(this).attr("href"),
            dataType: "html",
            success: function(result){
                $('#create_mesa_modal').html(result).modal('show');
                //__currency_convert_recursively($('#create_mesa_modal'));
            }
        });

    });
    </script>
@endsection