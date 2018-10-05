@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Locales</div>

                    <div class="panel-body">
                        <table id="local_table" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Local</th>
                                <th>Distrito</th>
                            </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#local_table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": 'localLista',
                "columns": [
                    { "data": "id_local" },
                    { "data": "nombre" },
                    { "data": "distrito_name" },
                ]
            });
        } );
    </script>
@endsection