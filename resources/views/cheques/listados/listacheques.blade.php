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
                @foreach ($mcheques as $mcheque)
                <tr>
                    
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
        Total Cheques: $ {{ $totalcheques }}
        Total de cheques : {{ $totalnroche }}
    </body>
</html>