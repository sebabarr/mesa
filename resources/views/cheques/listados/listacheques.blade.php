<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Listado de Cheques</title>
  </head>
  <style type="text/css">

  </style>
  <body>
    <main>
        <h3>Detalle</h3>
        <table>
            <thead>
                <tr>
                    <th>Nro.CHEQUE</th>
                    <th>IMPORTE</th>
                    <th>FECHA Vto.</th>
                    <th>CUIT</th>
                    <th>ESTADO</th>
                    <th>BANCO</th>
                </tr>
            </thead>    
            <tbody>
                {{-- */$x=0;/* --}}
                @foreach ($mcheques as $mcheque)
                {{-- */$x++;/* --}}
                <tr>
                    <td>
                        {{ $x }}
                    </td>    
                    <td>
                        {{ $mcheque->nrocheque }}    
                    </td>
                    <td>
                        {{ $mcheque->importe }}
                    </td>
                    <td>
                        {{ $mcheque->fechavto }}
                    </td>
                    <td>
                        {{ $mcheque->cuits->razonsocial }}
                    </td>
                    <td>
                         {{ $mcheque->estado }}
                    </td>
                    <td>
                         {{ $mcheque->id_banco }}
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="page-break-before: always;"></div>
        Total Cheques: $ {{ $totalcheques }}
        Total de cheques : {{ $totalnroche }}
    </body>
</html>