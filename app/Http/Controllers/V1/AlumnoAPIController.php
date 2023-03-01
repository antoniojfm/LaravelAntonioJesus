<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumno;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Validator;


class AlumnoAPIController extends Controller
{
    //Lista todos los alumnos
    public function index() {
        return Alumno::get();
    }

    public function show($id) {
        //Buscar el alumno
        $alumno = Alumno::find($id);
        if(!$alumno) {
            return response()->json([
                'message' => 'Alumno not found'
            ], 404);
        }

        //Si el alumno es valido
        return $alumno;
    }

    public function store(Request $request) {
        //Validamos los datos
        $datos = $request->only('nombre','apellido','email','edad','direccion','foto');

        $validator = Validator::make($datos,[
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|max:250',
            'email' => 'required|email',
            'edad' => 'required|int|min:0|max:150',
            'direccion' => 'required|string|max:250',
            'foto' => 'required|max:20480000|mimes:jpeg,png,jpg'
        ]);

        //Si falla la validacion
        if($validator->fails()) {
            return response()->json(['error' => $validator->messages()],400);
        }

        //Creamos el alumno en la Base de datos
        $alumno = Alumno::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'edad' => $request->edad,
            'direccion' => $request->direccion,
            'foto' => $request->file('foto')->store('uploads','public'),
        ]);

        //Si esta todo bien enviamos el Json del alumno creado correctamente
        return response()->json([
            'message' => 'Alumno created succesfully',
            'datos' => $alumno,
        ], Response::HTTP_OK);

    }

    public function update(Request $request, $id) {
        //Validar los datos 
        $datos = $request->only('nombre','apellido','email','edad','direccion','foto');
        $validator = Validator::make($datos,[
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|max:250',
            'email' => 'required|email',
            'edad' => 'required|int|min:0|max:150',
            'direccion' => 'required|string|max:250',
            'foto' => 'max:20480000|mimes:jpeg,png,jpg'
        ]);

        //Si falla la validacion
        if($validator->fails()) {
            return response()->json(['error' => $validator->messages()],400);
        }

        //Buscamos la id del alumno
        $alumno = Alumno::find($id);

        $alumno->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'edad' => $request->edad,
            'direccion' => $request->direccion,
        ]);

        if($request->hasFile('foto')) {
            $alumno = Alumno::findOrFail($id);
            if(Storage::delete('public/' . $alumno->foto)) {
                $datos['foto'] = $request->file('foto')->store('uploads', 'public');
            }
        }

        $alumno->update($datos);
        
        //Si esta todo bien enviamos el Json del alumno creado correctamente
        return response()->json([
            'message' => 'Alumno updated succesfully',
            'datos' => $alumno,
        ], Response::HTTP_OK);

    }
}
