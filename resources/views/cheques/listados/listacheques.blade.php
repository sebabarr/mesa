<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Listado de Cheques</title>
  </head>
  <style type="text/css">
    .saltopagina {
                page-break-after: always;
                }
  </style>
  <body>
    <main>
        <h3>Detalle</h3>
        <table>
            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Nro.cheque</th>
                    <th>IMPORTE</th>
                    <th>FECHA Vto.</th>
                    <th>CUIT</th>
                    <th>ESTADO</th>
                    <th>BANCO</th>
                </tr>
            </thead>    
            <tbody style="page-break-before: always">
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
                            {{ money_format('%.2n',$mcheque->importe) }}
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
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
        Total Cheques: $ {{ $totalcheques }}
        Total de cheques : {{ $totalnroche }}
    </body>
</html>