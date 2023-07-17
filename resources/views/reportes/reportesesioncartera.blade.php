@extends('adminlte::page')

@section('title', 'Configuraciones')

@section('content_header')
    <h1>Reporte de Sesion de cartera</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Proceso que generar reporte de Sesion de cartera.</h1>
        </div>
        <div class="card-body">
            <label for="start-date">Fecha de consulta:</label>
            <input type="date" id="start-date" name="start-date">
            <br>
            <button class="btn btn-primary" id="reportesesioncartera"> Generar Reporte</button>
            <br>
            <br>
            <table id="tablasesioncartera" class="display" style="display:none;">
                <thead>
                    <tr>
                        <th>Fecha_Alta</th>
                        <th>Acuerdo</th>
                        <th>NoTitularCuenta</th>
                        <th>NombreTitulaCuenta</th>
                        <th>Ciclo</th>
                        <th>Sucursal</th>
                        <th>Estado</th>
                        <th>Fondeador</th>
                        <th>Saldo_Capital</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
        </div>

    </div>
@stop

@section('css')

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/dataRender/datetime.js"></script>
    <script>
        var rest = true;

        $('#reportesesioncartera').click(function() {
            // Bloquea la pantalla
            $.blockUI({
                message: 'Cargando...'
            });
            dateVal = $('#start-date').val().toString();
            // Realiza la petición AJAX
            $.ajax({
                url: "reportesesioncartera",
                method: "GET",
                dataType: "JSON",
                data: {
                    date: dateVal
                },

                success: function(data) {
                    console.log(data);
                    if (data.length > 0) {
                        // Procesa los datos de la respuesta...
                        $('#tablasesioncartera').show();
                        // Inicializa la tabla DataTables con los datos
                        $('#tablasesioncartera').DataTable({
                            buttons: [{
                                    extend: 'copy',
                                    className: 'btn btn-secondary'
                                },
                                {
                                    extend: 'excel',
                                    className: 'btn btn-secondary',
                                    title: 'Reporte de Pre Etiquetado Sesion de cartera Excel'
                                },
                                {
                                    extend: 'pdf',
                                    className: 'btn btn-secondary',
                                    title: 'Reporte de Pre Etiquetado Sesion de cartera PDF'
                                },
                                {
                                    extend: 'print',
                                    className: 'btn btn-secondary'
                                }
                            ],
                            dom: 'Bfrtip', // Mostrar los botones en la parte superior de la tabla
                            lengthMenu: [
                                [10, 25, 50, -1],
                                [10, 25, 50, 'All']
                            ], // Personalizar el menú de longitud de visualización

                            // Configurar las opciones de exportación
                            // Para PDF
                            pdf: {
                                orientation: 'landscape', // Orientación del PDF (landscape o portrait)
                                pageSize: 'A4', // Tamaño del papel del PDF
                                exportOptions: {
                                    columns: ':visible' // Exportar solo las columnas visibles
                                }
                            },
                            // Para Excel
                            excel: {
                                exportOptions: {
                                    columns: ':visible' // Exportar solo las columnas visibles
                                }
                            },
                            data: data,
                            columns: [{
                                title: "Fecha_Alta"
                            }, {
                                title: "Acuerdo",
                            }, {
                                title: "NoTitularCuenta",
                            }, {
                                title: "NombreTitulaCuenta",
                            }, {
                                title: "Ciclo",
                            }, {
                                title: "Sucursal",
                            }, {
                                title: "Estado",
                            }, {
                                title: "Fondeador",
                            }, {
                                title: "Saldo_Capital",
                            }]
                        });


                        // Desbloquea la pantalla después de que se complete la petición
                        $.unblockUI();

                        // Muestra un mensaje de éxito
                        Swal.fire({
                            title: 'Todo bien!',
                            text: '¡El reporte se generó correctamente!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });

                    } else {
                        Swal.fire({
                            title: '¡Sin información!',
                            text: "No se encontraron registros en la fecha indicada",
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                                            // Desbloquea la pantalla después de que se complete la petición
                    $.unblockUI();
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
        });


        $(document).ready(function() {
            establecerFechaMaxima();

        });

        function establecerFechaMaxima() {
            var fechaActual = new Date();
            var fechaMinima = new Date();
            fechaMinima.setMonth(fechaActual.getMonth() - 3);
            fechaminimastr = fechaMinima.toISOString().split('T')[0];
            var fechaMaxima = fechaActual.toISOString().split('T')[0];

            document.getElementById('start-date').setAttribute('min', fechaminimastr);
            document.getElementById('start-date').setAttribute('min', fechaminimastr);
            document.getElementById('start-date').setAttribute('max', fechaMaxima);
            document.getElementById('start-date').setAttribute('max', fechaMaxima);


        }
    </script>
@stop
