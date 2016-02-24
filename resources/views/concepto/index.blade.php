
@extends('home')

@section('contenido')

    <h1>Concepto <a href="{{ url('concepto/create') }}" class="btn btn-primary pull-right btn-sm">Add New Concepto</a></h1>
    @if (Session::has('message'))
					<p class='alert alert-danger'>{{ Session::get('message') }}</p>
	@endif
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Concepto</th><th>Signo</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($concepto as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('concepto', $item->id) }}">{{ $item->concepto }}</a></td><td>{{ $item->signo }}</td>
                    <td>
                        <a href="{{ url('concepto/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['concepto', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $concepto->render() !!} </div>
    </div>

@endsection
