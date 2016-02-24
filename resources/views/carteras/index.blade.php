
@extends('home')

@section('contenido')

    <h1>Carteras <a href="{{ url('carteras/create') }}" class="btn btn-primary pull-right btn-sm">Add New Cartera</a></h1>
    @if (Session::has('message'))
					<p class='alert alert-danger'>{{ Session::get('message') }}</p>
	@endif
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Nombre</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($carteras as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('carteras', $item->id) }}">{{ $item->nombre }}</a></td>
                    <td>
                        <a href="{{ url('carteras/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['carteras', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $carteras->render() !!} </div>
    </div>

@endsection
