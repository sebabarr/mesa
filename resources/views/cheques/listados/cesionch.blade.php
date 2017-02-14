<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cesion de Cheques</title>
   <!-- {!! Html::style('assets/css/pdf.css') !!}-->
  </head>
  <style type="text/css">
    
    h4 {
        color: black;
        text-align: left;
        font-size: 15px;
        line-height: 0.7;
    }

    p {
        font-family: verdana;
        font-size: 12px;
        
    }
    pre {
        font-size: 12px;
    }
  </style>
  <body>

    <main>
        <h3>CESION DE CHEQUE</h3>
        <p>Entre {{ $var_impre["nomcli"]}}, D.N.I. {{ $var_impre["dni"]}} , con domicilio en {{ $var_impre["dire"] }} de la localidad de Cordoba , en adelante
            denominado EL CEDENTE, por una parte y Barr Sebastian Raul, 22.561.111, con domicilio en 25 de Mayo 271 1 piso de la
            Ciudad de Cordoba, en adelante denominado EL CESIONARIO, se conviene en realizar el siguiente contrato
            de la cesion de cheque(s), conforme lo establecen las cláusulas que se disponen a continuacion:<br>
        <b>PRIMERO:OBJETO</b><br>
        1.1 EL CEDENTE, cede y transfiere a EL CESIONARIO los siguientes cheques:</p>
        <table>
            <thead>
                <tr>
                    <th>Nro.CHEQUE</th>
                    <th>IMPORTE</th>
                    <th>FECHA Vto.</th>
                    <th>CUIT</th>
                    <th>LIBRADOR</th>
                    <th>BANCO</th>
                </tr>
            </thead>    
            <tbody>
                @foreach ($ncheques as $ncheque)
                <tr>
                    
                    <td>
                        {{ $ncheque->nrocheque }}    
                    </td>
                    <td>
                        {{ $ncheque->importe }}
                    </td>
                    <td>
                        {{ $ncheque->fechavto }}
                    </td>
                    <td>
                        {{ $ncheque->numero}}
                    </td>
                    <td>
                         {{ $ncheque->razonsocial }}
                    </td>
                    <td>
                         {{ $ncheque->entidad }}
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        ________________________________________________________________________________

        <P>1.2 A los fines de materializar la presente cesion, EL CEDENTE hace entrega a a EL CESIONARIO de los cheques
            detallados en el punto 1.1<br>
            1.3 En virtud de la presente cesion, EL CESIONARIO adquiere todos y cada uno de los derechos y obligaciones
            que rigen del cheque que por este acto se cede, sin restriccion ni limitacion de ninguna naturaleza.<br>
        <b>SEGUNDO:PRECIO</b><br>
            EL CEDENTE declara que ha recibido de EL CESIONARIO el importe total de los cheques que se detallan en el 
            punto 1.1, por lo que nada tiene que reclamar en relacion al precio de la presente cesion<br>
            <b>TERCERO:LEGITIMIDAD DEL CREDITO</b><br>
            EL CEDENTE declara bajo juramento que es tenedor legitimo de los cheques que se ceden en este acto.
            Asimismo garantiza la existencia y legitimidad del credito cedido, colocando a EL CESIONARIO en la misma 
            situacion que le correspondia a EL CEDENTE frente al crédito cedido<br>
        <b>CUARTO:MORA-FIANZA</b><br>
            Que en el caso de rechazo y/o falta de pago del cheque de referencia, por cualquier causa, EL CEDENTE se constituye en
            fiador solidario, liso, llano y principal pagador de todas las obligaciones emergentes del cheque
            cedido por el presente, garantizando asimismo todos los gastos, honorarios e intereses que se devenguen en caso de rechazo.<br>
        <b>QUINTO: DOMICILIOS-JURISDICCION</b><br>
            Por cualquier clase de controversia judicial, las partes se someten a la Jurisdiccion de los Tribunales Ordinarios de la
            Ciudad de Cordoba, con renuncia a cualquier otro fuero o jurisdiccion que pudiera corresponderles, constituyendo domicilio
            a todos los efectos legales en los mencionados anteriormente.
            En prueba de conformidad se firman dos ejemplares de un mismo tenor y a un solo efecto en 
            la Ciudad de Cordoba, el {{ $var_impre["fechahoy"] }}.--
            </p>
        <br>
            
            
        <pre>------------     ----------------------     -----------------  
        Firma                Aclaracion                  DNI</pre><br>
    
        ----------------------------------------------------------------------------------------- </br>
    
    <p>Librado en la Ciudad de Cordoba, Provincia de Cordoba, el {{ $var_impre["fecletra"] }} 
    ,Con fecha {{ $var_impre["fechahoy"]}}  PAGARE a Barr Sebastian Raul, D.N.I. 22.561.111, o a su orden
    , sin protesto (Articulo 50 Decreto - Ley N° 5.965/63), la suma de pesos {{ $var_impre["impletras"]}}. El capital de este
    pagaré devengara un interes compensatorio a una tasa del 12% anual contado desde la fecha de libramiento
    y hasta su efectivo pago. Lugar de pago: 25 de Mayo 271 piso 1-Ciudad de Cordoba.</p>
    <pre>
    Librador:_________________________________________________
    
    Domicilio del librador:__________________________________________
    
        
    _______                    ______________                ______________
    Firma                        Aclaracion                         DNI
    </pre>    
    </body>
</html>