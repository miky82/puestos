@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Votos</div>

                    <div class="panel-body">
                        <table id="demo_table" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Candidato</th>
                                <th>Total de votos</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($candidatos as $cv)
                                <tr>
                                    <td>{{ $cv->candidato_id }}</td>
                                    <td><img src="{{ $cv->imagen }}"></td>
                                    <td>{{ $cv->nombre }}</td>
                                    <td><input id="cantidad_votos" type="text" class="form-control" name="name" value="{{ $cv->cant_votos }}">
                                        </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>



                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection