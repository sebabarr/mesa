@extends('home')

@section('contenido')

    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Razonsocial</th><th>Tipo Mov.</th><th>Cantidad</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($totxcli as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a>{{ $item->razonsocial }}</a></td>
                    <td>{{ $item->tipo_mov }}</td>
                    <td>{{ $item->totxcli }}</td>
                    <td>
                        ------------
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
       <div class="pagination"> {!! $totxcli->setPath('')->render() !!} </div>
    </div>
    
    

@endsection