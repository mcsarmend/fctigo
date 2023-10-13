@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tablero</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{-- <h1 class="card-title">SOH Conjunto</h1> --}}
        </div>
        <div class="card-body" style="width: 1200px">


            <div class="section">
                <h3>Aforos</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Aforo</th>
                            <th>Actual Jucavi</th>
                            <th>Actual Mambu</th>
                            <th>Actual Suma</th>
                            <th>Diferencia</th>
                            <th>Cantidad Jucavi</th>
                            <th>Cantidad Mambu</th>
                            <th>Suma cantidad</th>
                            <th>Exportar Creditos</th>


                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Promecap</th>
                            <th id="aforocalpromecap">AFORO CALCULADO PROMECAP</th>
                            <td id="valoractualjucavipromecap">Valor Actual jucavi promecap</td>
                            <td id="valoractualmambupromecap">Valor Actual mambu promecap</td>
                            <td id="valoractualsumapromecap">Valor Actual suma promecap</td>
                            <td id="valordiferenciapromecap">Valor Diferencia Promecap</td>
                            <td id="cantidadactualjucavipromecap">Cantidad actual jucavi Promecap</td>
                            <td id="cantidadactualmambupromecap">Cantidad actual mambu Promecap</td>
                            <td id="sumacantidadactualpromecap">Suma cantidad Promecap</td>
                            <th><button type="button" class="btn btn-primary"
                                    id="exportarcreditospromecap">Exportar</button></th>
                        </tr>
                        <tr>
                            <th>Blao</th>
                            <td id="valoraforoblao">$153,173,700.00</td>
                            <td id="valoractualjucaviblao">Valor Actual jucavi blao</td>
                            <td id="valoractualmambublao">Valor Actual mambu blao</td>
                            <td id="valoractualsumablao">Valor Actual suma blao</td>
                            <td id="valordiferenciablao">Valor Diferencia blao</td>
                            <td id="cantidadactualjucaviblao">Cantidad actual jucavi blao</td>
                            <td id="cantidadactualmambublao">Cantidad actual mambu blao</td>
                            <td id="sumacantidadactualblao">Suma cantidad blao</td>
                            <th>EXPORTAR</th>
                        </tr>
                        <tr >
                            <th>Mintos</th>
                            <td id="valoraforomintos">-</td>
                            <td id="valoractualjucavimintos">-</td>
                            <td id="valoractualmambumintos">Valor Actual mambu mintos</td>
                            <td id="valoractualsumamintos">Valor Actual suma mintos</td>
                            <td id="valordiferenciamintos">-</td>
                            <td id="cantidadactualjucavimintos">-</td>
                            <td id="cantidadactualmambumintos">Cantidad actual mambu mintos</td>
                            <td id="sumacantidadactualmintos">Suma cantidad mintos</td>
                            <th>EXPORTAR</th>
                        </tr>
                    </tbody>
                </table>


            </div>
            <br>
            <div class="section">

                <h2>Anexos</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Anexo H</th>
                            <th>Anexo M</th>
                            <th>Anexo O </th>
                            <th>Historico</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Promecap</th>
                            <th>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#anexoHPromecapModal">Previo</button>
                            </th>
                            <th>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#anexoMPromecapModal">Previo</button>
                            </th>
                            <th><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#anexoOPromecapModal">Previo</button>
                            </th>
                            <th><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#aforohistoricomodal">Ver</button>
                            </th>
                        </tr>
                        <tr>
                            <th>Blao</th>
                            <th>ANEXO H BALO</th>
                            <th>ANEXO M BALO</th>
                            <th>ANEXO O BALO</th>
                            <th>Ver</th>
                        </tr>
                        <tr style="display:none">
                            <th>Mintos</th>
                            <th>ANEXO H MINTOS</th>
                            <th>ANEXO M MINTOS</th>
                            <th>ANEXO O MINTOS</th>
                            <th>Ver</th>

                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="section">
                <h2> Gráficas</h2>
                <br>
                <figure class="highcharts-figure">
                    <h2>JUCAVI</h2>
                    <div id="container-jucavi"></div>
                    <p class="highcharts-description">
                        En esta gráfica se encuentra la cantidad de elementos de un fondeador jucavi
                    </p>
                </figure>
                <br>
                <figure class="highcharts-figure">
                    <h2>MAMBU</h2>
                    <div id="container-mambu"></div>
                    <p class="highcharts-description">
                        En esta gráfica se encuentra la cantidad de elementos de un fondeador mambu
                    </p>
                </figure>
            </div>
            <br>
            <br>


        </div>

    </div>

    {{-- MODAL HISTORICO --}}
    <div class="modal fade" id="aforohistoricomodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Cabecera del Modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Historico</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Contenido del Modal -->
                <div class="modal-body modalAnexo">
                    <div class="p-3">
                        <table id="tablahistoricopromecap" class="table table-striped table-bordered" style="width:100%; ">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Aforo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Los datos se insertarán aquí dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pie del Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>




    <!-- ANEXO H PROMECAP -->

    <div class="modal fade" id="anexoHPromecapModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Cabecera del Modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Anexo H PROMECAP</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Contenido del Modal -->
                <div class="modal-body modalAnexo">
                    <div class="modalAnexo" id="anexoHdocumento">
                        <div class="pos" id="_0:0" style="top:0">
                            <div id="anexoHdocumentoHoja1">
                                <div class="cent" id="_389:98" style="top:98;left:389">
                                    <span id="_13.6"
                                        style="font-weight:bold; font-family:Arial; font-size:13.6px; color:#000000">
                                        <U>A</U><U>n</U><U>e</U><U>x</U><U>o</U><U>
                                        </U><U>&#147;</U><U>H</U><U>&#148;</U></span>
                                </div>
                                <div class="cent" id="_238:132" style="top:132;left:238">
                                    <span id="_13.6"
                                        style="font-weight:bold; font-family:Arial; font-size:13.6px; color:#000000">
                                        <U>F</U><U>o</U><U>r</U><U>m</U><U>a</U><U>t</U><U>o</U><U> </U><U>d</U><U>e</U><U>
                                        </U><U>A</U><U>n</U><U>e</U><U>x</U><U>o</U><U> </U><U>d</U><U>e</U><U>l</U><U>
                                        </U><U>C</U><U>o</U><U>n</U><U>t</U><U>r</U><U>a</U><U>t</U><U>o</U><U>
                                        </U><U>d</U><U>e</U><U> </U><U>C</U><U>e</U><U>s</U><U>i</U><U>&#243;</U><U>n</U><U>
                                        </U><U>d</U><U>e</U><U>
                                        </U><U>C</U><U>r</U><U>&#233;</U><U>d</U><U>i</U><U>t</U><U>o</U><U>s</U></span>
                                </div>
                                <div class="drecha" id="_392:165" style="top:165;left:392">
                                    <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                        Ciudad de M&#233;xico, M&#233;xico, a 07 de septiembre de 2023</span>
                                </div>
                                <div class="pos" id="_118:199" style="top:199;left:118">
                                    <span id="_14.1"
                                        style="font-weight:bold; font-family:Arial; font-size:14.1px; color:#000000">
                                        Banco Invex, S.A., Instituci&#243;n de Banca M&#250;ltiple, </span>
                                </div>
                                <div class="pos" id="_118:216" style="top:216;left:118">
                                    <span id="_14.1"
                                        style="font-weight:bold; font-family:Arial; font-size:14.1px; color:#000000">
                                        Invex Grupo Financiero, en su car&#225;cter de </span>
                                </div>
                                <div class="pos" id="_118:233" style="top:233;left:118">
                                    <span id="_14.1"
                                        style="font-weight:bold; font-family:Arial; font-size:14.1px; color:#000000">
                                        Fiduciario del Fideicomiso F/4870</span>
                                </div>
                                <div class="pos" id="_118:249" style="top:249;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        Boulevard Manuel &#193;vila Camacho No. 40, Piso 7</span>
                                </div>
                                <div class="pos" id="_118:266" style="top:266;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        Colonia Lomas de Chapultepec,</span>
                                </div>
                                <div class="pos" id="_118:283" style="top:283;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        C.P. 11000, Ciudad de M&#233;xico, M&#233;xico</span>
                                </div>
                                <div class="pos" id="_118:316" style="top:316;left:118">
                                    <span id="_13.4"
                                        style="font-weight:bold; font-family:Arial; font-size:13.4px; color:#000000">
                                        Atenci&#243;n:<span style="font-weight:normal"> Samantha Barquera Betancourt y
                                            Talina
                                            Ximena Mora Rojas</span></span>
                                </div>
                                <div class="pos" id="_731:333" style="top:333;left:731">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    </span>
                                </div>
                                <div class="derecha" id="_479:350" style="top:350;left:479">
                                    <span id="_13.4"
                                        style="font-weight:bold; font-family:Arial; font-size:13.4px; color:#000000">
                                        <U>A</U><U>s</U><U>u</U><U>n</U><U>t</U><U>o</U><U>:</U><span
                                            style="font-weight:normal"><U>
                                            </U><U>C</U><U>o</U><U>n</U><U>t</U><U>r</U><U>a</U><U>t</U><U>o</U><U>
                                            </U><U>d</U><U>e</U><U>
                                            </U><U>C</U><U>e</U><U>s</U><U>i</U><U>&#243;</U><U>n</U><U>
                                            </U><U>d</U><U>e</U><U>
                                            </U><U>C</U><U>r</U><U>&#233;</U><U>d</U><U>i</U><U>t</U><U>o</U><U>s</U>.</span></span>
                                </div>
                                <div class="pos" id="_118:383" style="top:383;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        Estimadas se&#241;oras, </span>
                                </div>
                                <div class="justif" id="_167:417" style="top:417;left:167">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        Hacemos referencia (i) al contrato de fideicomiso irrevocable de administraci&#243;n
                                        y
                                        fuente de </span>
                                </div>
                                <div class="justif" id="_118:434" style="top:434;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        pago identificado con el n&#250;mero F/4870 de fecha 8 de abril de 2022, celebrado
                                        entre
                                        el Banco Invex, </span>
                                </div>
                                <div class="justif" id="_118:450" style="top:450;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        S.A., Instituci&#243;n de Banca M&#250;ltiple, Invex Grupo Financiero, en su
                                        car&#225;cter de fiduciario, CEGE Capital, </span>
                                </div>
                                <div class="justif" id="_118:467" style="top:467;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        S.A.P.I. de C.V., SOFOM, E.N.R., como Fideicomitente B, Fideicomisario en Segundo
                                        Lugar,
                                        Custodio </span>
                                </div>
                                <div class="justif" id="_118:484" style="top:484;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        y Administrador, Promecade, S.A.P.I. de C.V., SOFOM, E.N.R., como Fideicomitente A y
                                        Fideicomisario </span>
                                </div>
                                <div class="justif" id="_118:501" style="top:501;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        en Primer Lugar, Administradora de Activos Financieros, S.A., como Administrador
                                        Maestro, y los </span>
                                </div>
                                <div class="justif" id="_118:518" style="top:518;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        se&#241;ores Allan Cherem Mizrahi, Emilio Cherem Gamus y Rodrigo San Pedro
                                        Fern&#225;ndez, como </span>
                                </div>
                                <div class="justif" id="_118:534" style="top:534;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        Depositarios (el
                                        &#147;<U>F</U><U>i</U><U>d</U><U>e</U><U>i</U><U>c</U><U>o</U><U>m</U><U>i</U><U>s</U><U>o</U>&#148;),
                                        y (ii) al Contrato de Cesi&#243;n de Cr&#233;ditos de fecha 8 de abril de 2022
                                    </span>
                                </div>
                                <div class="justif" id="_118:551" style="top:551;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        (el &#147;<U>C</U><U>o</U><U>n</U><U>t</U><U>r</U><U>a</U><U>t</U><U>o</U><U>
                                        </U><U>d</U><U>e</U><U> </U><U>C</U><U>e</U><U>s</U><U>i</U><U>&#243;</U><U>n</U><U>
                                        </U><U>d</U><U>e</U><U>
                                        </U><U>C</U><U>r</U><U>&#233;</U><U>d</U><U>i</U><U>t</U><U>o</U><U>s</U>&#148;),
                                        celebrado entre CEGE Capital, S.A.P.I. de C.V., SOFOM, E.N.R., </span>
                                </div>
                                <div class="justif" id="_118:568" style="top:568;left:118">
                                    <span id="_13.8" style=" font-family:Arial; font-size:13.8px; color:#000000">
                                        como cedente, y Banco Invex, S.A., Instituci&#243;n de Banca M&#250;ltiple, Invex
                                        Grupo
                                        Financiero, como </span>
                                </div>
                                <div class="justif" id="_118:585" style="top:585;left:118">
                                    <span id="_13.8" style=" font-family:Arial; font-size:13.8px; color:#000000">
                                        Fiduciario del Fideicomiso, como cesionario. Los t&#233;rminos con may&#250;scula
                                        inicial que se utilicen y no </span>
                                </div>
                                <div class="justif" id="_118:601" style="top:601;left:118">
                                    <span id="_13.8" style=" font-family:Arial; font-size:13.8px; color:#000000">
                                        se definan de otra manera en el presente, tendr&#225;n el significado que se les
                                        atribuye en Fideicomiso. </span>
                                </div>
                                <div class="justif" id="_167:643" style="top:643;left:167">
                                    <span id="_13.8" style=" font-family:Arial; font-size:13.8px; color:#000000">
                                        De conformidad con lo dispuesto en el Apartado II de la Cl&#225;usula Quinta del
                                        Fideicomiso, y </span>
                                </div>
                                <div class="justif" id="_118:660" style="top:660;left:118">
                                    <span id="_13.8" style=" font-family:Arial; font-size:13.8px; color:#000000">
                                        mediante la firma de la presente, las Partes acuerdan adicionar (y en ning&#250;n
                                        momento se entender&#225; </span>
                                </div>
                                <div class="justif" id="_118:677" style="top:677;left:118">
                                    <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                        como remplazo) al Anexo A del Contrato de Cesi&#243;n de Cr&#233;ditos los
                                        Cr&#233;ditos
                                        a Clientes Transferidos </span>
                                </div>
                                <div class="justif" id="_118:694" style="top:694;left:118">
                                    <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                        que se se&#241;alan a continuaci&#243;n, mismos que a partir de esta fecha
                                        tendr&#225;n
                                        el car&#225;cter de Cr&#233;ditos a </span>
                                </div>
                                <div class="pos" id="_118:710" style="top:710;left:118">
                                    <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                        Clientes Cedidos:</span>
                                </div>
                                <div class="cent" id="_391:746" style="top:746;left:391">
                                    <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                        Anexo &#147;A&#148;<span id="_8.8" style=" font-size:8.8px"> 1</span></span>
                                </div>
                                <div class="pos" id="_143:779" style="top:779;left:143">
                                    <span id="_12.4"
                                        style=" font-family:Times New Roman; font-size:12.4px; color:#000000">
                                        &#160;<span id="_13.5" style=" font-family:Arial; font-size:13.5px">
                                            Cr&#233;ditos
                                            a Clientes adicionados con fecha 05 de septiembre de 2023.</span></span>
                                </div>
                                <div class="pos" id="_143:796" style="top:796;left:143">
                                    <span id="_12.4"
                                        style=" font-family:Times New Roman; font-size:12.4px; color:#000000">
                                        &#160;<span id="_13.5" style=" font-family:Arial; font-size:13.5px"> Saldo
                                            Insoluto de Principal a la fecha <a id="anexohaforo"></a></span></span>
                                </div>


                            </div>
                            <div id="anexoHdocumentoHoja2">
                                <div class="pos" id="_118:931" style="top:931;left:118">
                                    <span id="_13.9" style=" font-family:Arial; font-size:13.9px; color:#000000">
                                        El presente Anexo A deber&#225; incluir adem&#225;s las siguientes columnas: (i) el
                                        saldo insoluto total de </span>
                                </div>
                                <div class="pos" id="_118:948" style="top:948;left:118">
                                    <span id="_13.9" style=" font-family:Arial; font-size:13.9px; color:#000000">
                                        intereses ordinarios por devengar de la l&#237;nea de cr&#233;dito a la fecha, (ii)
                                        el
                                        saldo total de Impuesto al </span>
                                </div>
                                <!--<div class="pos" id="_421:1002" style="top:1002;left:421">
                                                                                                                                            <span id="_13.9" style=" font-family:Arial; font-size:13.9px; color:#000000">
                                                                                                                                            1</span>
                                                                                                                                        </div>-->
                                <div class="pos" id="_118:1019" style="top:1019;left:118">
                                    <span id="_11.1"
                                        style=" font-family:Times New Roman; font-size:11.1px; color:#4c4c4c">
                                        GA #317798v1</span>
                                </div>
                                <div class="justif" id="_118:1198" style="top:1198;left:118">
                                    <span id="_13.9" style=" font-family:Arial; font-size:13.9px; color:#000000">
                                        Valor Agregado sobre intereses ordinarios por devengar de la l&#237;nea de
                                        cr&#233;dito
                                        a la fecha, (iii) el </span>
                                </div>
                                <div class="justif" id="_118:1215" style="top:1215;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        n&#250;mero total de parcialidades restantes de la l&#237;nea de cr&#233;dito a la
                                        fecha, (iv) la periodicidad de pago </span>
                                </div>
                                <div class="justif" id="_118:1232" style="top:1232;left:118">
                                    <span id="_14.0" style=" font-family:Arial; font-size:14.0px; color:#000000">
                                        (en caso de no ser quincenal), (v) el monto de cada parcialidad restante y (vi) la
                                        fecha
                                        de cada </span>
                                </div>
                                <div class="justif" id="_118:1249" style="top:1249;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        parcialidad restante.</span>
                                </div>
                                <br>
                                <div class="justif" id="_167:1282" style="top:1282;left:167">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        La presente carta convenio entrar&#225; en vigor a partir del 07 de septiembre de
                                        2023,
                                        una vez </span>
                                </div>
                                <div class="justif" id="_118:1299" style="top:1299;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        que haya sido firmada por todas las Partes. </span>
                                </div>
                                <br>
                                <div class="justif" id="_167:1333" style="top:1333;left:167">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        Excepto por las modificaciones establecidas en la presente, el Contrato de
                                        Cesi&#243;n
                                        de Cr&#233;ditos </span>
                                </div>
                                <div class="justif" id="_118:1349" style="top:1349;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        continua vigente en todos sus t&#233;rminos mismos que son ratificados por las
                                        Partes en
                                        este acto. </span>
                                </div>
                                <br>
                                <div class="justif" id="_167:1383" style="top:1383;left:167">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        Para todo lo relativo a la interpretaci&#243;n y cumplimiento de esta carta convenio
                                        o
                                        para </span>
                                </div>
                                <div class="justif" id="_118:1400" style="top:1400;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        cualquier controversia en relaci&#243;n con la misma, las Partes se someten
                                        expresamente
                                        a las leyes de </span>
                                </div>
                                <div class="jusif" id="_118:1416" style="top:1416;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        M&#233;xico y a la jurisdicci&#243;n de los tribunales federales con sede en la
                                        Ciudad
                                        de M&#233;xico, que ser&#225;n los </span>
                                </div>
                                <div class="justif" id="_118:1433" style="top:1433;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        &#250;nicos competentes para conocer de todo lo relativo a la interpretaci&#243;n,
                                        cumplimiento, </span>
                                </div>
                                <div class="justif" id="_118:1450" style="top:1450;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        incumplimiento, rescisi&#243;n as&#237; como cualquier controversia relacionada con
                                        la
                                        presente Carta </span>
                                </div>
                                <div class="justif" id="_118:1467" style="top:1467;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        Modificatoria, y renuncian por lo tanto a cualquier otro fuero que pudiera
                                        corresponderles por raz&#243;n </span>
                                </div>
                                <div class="justif" id="_118:1483" style="top:1483;left:118">
                                    <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                        de sus domicilios actuales o futuros o por cualquier otro motivo.</span>
                                </div>
                                <br>
                                {{-- AJUSTE tabla --}}
                                <div style=" font-family:Times New Roman; font-size:13.4px; color:#000000">
                                    <div class="row">
                                        <div class="col">
                                            <span id="_13.4"
                                                style=" font-family:Arial; font-size:13.4px; color:#000000">
                                                Contigo</span>
                                        </div>
                                        <div class="col">
                                            <span id="_13.4"
                                                style=" font-family:Arial; font-size:13.4px; color:#000000">
                                                El Fiduciario</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span id="_12.9"
                                                style=" font-family:Arial; font-size:12.9px; color:#000000">
                                                CEGE Capital, S.A.P.I. de C.V., SOFOM, E.N.R.</span>
                                        </div>
                                        <div class="col">
                                            <span id="_13.6"
                                                style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                Banco Invex, S.A., Instituci&#243;n de Banca </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">

                                        </div>
                                        <div class="col">
                                            <span id="_13.6"
                                                style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                M&#250;ltiple, Invex Grupo Financiero, en su </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">

                                        </div>
                                        <div class="col">
                                            <span id="_13.6"
                                                style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                car&#225;cter de Fiduciario del Fideicomiso F/4870</span>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <span id="_13.6"
                                                style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                ________________________________</span>
                                        </div>
                                        <div class="col">
                                            <span id="_13.6"
                                                style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                ________________________________</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span id="_13.2"
                                                style=" font-family:Arial; font-size:13.2px; color:#000000">
                                                Por: Ana Mar&#237;a del Pilar Aranda Camacho</span>
                                        </div>
                                        <div class="col">
                                            <span id="_13.2"
                                                style=" font-family:Arial; font-size:13.2px; color:#000000">
                                                Por: Samantha Barquera Betancourt</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span id="_13.2"
                                                style=" font-family:Arial; font-size:13.2px; color:#000000">
                                                Cargo: Apoderado</span>
                                        </div>
                                        <div class="col">
                                            <span id="_13.2"
                                                style=" font-family:Arial; font-size:13.2px; color:#000000">
                                                Cargo: Apoderado</span>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <span id="_13.4"
                                                style=" font-family:Arial; font-size:13.4px; color:#000000">
                                                Contigo</span>
                                        </div>
                                        <div class="col">
                                            <span id="_13.4"
                                                style=" font-family:Arial; font-size:13.4px; color:#000000">
                                                El Fiduciario</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span id="_12.9"
                                                style=" font-family:Arial; font-size:12.9px; color:#000000">
                                                CEGE Capital, S.A.P.I. de C.V., SOFOM, E.N.R.</span>
                                        </div>
                                        <div class="col">
                                            <span id="_13.6"
                                                style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                Banco Invex, S.A., Instituci&#243;n de Banca </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">

                                        </div>
                                        <div class="col">
                                            <span id="_13.6"
                                                style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                M&#250;ltiple, Invex Grupo Financiero, en su </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">

                                        </div>
                                        <div class="col">
                                            <span id="_13.6"
                                                style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                car&#225;cter de Fiduciario del Fideicomiso F/4870</span>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <span id="_13.6"
                                                style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                ________________________________</span>
                                        </div>
                                        <div class="col">
                                            <span id="_13.6"
                                                style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                ________________________________</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span id="_13.2"
                                                style=" font-family:Arial; font-size:13.2px; color:#000000">
                                                Por: Oscar Samuel Vargas Gonz&#225;lez</span>
                                        </div>
                                        <div class="col">
                                            <span id="_13.2"
                                                style=" font-family:Arial; font-size:13.2px; color:#000000">
                                                Por: Talina Ximena Mora Rojas</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span id="_13.2"
                                                style=" font-family:Arial; font-size:13.2px; color:#000000">
                                                Cargo: Apoderado</span>
                                        </div>
                                        <div class="col">
                                            <span id="_13.2"
                                                style=" font-family:Arial; font-size:13.2px; color:#000000">
                                                Cargo: Apoderado</span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="pos" id="_118:2023" style="top:2023;left:118">
                                    <span id="_11.8" style=" font-family:Arial; font-size:11.8px; color:#000000">
                                        Hoja de firmas del Formato de Anexo al Contrato de Cesi&#243;n de Cr&#233;ditos
                                        &#147;Anexo H&#148;, suscrito al amparo del </span>
                                </div>
                                <div class="pos" id="_118:2038" style="top:2038;left:118">
                                    <span id="_11.8" style=" font-family:Arial; font-size:11.8px; color:#000000">
                                        Contrato de Fideicomiso Irrevocable de Administraci&#243;n F/4870, de fecha 07 de
                                        septiembre de 2023</span>
                                </div>
                                <!--<div class="pos" id="_421:2102" style="top:2102;left:421">
                                                                                                                                            <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                                                                                                            2</span>
                                                                                                                                        </div>-->
                                <div class="pos" id="_118:2119" style="top:2119;left:118">
                                    <span id="_10.9"
                                        style=" font-family:Times New Roman; font-size:10.9px; color:#4c4c4c">
                                        GA #317798v1</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pie del Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="exportarAnexoPromecapPdf(this)"
                        data-id="anexoHdocumento" data-tipo="H">Exportar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ANEXO M PROMECAP -->


    <div class="modal fade" id="anexoMPromecapModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Cabecera del Modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Anexo M PROMECAP</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Contenido del Modal -->
                <div class="modal-body modalAnexo">
                    <div class="modalAnexo">
                        <div id="anexoMdocumentoHoja1">
                            <div class="cent" id="_388:99" style="top:99;left:388">
                                <span id="_13.6"
                                    style="font-weight:bold; font-family:Arial; font-size:13.6px; color:#000000">
                                    <U>A</U><U>n</U><U>e</U><U>x</U><U>o</U><U>
                                    </U><U>&#147;</U><U>M</U><U>&#148;</U></span>
                            </div>
                            <div class="cent" id="_313:132" style="top:132;left:313">
                                <span id="_14.0"
                                    style="font-weight:bold; font-family:Arial; font-size:14.0px; color:#000000">
                                    <U>F</U><U>o</U><U>r</U><U>m</U><U>a</U><U>t</U><U>o</U><U> </U><U>d</U><U>e</U><U>
                                    </U><U>I</U><U>n</U><U>s</U><U>t</U><U>r</U><U>u</U><U>c</U><U>c</U><U>i</U><U>&#243;</U><U>n</U><U>
                                    </U><U>d</U><U>e</U><U> </U><U>P</U><U>a</U><U>g</U><U>o</U></span>
                            </div>
                            <div class="derecha" id="_412:166" style="top:166;left:412">
                                <span id="_13.3" style=" font-family:Arial; font-size:13.3px; color:#000000">
                                    Ciudad de M&#233;xico, M&#233;xico, a 07 de septiembre de 2023</span>
                            </div>
                            <div class="pos" id="_98:202" style="top:202;left:98">
                                <span id="_14.1"
                                    style="font-weight:bold; font-family:Arial; font-size:14.1px; color:#000000">
                                    Banco Invex, S.A., Instituci&#243;n de Banca M&#250;ltiple, Invex Grupo
                                    Financiero,</span>
                            </div>
                            <div class="pos" id="_98:219" style="top:219;left:98">
                                <span id="_14.1"
                                    style="font-weight:bold; font-family:Arial; font-size:14.1px; color:#000000">
                                    En su car&#225;cter de Fiduciario del Fideicomiso F/4870<span
                                        style="font-weight:normal">
                                    </span></span>
                            </div>
                            <div class="pos" id="_98:236" style="top:236;left:98">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    Boulevard Manuel &#193;vila Camacho No. 40, Piso 7</span>
                            </div>
                            <div class="pos" id="_98:253" style="top:253;left:98">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    Colonia Lomas de Chapultepec,</span>
                            </div>
                            <div class="pos" id="_98:269" style="top:269;left:98">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    C.P. 11000, Ciudad de M&#233;xico, M&#233;xico</span>
                            </div>
                            <div class="pos" id="_98:303" style="top:303;left:98">
                                <span id="_13.4"
                                    style="font-weight:bold; font-family:Arial; font-size:13.4px; color:#000000">
                                    Atenci&#243;n:<span style="font-weight:normal"> Samantha Barquera Betancourt y Talina
                                        Ximena Mora Rojas</span></span>
                            </div>
                            <div class="derecha" id="_562:337" style="top:337;left:562">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    <span style="font-weight:bold">
                                        <U>A</U><U>s</U><U>u</U><U>n</U><U>t</U><U>o</U><U>:</U></span><U>
                                    </U><U>F</U><U>i</U><U>d</U><U>e</U><U>i</U><U>c</U><U>o</U><U>m</U><U>i</U><U>s</U><U>o</U><U>
                                    </U><U>F</U><U>/</U><U>4</U><U>8</U><U>7</U><U>0</U>.</span>
                            </div>
                            <div class="pos" id="_98:370" style="top:370;left:98">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    Estimados se&#241;ores, </span>
                            </div>
                            <div class="justif" id="_147:404" style="top:404;left:147">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    Hacemos referencia (i) al contrato de fideicomiso irrevocable de administraci&#243;n y
                                    fuente de pago </span>
                            </div>
                            <div class="justif" id="_98:420" style="top:420;left:98">
                                <span id="_14.0" style=" font-family:Arial; font-size:14.0px; color:#000000">
                                    identificado con el n&#250;mero F/4870 de fecha 8 de abril de 2022, celebrado entre el
                                    Banco
                                    Invex, S.A., </span>
                            </div>
                            <div class="justif" id="_98:437" style="top:437;left:98">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    Instituci&#243;n de Banca M&#250;ltiple, Invex Grupo Financiero, en su car&#225;cter de
                                    fiduciario, CEGE Capital, S.A.P.I. </span>
                            </div>
                            <div class="justif" id="_98:454" style="top:454;left:98">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    de C.V., SOFOM, E.N.R., como Fideicomitente B, Fideicomisario en Segundo Lugar, Custodio
                                    y
                                </span>
                            </div>
                            <div class="justif" id="_98:471" style="top:471;left:98">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    Administrador, Promecade, S.A.P.I. de C.V., SOFOM, E.N.R., como Fideicomitente A y
                                    Fideicomisario en </span>
                            </div>
                            <div class="justif" id="_98:487" style="top:487;left:98">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    Primer Lugar, Administradora de Activos Financieros, S.A., como Administrador Maestro, y
                                    los
                                    se&#241;ores Allan </span>
                            </div>
                            <div class="justif" id="_98:504" style="top:504;left:98">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    Cherem Mizrahi, Emilio Cherem Gamus y Rodrigo San Pedro Fern&#225;ndez, como
                                    Depositarios
                                    (el &#147;<U>C</U><U>o</U><U>n</U><U>t</U><U>r</U><U>a</U><U>t</U><U>o</U><U>
                                    </U><U>d</U><U>e</U> </span>
                            </div>
                            <div class="justif" id="_98:521" style="top:521;left:98">
                                <span id="_13.9" style=" font-family:Arial; font-size:13.9px; color:#000000">
                                    <U>F</U><U>i</U><U>d</U><U>e</U><U>i</U><U>c</U><U>o</U><U>m</U><U>i</U><U>s</U><U>o</U>&#148;).
                                    Los t&#233;rminos con may&#250;scula inicial que se utilicen y no se definan de otra
                                    manera
                                    en el </span>
                            </div>
                            <div class="justif" id="_98:538" style="top:538;left:98">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    presente, tendr&#225;n el significado que se les atribuye en el Contrato
                                    Fideicomiso.</span>
                            </div>
                            <div class="justif" id="_147:571" style="top:571;left:147">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    A ese respecto y en t&#233;rminos de lo dispuesto en el inciso (a) del apartado III de
                                    la
                                    Cl&#225;usula Quinta </span>
                            </div>
                            <div class="justif" id="_98:588" style="top:588;left:98">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    y en el numerales (3), (4) y (5) del apartado I de la Cl&#225;usula Sexta del Contrato
                                    de
                                    Fideicomiso, se emite </span>
                            </div>
                            <div class="justif" id="_98:605" style="top:605;left:98">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    la presente Instrucci&#243;n de Pago, a efecto de:</span>
                            </div>
                            <div class="justif" id="_123:638" style="top:638;left:123">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    1. Hacer del conocimiento del Fiduciario que ha sido aprobada la adquisici&#243;n de los
                                    Cr&#233;ditos a Clientes </span>
                            </div>
                            <div class="justif" id="_148:655" style="top:655;left:148">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    Transferidos que se se&#241;alan en el archivo de Excel identificado con el nombre 84a
                                    Cesi&#243;n de cartera </span>
                            </div>
                            <div class="justif" id="_148:672" style="top:672;left:148">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    de PROMECAP, debidamente entregado por CEGE Capital, S.A. de C.V., SOFOM, E.N.R.,
                                    mediante
                                </span>
                            </div>
                            <div class="justif" id="_148:689" style="top:689;left:148">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    correo electr&#243;nico a las cuentas se&#241;aladas en el Contrato de
                                    Fideicomiso.</span>
                            </div>
                            <div class="" id="_123:722" style="top:722;left:123">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    2. Instruir al Fiduciario para que: </span>
                            </div>
                            <!--<div class="pos" id="_165:756" style="top:756;left:165">
                                                                        <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                                                        i.</span>
                                                                    </div>-->
                            <div class="pos" id="_197:756" style="top:756;left:297">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;i. Pague a CEGE Capital, S.A. de C.V., SOFOM, E.N.R., por
                                    concepto de adquisici&#243;n de los </span>
                            </div>
                            <div class="" id="_197:772" style="top:772;left:197">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    Cr&#233;ditos a Clientes Transferidos que se enlistan en el inciso 1 anterior, mediante
                                </span>
                            </div>
                            <div class="" id="_197:789" style="top:789;left:197">
                                <span id="_12.9" style=" font-family:Arial; font-size:12.9px; color:#000000">
                                    trasferencia electr&#243;nica de fondos a la cuenta de CEGE Capital, S.A. de C.V.,
                                    SOFOM,
                                    E.N.R., </span>
                            </div>
                            <div class="" id="_197:806" style="top:806;left:197">
                                <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                    la cantidad de <a id="anexomaforo"></a> (</span>
                            </div>
                            <div class="" id="_197:823" style="top:823;left:197">
                                <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                    , moneda de curso legal en M&#233;xico), m&#225;s el </span>
                            </div>
                            <div class="" id="_197:839" style="top:839;left:197">
                                <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                    impuesto al valor agregado correspondiente, que en su caso se cause.</span>
                            </div>
                            <!--<div class="" id="_162:873" style="top:873;left:162">
                                                                        <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                                        ii.</span>
                                                                    </div>-->
                            <div class="" id="_197:873" style="top:873;left:197">
                                <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ii. Destine los recursos depositados en la [Cuenta del
                                    Cr&#233;dito / Cuenta de la Reserva de </span>
                            </div>
                            <div class="pos" id="_197:890" style="top:890;left:197">
                                <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                    Efectivo] al pago a que se refiere el numeral i. anterior para efectos de la
                                    adquisici&#243;n de </span>
                            </div>
                            <div class="pos" id="_197:907" style="top:907;left:197">
                                <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                    dichos Cr&#233;ditos a Clientes<span id="_16.4"
                                        style=" font-family:Times New Roman; font-size:16.4px"> </span>
                                    Transferidos.</span>
                            </div>
                            <!--<div class="pos" id="_158:940" style="top:940;left:158">
                                                                        <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                                        iii.</span>
                                                                    </div>-->
                            <div class="pos" id="_197:940" style="top:940;left:197">
                                <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iii. Firme la relaci&#243;n actualizada respectiva del
                                    Contrato de Cesi&#243;n de Cr&#233;ditos que se adjunta </span>
                            </div>
                            <div class="pos" id="_197:957" style="top:957;left:197">
                                <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                    a la presente.</span>
                            </div>
                        </div>
                        <div id="anexoMdocumentoHoja2">


                            <div class="" id="_147:1199" style="top:1199;left:147">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    Sin otro particular, agradezco su atenci&#243;n al presente.</span>
                            </div>
                            <div class="derecha" id="_443:1232" style="top:1232;left:443">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    Atentamente,</span>
                            </div>
                            <div class="derecha" id="_443:1265" style="top:1265;left:443">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    Administrador Maestro</span>
                            </div>
                            <div class="derecha" id="_442:1299" style="top:1299;left:442">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    Administradora de Activos Financieros, S.A.</span>
                            </div>
                            <br>
                            <div class="derecha" id="_443:1349" style="top:1349;left:443">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    ________________________________</span>
                            </div>
                            <div class="derecha" id="_443:1366" style="top:1366;left:443">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    Por: Oscar Ulises Calvo Santos</span>
                            </div>
                            <div class="derecha" id="_442:1383" style="top:1383;left:442">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    Cargo: Apoderado</span>
                            </div>
                            <div class="derecha" id="_442:1416" style="top:1416;left:442">
                                <span id="_13.5" style=" font-family:Arial; font-size:13.5px; color:#000000">
                                    Fideicomitente B</span>
                            </div>
                            <div class="derecha" id="_442:1450" style="top:1450;left:442">
                                <span id="_12.9" style=" font-family:Arial; font-size:12.9px; color:#000000">
                                    CEGE Capital, S.A. de C.V., SOFOM, E.N.R.</span>
                            </div>
                            <br>
                            <div class="derecha" id="_443:1500" style="top:1500;left:443">
                                <span id="_13.3" style=" font-family:Arial; font-size:13.3px; color:#000000">
                                    ________________________________</span>
                            </div>
                            <div class="derecha" id="_443:1517" style="top:1517;left:443">
                                <span id="_13.3" style=" font-family:Arial; font-size:13.3px; color:#000000">
                                    Por: Ana Mar&#237;a del Pilar Aranda Camacho</span>
                            </div>
                            <div class="derecha" id="_442:1534" style="top:1534;left:442">
                                <span id="_13.3" style=" font-family:Arial; font-size:13.3px; color:#000000">
                                    Cargo: Apoderado</span>
                            </div>
                            <div class="derecha" id="_442:1584" style="top:1584;left:442">
                                <span id="_12.9" style=" font-family:Arial; font-size:12.9px; color:#000000">
                                    CEGE Capital, S.A. de C.V., SOFOM, E.N.R.</span>
                            </div>
                            <br>
                            <div class="derecha" id="_443:1634" style="top:1634;left:443">
                                <span id="_13.3" style=" font-family:Arial; font-size:13.3px; color:#000000">
                                    ________________________________</span>
                            </div>
                            <div class="derecha" id="_443:1651" style="top:1651;left:443">
                                <span id="_13.3" style=" font-family:Arial; font-size:13.3px; color:#000000">
                                    Por: Oscar Samuel Vargas Gonz&#225;lez</span>
                            </div>
                            <div class="derecha" id="_443:1668" style="top:1668;left:443">
                                <span id="_13.3" style=" font-family:Arial; font-size:13.3px; color:#000000">
                                    Cargo: Apoderado</span>
                            </div>
                            <br>
                            <br>
                            <div class="pos" id="_98:1835" style="top:1835;left:98">
                                <span id="_12.8" style=" font-family:Arial; font-size:12.8px; color:#000000">
                                    LA PRESENTE HOJA DE FIRMAS PERTENECE A LA INSTRUCCI&#211;N DE PAGO AL FIDEICOMISO
                                </span>
                            </div>
                            <div class="pos" id="_98:1852" style="top:1852;left:98">
                                <span id="_12.8" style=" font-family:Arial; font-size:12.8px; color:#000000">
                                    IRREVOCABLE DE ADMINISTRACI&#211;N Y FUENTE DE PAGO NUMERO 4870 EMITIDA CON FECHA 07 DE
                                </span>
                            </div>
                            <div class="pos" id="_98:1869" style="top:1869;left:98">
                                <span id="_12.8" style=" font-family:Arial; font-size:12.8px; color:#000000">
                                    SEPTIEMBRE DE 2023</span>
                            </div>
                            <div class="pos" id="_98:1953" style="top:1953;left:98">
                                <span id="_14.4"
                                    style="font-style:italic; font-family:Arial; font-size:14.4px; color:#000000">
                                    [<span style="font-weight:bold"> Cc:</span></span>
                            </div>
                            <div class="pos" id="_98:1986" style="top:1986;left:98">
                                <span id="_14.0"
                                    style="font-weight:bold;font-style:italic; font-family:Arial; font-size:14.0px; color:#000000">
                                    Fideicomitente A</span>
                            </div>
                            <div class="pos" id="_98:2003" style="top:2003;left:98">
                                <span id="_13.4"
                                    style="font-style:italic; font-family:Arial; font-size:13.4px; color:#000000">
                                    Promecade, S.A.P.I. de C.V., SOFOM, E.N.R.</span>
                            </div>
                            <div class="pos" id="_98:2037" style="top:2037;left:98">
                                <span id="_14.0"
                                    style="font-weight:bold;font-style:italic; font-family:Arial; font-size:14.0px; color:#000000">
                                    Administrador</span>
                            </div>
                            <div class="pos" id="_98:2053" style="top:2053;left:98">
                                <span id="_13.3"
                                    style="font-style:italic; font-family:Arial; font-size:13.3px; color:#000000">
                                    CEGE Capital, S.A. de C.V., SOFOM, E.N.R.]</span>
                            </div>
                            <!--<div class="pos" id="_421:2102" style="top:2102;left:421">
                                                                        <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                                                        2</span>
                                                                    </div>-->
                            <div class="pos" id="_98:2119" style="top:2119;left:98">
                                <span id="_10.9"
                                    style=" font-family:Times New Roman; font-size:10.9px; color:#4c4c4c">
                                    GA #317798v1</span>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Pie del Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        onclick="exportarAnexoPromecapPdf(this)"data-id="anexoMdocumento"
                        data-tipo="M">Exportar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ANEXO O PROMECAP -->

    <div class="modal fade" id="anexoOPromecapModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Cabecera del Modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Anexo O PROMECAP</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Contenido del Modal -->
                <div class="modal-body modalAnexo">
                    <div class="modalAnexo" id="anexoOdocumento">
                        <div id="anexoOdocumentoHoja1">
                            <div class="cent" id="_389:69" style="top:69;left:389">
                                <a href="#" id="_13.6"
                                    style="text-decoration: underline; font-weight: bold; font-family: Arial; font-size: 13.6px; color: #000000">
                                    Anexo O
                                </a>
                            </div>
                            <div class="cent" id="_229:103" style="top:103;left:229">
                                <a href="#" id="_13.6"
                                    style="text-decoration: underline; font-weight: bold; font-family: Arial; font-size: 13.6px; color: #000000">
                                    Formato de Relación de Créditos a Clientes Transferidos
                                </a>
                            </div>
                            <div class="derecha" id="_412:136" style="top:136;left:412">
                                <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                    Ciudad de M&#233;xico, M&#233;xico, a 07 de septiembre de 2023
                                </span>
                            </div>
                            <div class="" id="_98:170" style="top:170;left:98">
                                <span id="_13.6"
                                    style="font-weight:bold; font-family:Arial; font-size:13.6px; color:#000000">
                                    Administradora de Activos Financieros, S.A.,
                                </span>
                            </div>
                            <div class="" id="_98:186" style="top:186;left:98">
                                <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                    Av Insurgentes Sur No. 1647, Oficina 420
                                </span>
                            </div>
                            <div class="" id="_98:203" style="top:203;left:98">
                                <span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
                                    Colonia San Jos&#233; Insurgentes,
                                </span>
                            </div>
                            <div class="" id="_98:220" style="top:220;left:98">
                                <span id="_13.2" style=" font-family:Arial; font-size:13.2px; color:#000000">
                                    C.P. 03900, Ciudad de M&#233;xico, M&#233;xico
                                </span>
                            </div>
                            <div class="" id="_98:237" style="top:237;left:98">
                                <span id="_13.2" style=" font-family:Arial; font-size:13.2px; color:#000000">
                                    Tel. (5255) 8000 8189
                                </span>
                            </div>
                            <div class="" id="_98:253" style="top:253;left:98">
                                <span id="_13.2" style=" font-family:Arial; font-size:13.2px; color:#000000">
                                    Correo electr&#243;nico: ucalvo@acfin.com
                                </span>
                            </div>
                            <div class="" id="_98:270" style="top:270;left:98">
                                <span id="_13.2" style=" font-family:Arial; font-size:13.2px; color:#000000">
                                    Atenci&#243;n: Ulises Calvo
                                </span>
                            </div>
                            <div class="derecha" id="_420:304" style="top:304;left:420">
                                <a href="#" id="_13.2"
                                    style="text-decoration: underline; font-weight: bold; font-family: Arial; font-size: 13.2px; color: #000000">
                                    Asunto: <span style="font-weight: normal">
                                        Relación de Créditos a Clientes Transferidos.
                                    </span>
                                </a>

                            </div>
                            <div class="" id="_98:337" style="top:337;left:98">
                                <span id="_13.2" style=" font-family:Arial; font-size:13.2px; color:#000000">
                                    Estimados se&#241;ores,
                                </span>
                            </div>

                            <div class="justif" id="_147:371" style="top:371;left:147">
                                <span id="_13.7" style=" font-family:Arial; font-size:13.7px; color:#000000">
                                    Hacemos referencia (i) al contrato de fideicomiso irrevocable de administraci&#243;n y
                                    fuente de pago
                                </span>
                            </div>
                            <div class="justif" id="_98:388" style="top:388;left:98">
                                <span id="_13.7" style=" font-family:Arial; font-size:13.7px; color:#000000">
                                    identificado con el n&#250;mero F/4870 de fecha 8 de abril de 2022, celebrado entre el
                                    Banco Invex, S.A.,
                                </span>
                            </div>
                            <div class="justif" id="_98:404" style="top:404;left:98">
                                <span id="_13.7" style=" font-family:Arial; font-size:13.7px; color:#000000">
                                    Instituci&#243;n de Banca M&#250;ltiple, Invex Grupo Financiero, en su car&#225;cter de
                                    fiduciario, CEGE Capital, S.A.P.I.
                                </span>
                            </div>
                            <div class="justif" id="_98:421" style="top:421;left:98">
                                <span id="_13.7" style=" font-family:Arial; font-size:13.7px; color:#000000">
                                    de C.V., SOFOM, E.N.R., como Fideicomitente B, Fideicomisario en Segundo Lugar, Custodio
                                    y
                                </span>
                            </div>
                            <div class="justif" id="_98:438" style="top:438;left:98">
                                <span id="_13.7" style=" font-family:Arial; font-size:13.7px; color:#000000">
                                    Administrador, Promecade, S.A.P.I. de C.V., SOFOM, E.N.R., como Fideicomitente A y
                                    Fideicomisario en
                                </span>
                            </div>
                            <div class="justif" id="_98:455" style="top:455;left:98">
                                <span id="_13.3" style=" font-family:Arial; font-size:13.3px; color:#000000">
                                    Primer Lugar, Administradora de Activos Financieros, S.A., como Administrador Maestro, y
                                    los se&#241;ores Allan
                                </span>
                            </div>
                            <div class="justif" id="_98:471" style="top:471;left:98">
                                <span id="_13.3" style=" font-family:Arial; font-size:13.3px; color:#000000">
                                    Cherem Mizrahi, Emilio Cherem Gamus y Rodrigo San Pedro Fern&#225;ndez, como
                                    Depositarios (el
                                </span>
                            </div>
                            <div class="pos" id="_98:488" style="top:488;left:98">
                                <a href="#" id="_13.3"
                                    style="text-decoration: underline; font-family: Arial; font-size: 13.3px; color: #000000">
                                    "&#147;Fideicomiso&#148;).
                                </a>

                            </div>
                            <div class="justif" id="_147:522" style="top:522;left:147">
                                <span id="_13.3" style=" font-family:Arial; font-size:13.3px; color:#000000">
                                    Los t&#233;rminos con may&#250;scula inicial que se utilicen y no se definan de otra
                                    manera en el presente,
                                </span>
                            </div>
                            <div class="justif" id="_98:538" style="top:538;left:98">
                                <span id="_13.3" style=" font-family:Arial; font-size:13.3px; color:#000000">
                                    tendr&#225;n el significado que se les atribuye en el Fideicomiso.
                                </span>
                            </div>
                            <div class="justif" id="_147:572" style="top:572;left:147">
                                <span id="_14.0" style=" font-family:Arial; font-size:14.0px; color:#000000">
                                    Por medio de la presente y en t&#233;rminos de lo dispuesto en el numeral (1) del
                                    apartado I de la
                                </span>
                            </div>
                            <div class="justif" id="_98:589" style="top:589;left:98">
                                <span id="_14.0" style=" font-family:Arial; font-size:14.0px; color:#000000">
                                    Cl&#225;usula Sexta del Fideicomiso, mediante correo electr&#243;nico a las cuentas
                                    se&#241;aladas en el Contrato de
                                </span>
                            </div>
                            <div class="justif" id="_98:605" style="top:605;left:98">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    Fideicomiso, se entrega la relaci&#243;n de Cr&#233;ditos a Clientes Transferidos,
                                    actualizada al 05 de septiembre de
                                </span>
                            </div>
                            <div class="justif" id="_98:622" style="top:622;left:98">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    2023.
                                </span>
                            </div>
                            <div class="cent" id="_328:656" style="top:656;left:328">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    Cr&#233;ditos a Clientes Transferidos
                                </span>
                            </div>
                            <div class="justif" id="_98:706" style="top:706;left:98">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    El presente Anexo A deber&#225; incluir adem&#225;s las siguientes columnas: (i) el
                                    saldo insoluto total de intereses
                                </span>
                            </div>
                        </div>
                        <div id="anexoOdocumentoHoja2">
                            <div class="justif" id="_98:723" style="top:723;left:98">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    ordinarios por devengar de la l&#237;nea de cr&#233;dito a la fecha, (ii) el saldo total
                                    de Impuesto al Valor Agregado
                                </span>
                            </div>
                            <div class="justif" id="_98:740" style="top:740;left:98">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    sobre intereses ordinarios por devengar de la l&#237;nea de cr&#233;dito a la fecha,
                                    (iii) el n&#250;mero total de parcialidades
                                </span>
                            </div>
                            <div class="justif" id="_98:756" style="top:756;left:98">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    restantes de la l&#237;nea de cr&#233;dito a la fecha, (iv) la periodicidad de pago (en
                                    caso de no ser quincenal), (v) el
                                </span>
                            </div>
                            <div class="justif" id="_98:773" style="top:773;left:98">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    monto de cada parcialidad restante y (vi) la fecha de cada parcialidad restante.
                                </span>
                            </div>
                            <br>
                            <div class="cent" id="_383:823" style="top:823;left:383">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    Atentamente,
                                </span>
                            </div>
                            <div class="cent" id="_374:840" style="top:840;left:374">
                                <span id="_13.4" style=" font-family:Arial; font-size:13.4px; color:#000000">
                                    Fideicomitente B
                                </span>
                            </div>
                            <div class="cent" id="_283:857" style="top:857;left:283">
                                <span id="_12.9" style=" font-family:Arial; font-size:12.9px; color:#000000">
                                    CEGE Capital, S.A.P.I. de C.V., SOFOM, E.N.R.
                                </span>
                            </div>
                            <br>
                            {{-- AJUSTE tabla --}}
                            <div style=" font-family:Times New Roman; font-size:13.4px; color:#000000">
                                <div class="row">
                                    <div class="col">
                                        ___________________________________
                                    </div>
                                    <div class="col">
                                        ___________________________________
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        Nombre: Ana Mar&#237;a del Pilar Aranda Camacho
                                    </div>
                                    <div class="col">
                                        Nombre: Oscar Samuel Vargas Gonz&#225;lez
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        Cargo: Apoderado
                                    </div>
                                    <div class="col">
                                        Cargo: Apoderado
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pie del Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="exportarAnexoPromecapPdf(this)"
                        data-id="anexoOdocumento" data-tipo="O">Exportar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>




@stop

@section('css')
    <style>
        .section {
            border-bottom: 1px solid #034383;
            padding: 20px;
            align-content: center;
        }

        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 320px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        input[type="number"] {
            min-width: 50px;
        }

        /* Estilos para el modal */
        .modal {
            display: none;
            /* Por defecto, ocultar el modal */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Fondo semi-transparente */
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }

        /* Estilos para el botón de cerrar el modal */
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .modalAnexo {
            font-family: Arial;
            font-size: 18.5px
        }

        .cent {
            text-align: center;
            z-index: 0;
            left: 0px;
            top: 0px
        }

        .derecha {
            text-align: right;
        }

        .justif {
            text-align-last: justify;
        }

        .container {
            max-width: 1200px !important;
        }
    </style>

@stop

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    {{-- LIBRERIAS DATATABLE --}}
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/dataRender/datetime.js"></script>
    {{-- LIBRERIAS HIGHCHARTS --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    {{-- LIBRERIAS PDF --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"
        integrity="sha512-w3u9q/DeneCSwUDjhiMNibTRh/1i/gScBVp2imNVAMCt6cUHIw6xzhzcPFIaL3Q1EbI2l+nu17q2aLJJLo4ZYg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- LIBRERIA EXCEL --}}

    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.17.0/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"
        integrity="sha512-csNcFYJniKjJxRWRV1R7fvnXrycHP6qDR21mgz1ZP55xY5d+aHLfo9/FcGDQLfn2IfngbAHd8LdfsagcCqgTcQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var jsonjucavi = [];
        var jsonmambu = [];
        $(document).ready(function() {


            // JavaScript para manejar el modal
            $('#anexoHPromecapAbrir').on('shown.bs.modal', function() {
                $('#anexoHPromecapModal').trigger('focus')
            })



            var type = @json($type);
            if (type == '3') {
                $('a:contains("Cuentas")').hide();
                console.log('Se oculta');
            }


            //    generarGraficasJucaviour();
            montoaseguradomambu = 0;

            montoaseguradojucavi = 0;

            $.blockUI({
                message: 'Cargando...',
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: 'rgba(0, 0, 0, 0.5)',
                    color: '#fff',
                    'border-radius': '5px',
                    fontSize: '18px',
                    fontWeight: 'bold',
                }
            });

            calculofondeadorpromecap();

            calculosohmambu();

            calculosohjucavi();

            historicoaforopromecap();



            $('#exportarcreditospromecap').click(function() {
                // Bloquea la pantalla
                $.blockUI({
                    message: 'Cargando...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: 'rgba(0, 0, 0, 0.5)',
                        color: '#fff',
                        'border-radius': '5px',
                        fontSize: '18px',
                        fontWeight: 'bold',
                    }
                });

                // Realiza la petición AJAX
                $.ajax({
                    url: "get_creditos_promecap_aforo",
                    method: "GET",
                    dataType: "JSON",
                    data: {},
                    success: function(data) {
                        console.log(data);
                        //if ('success' in data) {

                        var workbook = XLSX.utils.book_new();

                        var fechaActual =
                            getdateformatted(); // Crea un objeto Date con la fecha y hora actuales

                        nameWorkbook = 'PROMECAP ' +
                            fechaActual;

                        // Convertir JSON1 a una hoja de cálculo
                        var worksheet1 = XLSX.utils.json_to_sheet(
                            data);
                        XLSX.utils.book_append_sheet(workbook, worksheet1,
                            nameWorkbook
                        );
                        // Generar el archivo Excel
                        var excelBuffer = XLSX.write(workbook, {
                            bookType: 'xlsx',
                            type: 'array'
                        });
                        var blob = new Blob([excelBuffer], {
                            type: 'application/octet-stream'
                        });

                        saveAs(blob, nameWorkbook + '.xlsx');

                        // Desbloquea la pantalla después de que se complete la petición
                        $.unblockUI();
                        Swal.fire(
                            '¡Gracias por esperar!',
                            data["success"],
                            'success'
                        )
                        //}
                    },
                    error: function(data) {
                        // Desbloquea la pantalla después de que se complete la petición
                        $.unblockUI();
                        Swal.fire({
                            icon: 'error',
                            title: 'Encontramos un error...',
                            text: data["responseJSON"]["error"],
                        });
                    }
                });
            });


        });

        function calculosohjucavi() {
            $.ajax({
                url: "testsohrep",
                method: "GET",
                dataType: "JSON",
                data: {
                    /* date: dateVal */
                },

                success: function(fondeadoresjucavi) {
                    jsonjucavi = fondeadoresjucavi;
                    tmpfondeadoresjucavi = [];
                    total = 0;
                    fondeadoresjucavi.forEach(element => {
                        var numero = parseFloat(element.monto);
                        total += numero;
                    });
                    totalFormateado = total.toLocaleString('en-US');
                    fondeadoresjucavi.forEach(element => {
                        porcentaje = (element.monto * 100) / total;
                        porcentajeFormateado = parseFloat(porcentaje.toFixed(2));
                        cantidadFormateado = parseFloat(element.cantidadregistros);
                        montoFormateado = parseFloat(element.monto);
                        montoFormateado = montoFormateado.toLocaleString('en-US');

                        tmpfondeadoresjucavi.push({
                            name: element.nombrefondeador,
                            y: porcentajeFormateado,
                            cantidad: cantidadFormateado,
                            monto: montoFormateado
                        });

                    });
                    series = [];
                    series.push({
                        name: 'Fondeador',
                        colorByPoint: true,
                        data: tmpfondeadoresjucavi
                    });
                    graficaPastel(series, 'container-jucavi');
                    datosgenerales();
                }
            });

        }

        function calculosohmambu() {
            $.ajax({
                url: "sohmambu",
                method: "GET",
                dataType: "JSON",
                data: {
                    /* date: dateVal */
                },
                success: function(fondeadoresmambu) {
                    jsonmambu = fondeadoresmambu;
                    tmpfondeadoresmambu = [];
                    total = 0;
                    fondeadoresmambu.forEach(element => {
                        var numero = parseFloat(element.monto);
                        total += numero;
                    });
                    totalFormateado = total.toLocaleString('en-US');
                    fondeadoresmambu.forEach(element => {
                        porcentaje = (element.monto * 100) / total;
                        porcentajeFormateado = parseFloat(porcentaje.toFixed(2));
                        cantidadFormateado = parseFloat(element.cantidadregistros);
                        montoFormateado = parseFloat(element.monto);
                        montoFormateado = montoFormateado.toLocaleString('en-US');

                        tmpfondeadoresmambu.push({
                            name: element.nombrefondeador,
                            y: porcentajeFormateado,
                            cantidad: cantidadFormateado,
                            monto: montoFormateado
                        });

                    });
                    series = [];
                    series.push({
                        name: 'Fondeador',
                        colorByPoint: true,
                        data: tmpfondeadoresmambu
                    });
                    graficaPastel(series, 'container-mambu');

                }
            });

        }


        function datosgenerales() {
            // Actuales
            actualjucavipromecap = 0;
            actualjucaviblao = 0;


            actualmambupromecap = 0;
            actualmambublao = 0;
            actualmambumintos = 0;

            // Cantidades
            cantidadjucavipromecap = 0;
            cantidadjucaviblao = 0;

            cantidadmambupromecap = 0;
            cantidadmambublao = 0;
            cantidadmambumintos = 0;

            jsonjucavi.forEach(element => {
                switch (element.nombrefondeador) {
                    case "Promecap":
                        $('#valoractualjucavipromecap').text("$" + parseFloat(element.monto).toLocaleString('en-US'));
                        actualjucavipromecap += parseFloat(element.monto);
                        $('#cantidadactualjucavipromecap').text(parseFloat(element.cantidadregistros)
                            .toLocaleString('en-US'));
                        cantidadjucavipromecap = element.cantidadregistros;
                        break;
                    case "BLAO":
                        $('#valoractualjucaviblao').text("$" + parseFloat(element.monto).toLocaleString('en-US'));
                        actualjucaviblao += parseFloat(element.monto);
                        $('#cantidadactualjucaviblao').text(parseFloat(element.cantidadregistros).toLocaleString('en-US'));
                        cantidadjucaviblao = element.cantidadregistros;
                        break;
                }
            });
            jsonmambu.forEach(element => {
                switch (element.nombrefondeador) {
                    case "PROMECAP":
                        $('#valoractualmambupromecap').text("$" + parseFloat(element.monto).toLocaleString('en-US'));
                        actualmambupromecap += parseFloat(element.monto);
                        $('#cantidadactualmambupromecap').text(parseFloat(element.cantidadregistros)
                            .toLocaleString('en-US'));
                        cantidadmambupromecap = element.cantidadregistros;
                        break;
                    case "BLAO":
                        $('#valoractualmambublao').text("$" + parseFloat(element.monto).toLocaleString('en-US'));
                        actualmambublao += parseFloat(element.monto);
                        $('#cantidadactualmambublao').text(parseFloat(element.cantidadregistros).toLocaleString('en-US'));
                        cantidadmambublao = element.cantidadregistros;
                        break;
                    case "MINTOS":
                        $('#valoractualmambumintos').text("$" + parseFloat(element.monto).toLocaleString('en-US'));
                        actualmambumintos += parseFloat(element.monto);
                        $('#cantidadactualmambumintos').text(parseFloat(element.cantidadregistros)
                            .toLocaleString('en-US'));
                        cantidadmambumintos = element.cantidadregistros;
                        $('#sumacantidadactualmintos').text(parseFloat(element.cantidadregistros).toLocaleString('en-US'));

                        break;
                }
            });

            sumavalorpromecap = actualjucavipromecap + actualmambupromecap;
            sumavalorblao = actualjucaviblao + actualmambublao;

            sumacantidadpromecap = cantidadjucavipromecap + cantidadmambupromecap;
            sumacantidadblao = cantidadjucaviblao + cantidadmambublao;



            $('#valoractualsumapromecap').text("$" + parseFloat(sumavalorpromecap).toLocaleString('en-US'));



            $('#valoractualsumablao').text("$" + parseFloat(sumavalorblao).toLocaleString('en-US'));
            $('#valoractualsumamintos').text("$" + parseFloat(actualmambumintos).toLocaleString('en-US'));

            $('#sumacantidadactualpromecap').text(parseFloat(sumacantidadpromecap).toLocaleString('en-US'));
            $('#sumacantidadactualblao').text(parseFloat(sumacantidadblao).toLocaleString('en-US'));


            vdb = 153173700.00 - sumavalorblao;

            var valorOriginal = $('#aforocalpromecap').text();

            // Eliminar el signo de dólar y las comas
            var valorLimpio = valorOriginal.replace(/\$|,/g, '');

            // Convertir la cadena en un número de punto flotante
            aforopromecap = parseFloat(valorLimpio);



            vdp = aforopromecap - sumavalorpromecap;
            $('#valordiferenciapromecap').text("$" + parseFloat(vdp).toLocaleString('en-US'));
            $('#valordiferenciablao').text("$" + parseFloat(vdb).toLocaleString('en-US'));


        }

        function graficaPastel(series, idcontainer) {

            // Data retrieved from https://netmarketshare.com
            Highcharts.chart(idcontainer, {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Creditos por fondeador del día anterior',
                    align: 'left'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    series: {
                        borderRadius: 5,
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}: {point.y:.1f}%, Monto: {point.monto:.1f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">Porcentaje:  <b>{point.percentage:.1f}%</b></span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.cantidad}</b><br/>'
                },
                series: series
            });


        }

        function generarGraficasJucavi() {
            fondeadoresjucavi = [];
            // Bloquea la pantalla

            $("#soh").dataTable().fnDestroy();
            // Realiza la petición AJAX
            $.ajax({
                url: "testsohrep",
                method: "GET",
                dataType: "JSON",
                data: {
                    /* date: dateVal */
                },

                success: function(data) {
                    var encontrado = false;
                    var valu = "";
                    data.forEach(element => {
                        var longitud = Object.keys(element).length;
                        for (var key in element) {
                            if (element[key] == null)
                                element[key] = "-";
                            if (key == "NombreFondeador") {
                                encontrado = false;
                                valu = element[key];
                                // Recorrer cada objeto en el arreglo
                                for (var i = 0; i < fondeadoresjucavi.length; i++) {
                                    if (fondeadoresjucavi[i].NombreFondeador === valu) {
                                        encontrado = true;
                                        break;
                                    }
                                }
                                if (encontrado == false) {
                                    json = {
                                        NombreFondeador: valu,
                                        cantidad: 1
                                    }
                                    fondeadoresjucavi.push(json)
                                } else {
                                    fondeadoresjucavi.forEach(element => {
                                        if (element.NombreFondeador == valu)
                                            element.cantidad += 1;
                                    });
                                }
                            }
                        }
                    });

                    var total = 0;
                    fondeadoresjucavi.forEach(element => {
                        total += element.cantidad;
                    });
                    tmpfondeadoresjucavi = [];
                    fondeadoresjucavi.forEach(element => {
                        porcentaje = (element.cantidad * 100) / total;
                        tmpfondeadoresjucavi.push({
                            name: element.NombreFondeador,
                            y: porcentaje,
                            cantidad: element.cantidad,
                        });

                    });
                    series = [];
                    series.push({
                        name: 'Fondeador',
                        colorByPoint: true,
                        data: tmpfondeadoresjucavi

                    });
                    $('#totalcreditosJucavi').after('<div class="col">' + total + '</div>');
                    graficaPastel(series, 'container-jucavi');

                    if (data.length > 0) {

                    } else {
                        Swal.fire({
                            title: '¡Sin información!',
                            text: "No se encontraron registros en la fecha indicada",
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Maneja los errores de la petición AJAX...

                    // Desbloquea la pantalla después de que se complete la petición
                    $.unblockUI();

                    // Muestra un mensaje de error
                    Swal.fire({
                        title: 'Error',
                        text: 'Algo salió mal. Vuelve a intentarlo.' + errorThrown,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                },
            });



        }

        function generarGraficasMambu() {
            fondeadoresmambu = [];
            let dataJson;
            $.ajax({
                url: "sohmambu",
                method: "GET",
                dataType: "JSON",
                data: {},
                success: function(data) {


                    dataJson = reemplazarValoresVacios(data);

                    dataJson.forEach(element => {
                        element.montosegurofinanciado
                        for (var key in element) {
                            if (element[key] == null)
                                element[key] = "-";
                            if (key == "fondeador") {
                                encontrado = false;
                                valu = element[key];
                                // Recorrer cada objeto en el arreglo
                                for (var i = 0; i < fondeadoresmambu.length; i++) {
                                    if (fondeadoresmambu[i].NombreFondeador === valu) {
                                        encontrado = true;
                                        break;
                                    }
                                }
                                if (encontrado == false) {
                                    json = {
                                        NombreFondeador: valu,
                                        cantidad: 1
                                    }
                                    fondeadoresmambu.push(json)
                                } else {
                                    fondeadoresmambu.forEach(element => {
                                        if (element.NombreFondeador == valu)
                                            element.cantidad += 1;
                                    });
                                }
                            }
                        }
                    });


                    var total = 0;
                    fondeadoresmambu.forEach(element => {
                        total += element.cantidad;
                    });
                    tmpfondeadoresmambu = [];
                    fondeadoresmambu.forEach(element => {
                        porcentaje = (element.cantidad * 100) / total;
                        tmpfondeadoresmambu.push({
                            name: element.NombreFondeador,
                            y: porcentaje,
                            cantidad: element.cantidad,
                        });

                    });
                    series = [];
                    series.push({
                        name: 'Fondeador',
                        colorByPoint: true,
                        data: tmpfondeadoresmambu

                    });

                    $('#totalcreditosMambu').after('<div class="col">' + total + '</div>');


                    graficaPastel(series, 'container-mambu');

                    datosgenerales();

                    Swal.fire({
                        title: 'Gracias por esperar',
                        text: 'El reporte ha sido generado correctamente',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });

                },
                error: function(xhr, status, error) {
                    $.unblockUI();
                    console.log(
                        error); // Muestra cualquier error en la consola para depuración

                }
            });
        }


        function reemplazarValoresVacios(obj) {
            for (var key in obj) {
                if (obj.hasOwnProperty(key)) {
                    if (typeof obj[key] === "object" && obj[key] !== null) {
                        // Si el valor es otro objeto, realizar la recursión y actualizar el valor en el objeto actual
                        obj[key] = reemplazarValoresVacios(obj[key]);
                    } else if (obj[key] === "" || obj[key] === null) {
                        // Si el valor es una cadena vacía, reemplazar por un guion y actualizar el valor en el objeto actual
                        obj[key] = "-";
                    }
                }
            }
            return obj; // Devolver el objeto actualizado
        }


        function exportarAnexoPromecapPdf(button) {

            $.blockUI({
                message: 'Cargando...',
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: 'rgba(0, 0, 0, 0.5)',
                    color: '#fff',
                    'border-radius': '5px',
                    fontSize: '18px',
                    fontWeight: 'bold',
                }
            });
            const id = button.getAttribute('data-id');
            const tipoAnexo = button.getAttribute('data-tipo');

            // Obtener la fecha actual
            const today = new Date();
            const day = today.getDate();
            const year = today.getFullYear();
            const name = "ANEXO " + tipoAnexo + " " + day.toString() + " - " + year.toString() + ".pdf";
            const pdf = new jsPDF();

            if (tipoAnexo == "H" || tipoAnexo == "M") {
                // HOJA 1
                var hoja1 = "#" + id + "Hoja1";
                var divContent1 = document.querySelector(hoja1);

                // Convertir el contenido del cuerpo a una imagen utilizando html2canvas
                html2canvas(divContent1).then(canvas => {
                    const imgData = canvas.toDataURL('image/jpeg', 1.0);

                    // Agregar la imagen al PDF
                    pdf.addImage(imgData, 'JPEG', 15, 15, 180, 0);

                    // HOJA 2
                    var hoja2 = "#" + id + "Hoja2";
                    var divContent2 = document.querySelector(hoja2);

                    // Convertir el contenido del cuerpo a una imagen utilizando html2canvas
                    html2canvas(divContent2).then(canvas => {
                        const imgData2 = canvas.toDataURL('image/jpeg', 1.0);

                        // Agregar la imagen de la segunda hoja al PDF
                        pdf.addPage(); // Agregar una nueva página
                        pdf.addImage(imgData2, 'JPEG', 15, 15, 180, 0);

                        // Descargar el PDF con el nombre especificado
                        pdf.save(name);
                        $.unblockUI();
                    });
                });
            } else {
                const divContent = document.querySelector("#" + id);

                // Convertir el contenido del cuerpo a una imagen utilizando html2canvas
                html2canvas(divContent).then(canvas => {
                    const imgData = canvas.toDataURL('image/jpeg', 1.0);

                    // Agregar la imagen al PDF
                    pdf.addImage(imgData, 'JPEG', 15, 15, 180, 0);

                    // Descargar el PDF con el nombre especificado
                    pdf.save(name);
                    $.unblockUI();
                });
            }
        }


        function exportarAnexoPromecapWord() {

            // Obtener el contenido del cuerpo HTML
            const divContent = document.querySelector('#anexoHdocumento');

            // Obtener el día y año actual
            const today = new Date();
            const day = today.getDate();
            const year = today.getFullYear();

            // Nombre del archivo
            const fileName = `ANEXO O ${day} - ${year}.docx`;

            // Obtener el contenido HTML como texto
            const htmlContent = divContent.innerHTML;

            // Utilizar Mammoth.js para convertir el HTML a formato de Word (docx)
            mammoth.convertToHtml(htmlContent)
                .then(result => {
                    // Crear un Blob con el contenido del documento de Word
                    const blob = new Blob([result.value], {
                        type: 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    });

                    // Crear un enlace para descargar el archivo
                    const a = document.createElement('a');
                    a.href = URL.createObjectURL(blob);
                    a.download = fileName;

                    // Simular un clic en el enlace para iniciar la descarga
                    a.click();
                })
                .catch(error => {
                    console.error('Error al convertir a Word:', error);
                });
        }

        function calculofondeadorpromecap() {

            $.ajax({
                url: "calculofondeadorpromecap",
                method: "GET",
                dataType: "JSON",
                data: {
                    /* date: dateVal */
                },
                success: function(aforocalcpromecap) {

                    console.log(aforocalcpromecap);
                    $('#aforocalpromecap').text("$" + parseFloat(aforocalcpromecap).toLocaleString('en-US'));
                    aforopromecap = aforocalcpromecap;
                    $('#anexohaforo').text("$" + parseFloat(aforocalcpromecap).toLocaleString('en-US'));
                    $('#anexomaforo').text("$" + parseFloat(aforocalcpromecap).toLocaleString('en-US'));
                    $.unblockUI();
                }
            });
        }

        function historicoaforopromecap() {
            $.ajax({
                url: "historicoaforopromecap",
                method: "GET",
                dataType: "JSON",
                data: {
                    /* date: dateVal */
                },
                success: function(aforocalcpromecap) {

                    aforocalcpromecap.forEach(element => {
                        console.log(element);
                        element.fecha = element.fecha.split(' ')[0];
                        element.aforo = parseFloat(element.aforo).toLocaleString('en-US');
                    });
                    $('#tablahistoricopromecap').DataTable({
                        destroy: true,
                        scrollCollapse: true,
                        language: {
                            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                            "lengthMenu": "Mostrar los _MENU_ registros",
                            "zeroRecords": "No existe ese registro",
                            "info": "Mostrar página _PAGE_ de _PAGES_",
                            "infoEmpty": "No encontrado",
                            "infoFiltered": "(filtrado de _MAX_ registros en total)",
                            "sSearch": "Buscar:",
                            "sEmptyTable": "No se encontraron registros",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "Siguiente",
                                "sPrevious": "Anterior"
                            }
                        },
                        dom: 'Blfrtip',
                        buttons: [],
                        destroy: true,
                        processing: true,
                        sort: true,
                        paging: true,
                        autoWidth: true,
                        data: aforocalcpromecap,
                        columns: [{
                                data: 'fecha'
                            },
                            {
                                data: 'aforo'
                            },
                        ]
                    });
                }
            });
        }

        function getdateformatted() {

            var fechaActual = new Date();
            var dia = fechaActual.getDate();
            var mes = fechaActual.getMonth() + 1; // Los meses van de 0 a 11, por lo que se suma 1
            var año = fechaActual.getFullYear();
            var horas = fechaActual.getHours();
            var minutos = fechaActual.getMinutes();

            // Asegurar que los valores tengan siempre dos dígitos
            dia = (dia < 10) ? '0' + dia : dia;
            mes = (mes < 10) ? '0' + mes : mes;
            horas = (horas < 10) ? '0' + horas : horas;
            minutos = (minutos < 10) ? '0' + minutos : minutos;

            var fechaFormateada = dia + '-' + mes + '-' + año + ' ' + horas + ':' + minutos;
            return fechaFormateada;

        }
    </script>
@stop
