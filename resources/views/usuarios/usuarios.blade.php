@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Administración de cuentas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Crear usuario</h1>
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
                        <input type="submit" value="Crear" class="btn btn-success">
                    </div>
                </div>


            </form>
        </div>
        <br>
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Editar usuario</h1>
            </div>
            <div class="card-body">
                <form id="actualizar">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="usuario">Usuario:</label>
                        </div>
                        <select name="id" id="id" class="form-control">
                            @foreach ($usuarios as $usuario)
                                <option value="{{ encrypt($usuario->id) }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="contrasena">Nueva contraseña:</label>
                        </div>
                        <div class="col">
                            <input type="text" id="contrasenaactualizar" name="contrasena" readonly class="form-input">
                            <br><br>
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
                            <input type="submit" value="Actualizar" class="btn btn-primary">
                        </div>
                    </div>


                </form>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Eliminar usuario</h1>
            </div>
            <div class="card-body">
                <form id="eliminar">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="usuario">Usuario:</label>
                        </div>
                        <select name="id" id="id" class="form-control">
                            @foreach ($usuarios as $usuario)
                                <option value="{{ encrypt($usuario->id) }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Eliminar" class="btn btn-danger">
                        </div>
                    </div>


                </form>
            </div>
        </div>
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
                        );
                        generarContrasena();
                    },
                    error: function(xhr) {
                        Swal.fire(
                            '¡Gracias por esperar!',
                            "Existe un error: " + xhr,
                            'error'
                        )
                    }
                });
            });
            $('#actualizar').submit(function(e) {
                e.preventDefault(); // Evitar la recarga de la página

                // Obtener los datos del formulario
                var datosFormulario = $(this).serialize();

                // Realizar la solicitud AJAX con jQuery
                $.ajax({
                    url: '/actualizar-usuario', // Ruta al controlador de Laravel
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
                        );
                        generarContrasena();
                    },
                    error: function(xhr) {
                        Swal.fire(
                            '¡Gracias por esperar!',
                            "Existe un error: " + xhr,
                            'error'
                        )
                    }
                });
            });
            $('#eliminar').submit(function(e) {
                e.preventDefault(); // Evitar la recarga de la página

                // Obtener los datos del formulario
                var datosFormulario = $(this).serialize();

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Esta accion no puede ser revertida!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, elminar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: '/eliminar', // Ruta al controlador de Laravel
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
                                );
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    '¡Gracias por esperar!',
                                    "Existe un error: " + xhr,
                                    'error'
                                )
                            }
                        });
                    } else {

                    }
                })




                // Realizar la solicitud AJAX con jQuery

            });
        });

        function generarContrasena() {
            var caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
            var contrasena = '';
            var contrasena2 = '';

            for (var i = 0; i < 8; i++) {
                var index = Math.floor(Math.random() * caracteres.length);
                contrasena += caracteres.charAt(index);
            }

            for (var j = 0; j < 8; j++) { // Cambia 'i' a 'j' aquí
                var index = Math.floor(Math.random() * caracteres.length);
                contrasena2 += caracteres.charAt(index);
            }

            document.getElementById('contrasena').value = contrasena;
            document.getElementById('contrasenaactualizar').value =
                contrasena2; // Cambia el nombre de la variable aquí también
        }
    </script>
@stop
