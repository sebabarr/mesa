@if ($errors->any())
    <div class="alert alert-danger" role="alert">
    <p>Por Favor Corrija los Errores</p>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
@endif    