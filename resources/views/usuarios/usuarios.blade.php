@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Modulo creacion</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Hola mundo</h1>
        </div>
        <div class="card-body">
            <form id="formulario">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="usuario">Usuario:</label>
                    </div>
                    <div class="col">
                        <input type="text" id="usuario" required name="usuario" class="form-input"> <br><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="contrasena">Contraseña generada:</label>
                    </div>
                    <div class="col">
                        <input type="text" id="contrasena" name="contrasena" readonly class="form-input"> <br><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="tipo">Tipo:</label>
                    </div>
                    <div class="col">
                        <select id="tipo" name="tipo" class="form-select" required>
                            <option value="1">Super Administrador</option>
                            <option value="2">Administrador</option>
                            <option value="3">Ejecutivo</option>
                        </select><br><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="email">Email:</label>
                    </div>
                    <div class="col">
                        <input type="email" id="email" required class="form-input" name="email"><br><br>
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <input type="submit" value="Enviar" class="btn btn-primary">
                    </div>
                </div>


            </form>
        </div>
    @stop

    @section('css')

    @stop

    @section('js')
        <script>
            $(document).ready(function() {
                generarContrasena();


                $('#formulario').submit(function(e) {
                    e.preventDefault(); // Evitar la recarga de la página

                    // Obtener los datos del formulario
                    var datosFormulario = $(this).serialize();

                    // Realizar la solicitud AJAX con jQuery
                    $.ajax({
                        url: '/guardar-usuario', // Ruta al controlador de Laravel
                        type: 'POST',
                        data: datosFormulario, // Enviar los datos del formulario
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                '¡Gracias por esperar!',
                                response.message,
                                'success'
                            )
                        },
                        error: function(xhr) {
                            Swal.fire(
                                '¡Gracias por esperar!',
                                "El email ya se encuentra registrado",
                                'error'
                            )
                        }
                    });
                });
            });

            function generarContrasena() {
                var caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
                var contrasena = '';

                for (var i = 0; i < 8; i++) {
                    var index = Math.floor(Math.random() * caracteres.length);
                    contrasena += caracteres.charAt(index);
                }

                document.getElementById('contrasena').value = contrasena;
            }
        </script>
    @stop
