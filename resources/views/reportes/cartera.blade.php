@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')

@stop

@section('content')
    <br>
    <div class="card">

        <div class="card-body">
            <h2>Reporte Cartera</h2>
            <div class="card-header">
                <h1 class="card-title">Proceso que genera documentos.</h1>
            </div>
            <br><br>
            <div class="row">
                <div class="col">
                    <label for="start-date" class="">Fecha inicial:</label>
                </div>
                <div class="col">
                    <input type="date" id="start-date" name="start-date" class="form-control">
                </div>
            </div>


            <br>
            <br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-primary" id="descargarcartera"> Descargar Reporte</button>
                </div>
            </div>

            <br><br>
        </div>
    </div>

@stop
@section('css')
    <style>
        .content-wrapper {
            background-image: url('/assets/images/fondo.png');
            background-size: contain;
            background-position: left;
        }
    </style>
@stop


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script>
        $(document).ready(function() {
            showUsersSections();
        });

        $('#descargarcartera').click(function() {
            startDate = $('#start-date').val();
            endDate = $('#end-date').val();

            if (startDate == "") {
                Swal.fire({
                    title: '¡Ingresa fecha de inicio!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }
            var startDateVal = new Date(startDate);

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
            Swal.fire({
                title: '¡Gracias por esperar!',
                text: "Respuesta OK",
                icon: 'success',
                confirmButtonText: 'OK'
            });
            $.unblockUI();
            // $.ajax({
            //     url: "reportecartera",
            //     method: "GET",
            //     dataType: "JSON",
            //     data: {
            //         startDate: startDate,
            //     },

            //     success: function(data) {
            //         Swal.fire({
            //             title: '¡Gracias por esperar!',
            //             text: data,
            //             icon: 'succes',
            //             confirmButtonText: 'OK'
            //         });
            //         $.unblockUI();
            //         if (data != '[]') {
            //             dataPrestamo = data.dataPrestamo;
            //             dataDeposito = data.dataDeposito;
            //             // Crear un nuevo libro de Excel
            //             var workbook = XLSX.utils.book_new();

            //             // Convertir JSON1 a una hoja de cálculo
            //             var worksheet1 = XLSX.utils.json_to_sheet(dataPrestamo);
            //             XLSX.utils.book_append_sheet(workbook, worksheet1, 'Prestamo');

            //             // Convertir JSON2 a una hoja de cálculo
            //             var worksheet2 = XLSX.utils.json_to_sheet(dataDeposito);
            //             XLSX.utils.book_append_sheet(workbook, worksheet2, 'Deposito');

            //             // Generar el archivo Excel
            //             var excelBuffer = XLSX.write(workbook, {
            //                 bookType: 'xlsx',
            //                 type: 'array'
            //             });
            //             var blob = new Blob([excelBuffer], {
            //                 type: 'application/octet-stream'
            //             });
            //             saveAs(blob, 'Reporte Recuperacion Cartera' + $('#start-date').val() + '.xlsx');
            //             // Desbloquea la pantalla después de que se complete la petición
            //             $.unblockUI();

            //         } else {
            //             Swal.fire({
            //                 title: '¡Sin información!',
            //                 text: "No se encontraron registros en la fecha indicada",
            //                 icon: 'warning',
            //                 confirmButtonText: 'OK'
            //             });
            //             // Desbloquea la pantalla después de que se complete la petición
            //             $.unblockUI();
            //         }
            //     }
            // });


        });


        function showUsersSections() {
            var type = @json($type);
            switch (type) {
                case '3':
                    $('a:contains("Cuentas")').hide();
                    $('small:contains("Administrador")').text('Ejecutivo');
                    $('a:contains("Etiquetado")').hide();
                    $('a:contains("Anexos")').hide();
                    break;
                case '2':
                    $('a:contains("Cuentas")').hide();

                    break;

                default:
                    break;
            }
        }
    </script>

@stop
