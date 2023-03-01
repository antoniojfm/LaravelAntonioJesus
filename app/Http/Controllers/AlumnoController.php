<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AlumnoController extends Controller
{
    public function index() {
        //$datos['alumnos'] = Alumno::all(); Esto nos envia a la vista los datos de la base de datos
        $edad = 22;
        // $datos['alumnos'] = DB::select('select * from alumnos where edad > ?', [$edad]);
        $datos['alumnos'] = Alumno::paginate(5);
        return view('alumno.index', $datos);
    }

    public function create() {
        return view('alumno.create');
    }

    public function store(Request $request) {

        //Validacion
        $campos = [
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|max:250',
            'email' => 'required|email',
            'edad' => 'required|int|min:0|max:150',
            'direccion' => 'required|string|max:250',
            'foto' => 'required|max:20480000|mimes:jpeg,png,jpg'
        ];

        $mensaje = [
            'required' => 'El campo :attribute es obligatorio',
            'foto.required' => 'La foto es obligatoria',
            'nombre.required' => 'El nombre es obligatorio',
            'apellido.required' => 'El apellido es obligatorio',
            'email.required' => 'El email es obligatorio',
            'max' => 'El campo :attribute no puede tener mas de 250 caracteres',
            'email.email' => 'El campo email no tiene el formato correcto',
            'foto.mimes' => 'La foto no tiene el formato correcto debe tener algun formato :values',

        ];

        $this->validate($request, $campos, $mensaje);

        $datosAlumnos = $request->except('_token');

        //Si el objeto tiene un fichero en este caso foto
        if($request->hasFile('foto')) {
            $datosAlumnos['foto'] = $request->file('foto')->store('uploads','public'); //Nos guarde la imagen en (store app public uploads) y tambien en la base de datos 
        }

        Alumno::insert($datosAlumnos);
        
        return redirect('alumno')->with('mensaje', 'Se ha creado el alumno ' . $datosAlumnos['nombre']);
    }

    public function show($id) {
        $alumno = Alumno::findOrFail($id);
        return view('alumno.show',compact('alumno'));
    }

    public function edit($id) {
        $alumno = Alumno::findOrFail($id);
        return view('alumno.edit', compact('alumno'));
    }

    public function update(Request $request, $id) {
        $datosAlumnos = $request->except('_token', '_method');
        if($request->hasFile('foto')) {
            $alumno = Alumno::findOrFail($id);
            if(Storage::delete('public/' . $alumno->foto)) {
                $datosAlumnos['foto'] = $request->file('foto')->store('uploads', 'public');
            }
        }
        Alumno::where('id','=', $id)->update($datosAlumnos);
        $alumno = Alumno::findOrFail($id);
        return view('alumno.edit', compact('alumno'));
    }

    public function destroy($id) {
        //Obtiene un objeto del modelo y si no lo encuentra devuelve null o error
        $alumno = Alumno::findOrFail($id);

        if(Storage::delete('public/' . $alumno->foto)) {
            Alumno::destroy($id);
            DB::delete();
        }
        
        return redirect('alumno')->with('mensaje','Se ha eliminado el alumno #' . $id);
    }
    
}

// //Consultas generales que no devuelven nada
// DB::statement('drop table alumnos');

// //Consultas no preparadas
// DB::unprepared('update alumnos set edad = 20 where id = 10');

// Transacciones sirven para hacer consultas y que dependan del resultado de una si por ejemplo la primera funciona la segunda tambien depende de la primera 
// y entonces funcionara lo intentara hacer el numero de veces que se ponga en la funcion en este caso 5
// DB::transaction(function(){
//     DB::update('update users set edad = 33');
//     DB::delete('delete from posts');
// }, 5);

// //otra forma de hacer las transacciones
// DB::beginTransaction();

// DB::rollBack();

// DB::commit();