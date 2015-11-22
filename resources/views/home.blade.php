@extends('app')

@section('content')
<div class="container">
	<div class="row">
	<!--	<div class="col-md-12 col-md-offset-1">-->
			@include('barrasistema')
			@yield('contenido')
	<!--	</div>-->
	</div>
</div>
@endsection
