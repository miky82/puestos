@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Mesas</div>

                    <div class="panel-body">
                        @include('mesa.listamesas')
                    </div>


                </div>
            </div>
        </div>
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
    </script>
@endsection