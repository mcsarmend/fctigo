@extends('adminlte::page')

@section('title', 'Configuraciones')

@section('content_header')
    <h1>Etiquetado PROMECAP JUCAVI</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Proceso que da de alta o baja créditos que serán asignados a Promecap.</h1>
        </div>
        <div class="card-body">
            <div class="container py-4">
                <div class="row section">
                    <div class="col-md-8 col-sm-6 mb-3">
                        <button class="btn btn-outline-primary w-100" id="preetiquetadoPromecapJucavi">Preetiquetado
                            Promecap</button>
                    </div>
                </div>
                <div class="row section">
                    <div class="col-md-8 col-sm-6 mb-3 center-form">
                        <!-- Agregado: "center-form" -->
                        <form id="bajaPromecapJucavi">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="excelBajaJucavi"
                                        accept=".xlsx, .xls">
                                    <label class="custom-file-label-baja" for="excelBajaJucavi">Seleccionar
                                        archivo...</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary w-100" type="submit">Baja Promecap</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @stop

    @section('css')
        <style>
            .custom-file input {
                width: 20%;
            }

            .custom-file label {
                color: #034383;
                text-decoration: underline;
            }

            .section {
                border-bottom: 1px solid #034383;
                padding: 20px;
                align-content: center;
            }

            .center-form {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100%;
            }
        </style>
    @stop

    @section('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
        <!-- Agrega esto en el encabezado o antes de cerrar el cuerpo -->
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.17.0/dist/xlsx.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"
            integrity="sha512-csNcFYJniKjJxRWRV1R7fvnXrycHP6qDR21mgz1ZP55xY5d+aHLfo9/FcGDQLfn2IfngbAHd8LdfsagcCqgTcQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $(document).ready(function() {
                var type = @json($type);
                if (type == '3') {
                    $('a:contains("Cuentas")').hide();
                    console.log('Se oculta');
                }

            });
            /* preetiquetadopromecapmambu*/
            $('#preetiquetadoPromecapJucavi').click(function() {
                // Bloquea la pantalla
                $.blockUI({
                    message: 'Cargando...'
                });

                // Realiza la petición AJAX
                $.ajax({
                    url: "promecap_preetiequetado_jucavi",
                    method: "GET",
                    dataType: "JSON",
                    data: {},
                    success: function(data) {
                        console.log(data);
                        //if ('success' in data) {

                        var workbook = XLSX.utils.book_new();

                        var fechaActual =
                            getdateformatted(); // Crea un objeto Date con la fecha y hora actuales

                        nameWorkbook = 'Jucavi ' +
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

            /* BAJA*/
            const form_baja = document.getElementById('bajaPromecapJucavi');
            const fileInput_baja = document.getElementById('excelBajaJucavi');
            const fileInputLabel_baja = document.querySelector('.custom-file-label-baja');
            // Actualizar la etiqueta del archivo seleccionado
            fileInput_baja.addEventListener('change', () => {
                name = fileInput_baja.files[0]?.name;
                if (name.substring(name.length - 3, name.length) == 'xls' || name.substring(name.length - 4, name
                        .length) == 'xlsx') {
                        fileInputLabel_baja.textContent = fileInput_baja.files[0]?.name || 'Seleccionar archivo';
                } else {
                    fileInput_baja.value = "";
                    Swal.fire({
                        icon: 'error',
                        title: 'El archivo no es un excel',
                    });

                }
            });

            form_baja.addEventListener('submit', (e) => {
                e.preventDefault();

                const file = fileInput_baja.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const data = new Uint8Array(e.target.result);
                        const workbook = XLSX.read(data, {
                            type: 'array'
                        });
                        const worksheet = workbook.Sheets[workbook.SheetNames[0]];
                        const jsonData = XLSX.utils.sheet_to_json(worksheet, {
                            header: 1,
                            defval: ''
                        });

                        const column1 = jsonData.map(function(row) {
                            return row[0];
                        });

                        Swal.fire({
                            title: '¡Se daran de baja la siguiente cantidad de creditos!',
                            html: 'Jucavi: <b>' + column1.length + '</b>, ',
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: 'Etiquetar',
                            denyButtonText: `No etiquetar`,

                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "bajapromecapjucavi",
                                    method: "POST",
                                    dataType: "JSON",
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: {
                                        "jucavi": column1
                                    },
                                    success: function(data) {
                                        console.log(data);
                                        if ('success' in data) {
                                            Swal.fire(
                                                '¡Gracias por esperar!',
                                                data["success"],
                                                'success'
                                            )
                                        }
                                    },
                                    error: function(data) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Encontramos un error...',
                                            text: data["responseJSON"]["error"],
                                        });
                                    }
                                });
                            } else if (result.isDenied) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'No se ha seleccionado ningun archivo',

                                });
                            }
                        })
                    };
                    reader.readAsArrayBuffer(file);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se ha seleccionado ningun archivo',

                    });
                }
            });

            // Actualizar la etiqueta del archivo seleccionado
            fileInput_baja.addEventListener('change', () => {
                fileInputLabel_baja.textContent = fileInput_baja.files[0]?.name || 'Seleccionar archivo';
            });

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
