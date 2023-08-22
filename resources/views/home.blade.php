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
        <div class="card-body">
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

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Promecap</th>
                            <td id="valoraforopromecap"> $376,805,000.05</td>
                            <td id="valoractualjucavipromecap">Valor Actual jucavi promecap</td>
                            <td id="valoractualmambupromecap">Valor Actual mambu promecap</td>
                            <td id="valoractualsumapromecap">Valor Actual suma promecap</td>
                            <td id="valordiferenciapromecap">Valor Diferencia Promecap</td>
                            <td id="cantidadactualjucavipromecap">Cantidad actual jucavi Promecap</td>
                            <td id="cantidadactualmambupromecap">Cantidad actual mambu Promecap</td>
                            <td id="sumacantidadactualpromecap">Suma cantidad Promecap</td>
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
                        </tr>
                        <tr>
                            <th>Mintos</th>
                            <td id="valoraforomintos">-</td>
                            <td id="valoractualjucavimintos">-</td>
                            <td id="valoractualmambumintos">Valor Actual mambu mintos</td>
                            <td id="valoractualsumamintos">Valor Actual suma mintos</td>
                            <td id="valordiferenciamintos">-</td>
                            <td id="cantidadactualjucavimintos">-</td>
                            <td id="cantidadactualmambumintos">Cantidad actual mambu mintos</td>
                            <td id="sumacantidadactualmintos">Suma cantidad mintos</td>
                        </tr>
                    </tbody>
                </table>


            </div>

            <br>
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


            {{-- <div class="section">
                <h2> Tablas de ambos de ambos</h2>
                <br>
                <div class="table-responsive">
                    <table id="soh-jucavi" class="display table table-hover" style="">
                        <thead class="thead-dark">
                            <tr>
                                <th>Sh_origen</th>
                                <th>Sh_credito</th>
                                <th>Sh_referencia</th>
                                <th>Sh_numclientesicap</th>
                                <th>Sh_numsolicitudsicap</th>
                                <th>Sh_numclienteibs</th>
                                <th>Sh_nombrecliente</th>
                                <th>Sh_rfc</th>
                                <th>Sh_numsucursal</th>
                                <th>Sh_nombresucursal</th>
                                <th>FechaEnvio</th>
                                <th>Sh_fecha_generacion</th>
                                <th>Sh_hora_generacion</th>
                                <th>Sh_num_cuotas</th>
                                <th>Sh_num_cuotas_trancurridas</th>
                                <th>Sh_plazo</th>
                                <th>Sh_periodicidad</th>
                                <th>FechaDesembolso</th>
                                <th>FechaVencimiento</th>
                                <th>Sh_monto_dispersado</th>
                                <th>Sh_monto_seguro</th>
                                <th>Sh_monto_credito</th>
                                <th>Sh_saldo_total_dia</th>
                                <th>Sh_saldo_capital</th>
                                <th>Sh_saldo_interes</th>
                                <th>Sh_saldo_interes_vigente</th>
                                <th>Sh_saldo_interes_vencido</th>
                                <th>Sh_saldo_interes_vencido_90dias</th>
                                <th>Sh_saldo_interes_cuentas_orden</th>
                                <th>Sh_saldo_iva_interes</th>
                                <th>Sh_saldo_bonificacion_iva</th>
                                <th>Sh_saldo_interes_mora</th>
                                <th>Sh_saldo_iva_mora</th>
                                <th>Sh_saldo_multa</th>
                                <th>Sh_saldo_iva_multa</th>
                                <th>Sh_capital_pagado</th>
                                <th>Sh_interes_normal_pagado</th>
                                <th>Sh_iva_interes_normal_pagado</th>
                                <th>Sh_bonificacion_pagada</th>
                                <th>Sh_moratorio_pagado</th>
                                <th>Sh_iva_moratorio_pagado</th>
                                <th>Sh_multa_pagada</th>
                                <th>Sh_iva_multa_pagada</th>
                                <th>Sh_comision</th>
                                <th>Sh_iva_comision</th>
                                <th>FechaSigAmortizacion</th>
                                <th>Sh_capital_sig_amortizacion</th>
                                <th>Sh_interes_sig_amortizacion</th>
                                <th>Sh_iva_interes_sig_amortizacion</th>
                                <th>Sh_fondeador</th>
                                <th>NombreFondeador</th>
                                <th>Garantia</th>
                                <th>Sh_tasa_interes_sin_iva</th>
                                <th>Sh_tasa_mora_sin_iva</th>
                                <th>Sh_tasa_iva</th>
                                <th>Sh_saldo_con_intereses_al_final</th>
                                <th>Sh_capital_vencido</th>
                                <th>Sh_interes_vencido</th>
                                <th>Sh_iva_interes_vencido</th>
                                <th>Sh_total_vencido</th>
                                <th>Sh_estatus</th>
                                <th>Sh_producto</th>
                                <th>NombreProducto</th>
                                <th>Sh_fecha_incumplimiento</th>
                                <th>FechaCarteraVencida</th>
                                <th>Sh_num_dias_mora</th>
                                <th>referencia</th>
                                <th>Sh_dias_transcurridos</th>
                                <th>Sh_cuotas_vencidas</th>
                                <th>Sh_num_pagos_realizados</th>
                                <th>Sh_moto_total_pagado</th>
                                <th>Sh_fecha_ultimo_pago</th>
                                <th>Sh_bandera_reestructura</th>
                                <th>Sh_credito_reestructurado</th>
                                <th>Sh_dias_mora_reestructura</th>
                                <th>Sh_tasa_preferencial_iva</th>
                                <th>Sh_cuenta_bucket</th>
                                <th>Sh_saldo_bucket</th>
                                <th>Sh_cta_contable</th>
                                <th>Sh_fecha_historico</th>
                                <th>integrantesDispersados</th>
                                <th>integrantesCancelados</th>
                                <th>integrantesInterciclo</th>
                                <th>sh_monto_cuenta_congelada</th>
                                <th>sh_interes_xdevengar</th>
                                <th>sh_iva_interes_xdevengar</th>
                                <th>sh_interes_devengado</th>
                                <th>sh_iva_interes_devengado</th>
                                <th>Integrantes_Iniciales</th>
                                <th>Integrantes_Cancelados</th>
                                <th>Integrantes_Agregados</th>
                                <th>Origen_Sistema</th>
                                <th>Tasa_Mensual_sin_Iva</th>
                                <th>No_Asesor</th>
                                <th>Asesor</th>
                                <th>Estado</th>
                                <th>sh_saldogarantia</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <br><br>
                <div class="table-responsive">
                    <table id="soh-mambu" class="display table table-hover" style="">
                        <thead class="thead-dark">
                            <tr>
                                <th>fechacorte</th>
                                <th>acuerdocreditoequipo</th>
                                <th>idequipo</th>
                                <th>equipo</th>
                                <th>producto</th>
                                <th>sucursal</th>
                                <th>estadosucursal</th>
                                <th>centrocosto</th>
                                <th>plazo</th>
                                <th>cuotaspagadas</th>
                                <th>cuotastranscurridas</th>
                                <th>tasaglobal</th>
                                <th>tasasaldoinsoluto</th>
                                <th>cicloequipo</th>
                                <th>garantia</th>
                                <th>fondeador</th>
                                <th>integrantesiniciales</th>
                                <th>integrantecancelados</th>
                                <th>integranteagregados</th>
                                <th>integrantesfinales</th>
                                <th>fechadesembolso</th>
                                <th>fechaactivacion</th>
                                <th>fechavencimiento</th>
                                <th>capitalotorgado</th>
                                <th>montosegurofinanciado</th>
                                <th>diasatraso</th>
                                <th>estatusmambu</th>
                                <th>capitalgenerado</th>
                                <th>interesgenerado</th>
                                <th>ivagenerado</th>
                                <th>totalgenerado</th>
                                <th>capitalpagado</th>
                                <th>interespagado</th>
                                <th>ivapagado</th>
                                <th>totalpagado</th>
                                <th>saldocapital</th>
                                <th>saldointeres</th>
                                <th>saldoiva</th>
                                <th>saldocarteratotal</th>
                                <th>saldocuentadepositogrupal</th>
                                <th>saldocuentagarantia</th>
                                <th>interesdevengado</th>
                                <th>interesdevengasdopagado</th>
                                <th>saldointeresdevengadonopagado</th>
                                <th>ivainteresdevengado</th>
                                <th>ivainterestotalpagado</th>
                                <th>saldoivainteresdevengadonopagado</th>
                                <th>saldocarteracontable</th>
                                <th>interesdiferido</th>
                                <th>interesdiferidoaplicado</th>
                                <th>saldointeresdiferido</th>
                                <th>saldocartera</th>
                                <th>saldointerespordevengar</th>
                                <th>saldoivainterespordevengar</th>
                                <th>estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div> --}}



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
    </style>

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/dataRender/datetime.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>



    <script>
        var jsonjucavi = [];
        var jsonmambu = [];
        $(document).ready(function() {

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

            // generarGraficasJucavi();
            // generarGraficasMambu();


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
                    totalFormateado = total.toLocaleString();
                    fondeadoresmambu.forEach(element => {
                        porcentaje = (element.monto * 100) / total;
                        porcentajeFormateado = parseFloat(porcentaje.toFixed(2));
                        cantidadFormateado = parseFloat(element.cantidadregistros);
                        montoFormateado = parseFloat(element.monto);
                        montoFormateado = montoFormateado.toLocaleString();

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
                    totalFormateado = total.toLocaleString();
                    fondeadoresjucavi.forEach(element => {
                        porcentaje = (element.monto * 100) / total;
                        porcentajeFormateado = parseFloat(porcentaje.toFixed(2));
                        cantidadFormateado = parseFloat(element.cantidadregistros);
                        montoFormateado = parseFloat(element.monto);
                        montoFormateado = montoFormateado.toLocaleString();

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
                    $.unblockUI();
                    datosgenerales();
                }
            });




        });

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
                        $('#valoractualjucavipromecap').text("$" + parseFloat(element.monto).toLocaleString());
                        actualjucavipromecap += parseFloat(element.monto);
                        $('#cantidadactualjucavipromecap').text(parseFloat(element.cantidadregistros)
                            .toLocaleString());
                        cantidadjucavipromecap = element.cantidadregistros;
                        break;
                    case "BLAO":
                        $('#valoractualjucaviblao').text("$" + parseFloat(element.monto).toLocaleString());
                        actualjucaviblao += parseFloat(element.monto);
                        $('#cantidadactualjucaviblao').text(parseFloat(element.cantidadregistros).toLocaleString());
                        cantidadjucaviblao = element.cantidadregistros;
                        break;
                }
            });
            jsonmambu.forEach(element => {
                switch (element.nombrefondeador) {
                    case "PROMECAP":
                        $('#valoractualmambupromecap').text("$" + parseFloat(element.monto).toLocaleString());
                        actualmambupromecap += parseFloat(element.monto);
                        $('#cantidadactualmambupromecap').text(parseFloat(element.cantidadregistros)
                        .toLocaleString());
                        cantidadmambupromecap = element.cantidadregistros;
                        break;
                    case "BLAO":
                        $('#valoractualmambublao').text("$" + parseFloat(element.monto).toLocaleString());
                        actualmambublao += parseFloat(element.monto);
                        $('#cantidadactualmambublao').text(parseFloat(element.cantidadregistros).toLocaleString());
                        cantidadmambublao = element.cantidadregistros;
                        break;
                    case "MINTOS":
                        $('#valoractualmambumintos').text("$" + parseFloat(element.monto).toLocaleString());
                        actualmambumintos += parseFloat(element.monto);
                        $('#cantidadactualmambumintos').text(parseFloat(element.cantidadregistros)
                    .toLocaleString());
                        cantidadmambumintos = element.cantidadregistros;
                        $('#sumacantidadactualmintos').text(parseFloat(element.cantidadregistros).toLocaleString());

                        break;
                }
            });

            sumavalorpromecap = actualjucavipromecap + actualmambupromecap;
            sumavalorblao = actualjucaviblao + actualmambublao;

            sumacantidadpromecap = cantidadjucavipromecap + cantidadmambupromecap;
            sumacantidadblao = cantidadjucaviblao + cantidadmambublao;



            $('#valoractualsumapromecap').text("$" + parseFloat(sumavalorpromecap).toLocaleString());
            $('#valoractualsumablao').text("$" + parseFloat(sumavalorblao).toLocaleString());
            $('#valoractualsumamintos').text("$" + parseFloat(actualmambumintos).toLocaleString());

            $('#sumacantidadactualpromecap').text(parseFloat(sumacantidadpromecap).toLocaleString());
            $('#sumacantidadactualblao').text(parseFloat(sumacantidadblao).toLocaleString());


            vdb = 153173700.00 - sumavalorblao;
            vdp = 376805000.05 - sumavalorpromecap;
            $('#valordiferenciapromecap').text("$" + parseFloat(vdp).toLocaleString());
            $('#valordiferenciablao').text("$" + parseFloat(vdb).toLocaleString());

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
                        $('#soh-jucavi').DataTable({
                            destroy: true,
                            scrollX: true,
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
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf'
                            ],
                            destroy: true,
                            processing: true,
                            sort: true,
                            paging: true,

                            data: data,
                            columns: [{
                                    title: "Sh_origen",
                                    data: "Sh_origen"
                                },
                                {
                                    title: "Sh_credito",
                                    data: "Sh_credito"
                                },
                                {
                                    title: "Sh_referencia",
                                    data: "Sh_referencia"
                                },
                                {
                                    title: "Sh_numclientesicap",
                                    data: "Sh_numclientesicap"
                                },
                                {
                                    title: "Sh_numsolicitudsicap",
                                    data: "Sh_numsolicitudsicap"
                                },
                                {
                                    title: "Sh_numclienteibs",
                                    data: "Sh_numclienteibs"
                                },
                                {
                                    title: "Sh_nombrecliente",
                                    data: "Sh_nombrecliente"
                                },
                                {
                                    title: "Sh_rfc",
                                    data: "Sh_rfc"
                                },
                                {
                                    title: "Sh_numsucursal",
                                    data: "Sh_numsucursal"
                                },
                                {
                                    title: "Sh_nombresucursal",
                                    data: "Sh_nombresucursal"
                                },
                                {
                                    title: "FechaEnvio",
                                    data: "FechaEnvio"
                                },
                                {
                                    title: "Sh_fecha_generacion",
                                    data: "Sh_fecha_generacion"
                                },
                                {
                                    title: "Sh_hora_generacion",
                                    data: "Sh_hora_generacion"
                                },
                                {
                                    title: "Sh_num_cuotas",
                                    data: "Sh_num_cuotas"
                                },
                                {
                                    title: "Sh_num_cuotas_trancurridas",
                                    data: "Sh_num_cuotas_trancurridas"
                                },
                                {
                                    title: "Sh_plazo",
                                    data: "Sh_plazo"
                                },
                                {
                                    title: "Sh_periodicidad",
                                    data: "Sh_periodicidad"
                                },
                                {
                                    title: "FechaDesembolso",
                                    data: "FechaDesembolso"
                                },
                                {
                                    title: "FechaVencimiento",
                                    data: "FechaVencimiento"
                                },
                                {
                                    title: "Sh_monto_dispersado",
                                    data: "Sh_monto_dispersado"
                                },
                                {
                                    title: "Sh_monto_seguro",
                                    data: "Sh_monto_seguro"
                                },
                                {
                                    title: "Sh_monto_credito",
                                    data: "Sh_monto_credito"
                                },
                                {
                                    title: "Sh_saldo_total_dia",
                                    data: "Sh_saldo_total_dia"
                                },
                                {
                                    title: "Sh_saldo_capital",
                                    data: "Sh_saldo_capital"
                                },
                                {
                                    title: "Sh_saldo_interes",
                                    data: "Sh_saldo_interes"
                                },
                                {
                                    title: "Sh_saldo_interes_vigente",
                                    data: "Sh_saldo_interes_vigente"
                                },
                                {
                                    title: "Sh_saldo_interes_vencido",
                                    data: "Sh_saldo_interes_vencido"
                                },
                                {
                                    title: "Sh_saldo_interes_vencido_90dias",
                                    data: "Sh_saldo_interes_vencido_90dias"
                                },
                                {
                                    title: "Sh_saldo_interes_cuentas_orden",
                                    data: "Sh_saldo_interes_cuentas_orden"
                                },
                                {
                                    title: "Sh_saldo_iva_interes",
                                    data: "Sh_saldo_iva_interes"
                                },
                                {
                                    title: "Sh_saldo_bonificacion_iva",
                                    data: "Sh_saldo_bonificacion_iva"
                                },
                                {
                                    title: "Sh_saldo_interes_mora",
                                    data: "Sh_saldo_interes_mora"
                                },
                                {
                                    title: "Sh_saldo_iva_mora",
                                    data: "Sh_saldo_iva_mora"
                                },
                                {
                                    title: "Sh_saldo_multa",
                                    data: "Sh_saldo_multa"
                                },
                                {
                                    title: "Sh_saldo_iva_multa",
                                    data: "Sh_saldo_iva_multa"
                                },
                                {
                                    title: "Sh_capital_pagado",
                                    data: "Sh_capital_pagado"
                                },
                                {
                                    title: "Sh_interes_normal_pagado",
                                    data: "Sh_interes_normal_pagado"
                                },
                                {
                                    title: "Sh_iva_interes_normal_pagado",
                                    data: "Sh_iva_interes_normal_pagado"
                                },
                                {
                                    title: "Sh_bonificacion_pagada",
                                    data: "Sh_bonificacion_pagada"
                                },
                                {
                                    title: "Sh_moratorio_pagado",
                                    data: "Sh_moratorio_pagado"
                                },
                                {
                                    title: "Sh_iva_moratorio_pagado",
                                    data: "Sh_iva_moratorio_pagado"
                                },
                                {
                                    title: "Sh_multa_pagada",
                                    data: "Sh_multa_pagada"
                                },
                                {
                                    title: "Sh_iva_multa_pagada",
                                    data: "Sh_iva_multa_pagada"
                                },
                                {
                                    title: "Sh_comision",
                                    data: "Sh_comision"
                                },
                                {
                                    title: "Sh_iva_comision",
                                    data: "Sh_iva_comision"
                                },
                                {
                                    title: "FechaSigAmortizacion",
                                    data: "FechaSigAmortizacion"
                                },
                                {
                                    title: "Sh_capital_sig_amortizacion",
                                    data: "Sh_capital_sig_amortizacion"
                                },
                                {
                                    title: "Sh_interes_sig_amortizacion",
                                    data: "Sh_interes_sig_amortizacion"
                                },
                                {
                                    title: "Sh_iva_interes_sig_amortizacion",
                                    data: "Sh_iva_interes_sig_amortizacion"
                                },
                                {
                                    title: "Sh_fondeador",
                                    data: "Sh_fondeador"
                                },
                                {
                                    title: "NombreFondeador",
                                    data: "NombreFondeador"
                                },
                                {
                                    title: "Garantia",
                                    data: "Garantia"
                                },
                                {
                                    title: "Sh_tasa_interes_sin_iva",
                                    data: "Sh_tasa_interes_sin_iva"
                                },
                                {
                                    title: "Sh_tasa_mora_sin_iva",
                                    data: "Sh_tasa_mora_sin_iva"
                                },
                                {
                                    title: "Sh_tasa_iva",
                                    data: "Sh_tasa_iva"
                                },
                                {
                                    title: "Sh_saldo_con_intereses_al_final",
                                    data: "Sh_saldo_con_intereses_al_final"
                                },
                                {
                                    title: "Sh_capital_vencido",
                                    data: "Sh_capital_vencido"
                                },
                                {
                                    title: "Sh_interes_vencido",
                                    data: "Sh_interes_vencido"
                                },
                                {
                                    title: "Sh_iva_interes_vencido",
                                    data: "Sh_iva_interes_vencido"
                                },
                                {
                                    title: "Sh_total_vencido",
                                    data: "Sh_total_vencido"
                                },
                                {
                                    title: "Sh_estatus",
                                    data: "Sh_estatus"
                                },
                                {
                                    title: "Sh_producto",
                                    data: "Sh_producto"
                                },
                                {
                                    title: "NombreProducto",
                                    data: "NombreProducto"
                                },
                                {
                                    title: "Sh_fecha_incumplimiento",
                                    data: "Sh_fecha_incumplimiento"
                                },
                                {
                                    title: "FechaCarteraVencida",
                                    data: "FechaCarteraVencida"
                                },
                                {
                                    title: "Sh_num_dias_mora",
                                    data: "Sh_num_dias_mora"
                                },
                                {
                                    title: "referencia",
                                    data: "referencia"
                                },
                                {
                                    title: "Sh_dias_transcurridos",
                                    data: "Sh_dias_transcurridos"
                                },
                                {
                                    title: "Sh_cuotas_vencidas",
                                    data: "Sh_cuotas_vencidas"
                                },
                                {
                                    title: "Sh_num_pagos_realizados",
                                    data: "Sh_num_pagos_realizados"
                                },
                                {
                                    title: "Sh_moto_total_pagado",
                                    data: "Sh_moto_total_pagado"
                                },
                                {
                                    title: "Sh_fecha_ultimo_pago",
                                    data: "Sh_fecha_ultimo_pago"
                                },
                                {
                                    title: "Sh_bandera_reestructura",
                                    data: "Sh_bandera_reestructura"
                                },
                                {
                                    title: "Sh_credito_reestructurado",
                                    data: "Sh_credito_reestructurado"
                                },
                                {
                                    title: "Sh_dias_mora_reestructura",
                                    data: "Sh_dias_mora_reestructura"
                                },
                                {
                                    title: "Sh_tasa_preferencial_iva",
                                    data: "Sh_tasa_preferencial_iva"
                                },
                                {
                                    title: "Sh_cuenta_bucket",
                                    data: "Sh_cuenta_bucket"
                                },
                                {
                                    title: "Sh_saldo_bucket",
                                    data: "Sh_saldo_bucket"
                                },
                                {
                                    title: "Sh_cta_contable",
                                    data: "Sh_cta_contable"
                                },
                                {
                                    title: "Sh_fecha_historico",
                                    data: "Sh_fecha_historico"
                                },
                                {
                                    title: "integrantesDispersados",
                                    data: "integrantesDispersados"
                                },
                                {
                                    title: "integrantesCancelados",
                                    data: "integrantesCancelados"
                                },
                                {
                                    title: "integrantesInterciclo",
                                    data: "integrantesInterciclo"
                                },
                                {
                                    title: "sh_monto_cuenta_congelada",
                                    data: "sh_monto_cuenta_congelada"
                                },
                                {
                                    title: "sh_interes_xdevengar",
                                    data: "sh_interes_xdevengar"
                                },
                                {
                                    title: "sh_iva_interes_xdevengar",
                                    data: "sh_iva_interes_xdevengar"
                                },
                                {
                                    title: "sh_interes_devengado",
                                    data: "sh_interes_devengado"
                                },
                                {
                                    title: "sh_iva_interes_devengado",
                                    data: "sh_iva_interes_devengado"
                                },
                                {
                                    title: "Integrantes_Iniciales",
                                    data: "Integrantes_Iniciales"
                                },
                                {
                                    title: "Integrantes_Cancelados",
                                    data: "Integrantes_Cancelados"
                                },
                                {
                                    title: "Integrantes_Agregados",
                                    data: "Integrantes_Agregados"
                                },
                                {
                                    title: "Origen_Sistema",
                                    data: "Origen_Sistema"
                                },
                                {
                                    title: "Tasa_Mensual_sin_Iva",
                                    data: "Tasa_Mensual_sin_Iva"
                                },
                                {
                                    title: "No_Asesor",
                                    data: "No_Asesor"
                                },
                                {
                                    title: "Asesor",
                                    data: "Asesor"
                                },
                                {
                                    title: "Estado",
                                    data: "Estado"
                                },
                                {
                                    title: "sh_saldogarantia",
                                    data: "sh_saldogarantia"
                                }
                            ]
                        });


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

                    var table = $('#soh-mambu').DataTable({
                        destroy: true,
                        scrollX: true,
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
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf'
                        ],
                        destroy: true,
                        processing: true,
                        sort: true,
                        paging: true,
                    });
                    dataJson.forEach(function(val) {
                        var row = table.row.add([
                            val.fechacorte,
                            val.acuerdocreditoequipo,
                            val.idequipo,
                            val.equipo,
                            val.producto,
                            val.sucursal,
                            val.estadosucursal,
                            val.centrocosto,
                            val.plazo,
                            val.cuotaspagadas,
                            val.cuotastranscurridas,
                            val.tasaglobal,
                            val.tasasaldoinsoluto,
                            val.cicloequipo,
                            val["%garantia"],
                            val.fondeador,
                            val.integrantesiniciales,
                            val.integrantecancelados,
                            val.integranteagregados,
                            val.integrantesfinales,
                            val.fechadesembolso,
                            val.fechaactivacion,
                            val.fechavencimiento,
                            val.capitalotorgado,
                            val.montosegurofinanciado,
                            val.diasatraso,
                            val.estatusmambu,
                            val.capitalgenerado,
                            val.interesgenerado,
                            val.ivagenerado,
                            val.totalgenerado,
                            val.capitalpagado,
                            val.interespagado,
                            val.ivapagado,
                            val.totalpagado,
                            val.saldocapital,
                            val.saldointeres,
                            val.saldoiva,
                            val.saldocarteratotal,
                            val.saldocuentadepositogrupal,
                            val.saldocuentagarantia,
                            val.interesdevengado,
                            val.interesdevengasdopagado,
                            val.saldointeresdevengadonopagado,
                            val.ivainteresdevengado,
                            val.ivainterestotalpagado,
                            val.saldoivainteresdevengadonopagado,
                            val.saldocarteracontable,
                            val.interesdiferido,
                            val.interesdiferidoaplicado,
                            val.saldointeresdiferido,
                            val.saldocartera,
                            val.saldointerespordevengar,
                            val.saldoivainterespordevengar,
                            val.estatus
                        ]).draw().node();
                    });


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
    </script>
@stop
