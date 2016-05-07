<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Listado de Bancos</title>
   <!-- {!! Html::style('assets/css/pdf.css') !!}-->
  </head>
  <body>

    <main>
      <h2>Listado de Bancos ordenados por Codigo</h2>
      
      <table border="1" style="width:50%" >
        <thead>
              
          <tr>
            <th class="">Codigo</th>
            <th class="">Entidad</th>
          </tr>
          
        </thead>
        <tbody>
            @foreach($banco as $item)
              <tr>
                <td class="">{{ $item->codigo }}</td>
                <td class="">{{ $item->entidad }}</td>
              </tr>
            @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td></td>  
          </tr>
        </tfoot>
      </table>
  </body>
</html>