<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Archivos<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('Admin.user.index') }}">Usuarios</a></li>
            <li><a href="{{ route('cuits.index') }}">Cuits</a></li>
            <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
            <li><a href="{{ route('concepto.index') }}">Conceptos de Caja</a></li>
            <li><a href="{{ route('bancos.index') }}">Bancos</a></li>
            <li><a href="{{ route('carteras.index') }}">Carteras</a></li>
          </ul> 
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Moneda<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('operacion.index') }}">Operaciones de Moneda</a></li>
            <li><a href="{{ action('OperacionController@estadisticas') }}">Estadisticas de Moneda</a></li>
            <li><a href="{{ action('OperacionController@totalesxmoneda') }}">Totales de Moneda</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ route('movimientos.index') }}">Movimientos de Caja</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cheques<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('cheques.index') }}">Cartera de Cheques</a></li>
            <li><a href="{{ action('ChequesController@buscarcheque') }}">Buscar Cheque</a></li>
            <li><a href="{{ action('ChequesController@imprimirCesiones') }}">Imprimir Cesion</a></li>
            <li><a href="{{ action('ChequesController@imprimircheques') }}">Impresion Cheques</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ action('ChequesController@totxcli') }}">Totales x Cliente</a></li>
            <li><a href="{{ action('ChequesController@totxcuits') }}">Totales x Cuits</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ route('movicheques.index') }}">Caja Cheques</a></li>
            <li><a href="{{ action('ChequesController@tot_ing_eng') }}">Total Ing-Eng</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>