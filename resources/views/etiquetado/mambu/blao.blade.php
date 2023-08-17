@extends('adminlte::page')

@section('title', 'Etiqueado MAMBU BLAO')

@section('content_header')
    <h1>Etiquetado MAMBU BLAO</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Proceso que da de alta o baja créditos que serán asignados a BLAO.</h1>
        </div>
        <div class="card-body">
            <div class="container py-4">
                <div class="row section">
                    <div class="col-md-8 col-sm-6 mb-3">
                        <button class="btn btn-outline-primary w-100" id="preetiquetadoBlaomambu">Preetiquetado BLAO</button>
                    </div>
                </div>
                <div class="row section">
                    <div class="col-md-8 col-sm-6 mb-3 center-form">
                        <!-- Agregado: "center-form" -->
                        <form id="bajablao">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary w-100" type="submit">Baja BLAO</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row section">
                    <div class="col-md-8 col-sm-6 mb-3 center-form">
                        <!-- Agregado: "center-form" -->
                        <form id="etiquetadoBlao">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="excelEtiquetado"
                                        accept=".xlsx, .xls">
                                    <label class="custom-file-label-etiquetado" for="excelEtiquetado">Seleccionar
                                        archivo...</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary w-100" type="submit">Etiquetado
                                        BLAO</button>
                                </div>
                            </div>
                        </form>
                        {{-- <div>
                            <p>En el archivo, la primer columna es para mambu y la segunda columna es para jucavi</p>
                        </div> --}}
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

        <script>
            $(document).ready(function() {
                var type = @json($type);
                if (type == '3') {
                    $('a:contains("Cuentas")').hide();
                    console.log('Se oculta');
                }

            });
            /* preetiquetadoBlaomambu*/
            $('#preetiquetadoBlaomambu').click(function() {
                // Bloquea la pantalla
                $.blockUI({
                    message: 'Cargando...'
                });

                // Realiza la petición AJAX
                $.ajax({
                    url: "blao_preetiequetado_mambu",
                    method: "GET",
                    dataType: "JSON",
                    data: {},
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
                // Desbloquea la pantalla después de que se complete la petición
                $.unblockUI();
            });

            /* BAJA*/

            const form_baja = document.getElementById('bajablao');

            form_baja.addEventListener('submit', (e) => {
                e.preventDefault();


                $.ajax({
                    url: "bajablaomambu",
                    method: "POST",
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {},
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
            });



            /* Etiquetado*/

            const form_etiquetado = document.getElementById('etiquetadoBlao');
            const fileInput_etiquetado = document.getElementById('excelEtiquetado');
            const fileInputLabel_etiquetado = document.querySelector('.custom-file-label-etiquetado');
            // Actualizar la etiqueta del archivo seleccionado
            fileInput_etiquetado.addEventListener('change', () => {
                name = fileInput_etiquetado.files[0]?.name;
                if (name.substring(name.length - 3, name.length) == 'xls' || name.substring(name.length - 4, name
                        .length) == 'xlsx') {
                    fileInputLabel_etiquetado.textContent = fileInput_etiquetado.files[0]?.name ||
                    'Seleccionar archivo';
                } else {
                    fileInput_etiquetado.value = "";
                    Swal.fire({
                        icon: 'error',
                        title: 'El archivo no es un excel',
                    });

                }
            });

            form_etiquetado.addEventListener('submit', (e) => {
                e.preventDefault();

                const file = fileInput_etiquetado.files[0];
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

                        const mambuColumn = jsonData.map(function(row) {
                            return row[0];
                        });


                        Swal.fire({
                            title: '¡Se etiquetará la siguiente cantidad de creditos!',
                            html: 'Mambu: <b>' + mambuColumn.length + '</b>, ',
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: 'Etiquetar',
                            denyButtonText: `No etiquetar`,

                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {

                                $.ajax({
                                    url: "etiquetadoBlaomambu",
                                    method: "POST",
                                    dataType: "JSON",
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: {
                                        "mambu": mambuColumn,
                                        "jucavi": jucaviColumn
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
        </script>
    @stop
    <a href=""></a>
