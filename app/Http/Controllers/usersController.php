<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class usersController extends Controller
{

    public function usuarios()
    {
        return view('usuarios.usuarios');
    }

    public function guardar(Request $request)
    {

        try {
            // Validar los datos del formulario


            $request->validate([
                'usuario' => 'required',
                'contrasena' => ['required', 'string', 'min:8'],
                'tipo' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);

            // Crear una nueva instancia del modelo Usuario
            $usuario = new User();
            $usuario->name = $request->usuario;
            $usuario->password = Hash::make($request->contrasena);
            $usuario->type = $request->tipo;
            $usuario->email = $request->email;


            // Guardar el usuario en la base de datos
            $usuario->save();
            // Devolver una respuesta de éxito
            return response()->json(['message' => 'Usuario creado correctamente'], 200);
        } catch (Exception $e) {
            // Devolver una respuesta de error
            return response()->json(['message' => 'Error al crear el usuario'], 500);
        }
    }

}
