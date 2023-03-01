<?php

use App\Http\Controllers\AlumnoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeUserController;
use App\Http\Middleware\CheckAge;
use App\Http\Controllers\DumpController;
use Illuminate\Support\Facades\Auth;
use App\Mail\Notification;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// La ruta / debe devolver una vista llamada welcome1.

Route::get('/', function () {
    return view('welcome1');
});

// La ruta /saludo1 debe devolver la vista welcome2.
// Crear una ruta para saludar al usuario, que acepte como parámetro su nombre y escriba: “Bienvenido, nombre!”. La url tendría que ser /saludo1/nombre

Route::get('/saludo1/{nombre}', function(string $name) {
    return view('welcome2', ['name' => $name]);
});

// Crear una ruta para saludar al usuario con url /saludo1/nombre/nick, que acepte como parámetro el nombre del 
// usuario y de forma opcional su nickname y escriba "Bienvenido nombre, tu apodo es nickname” cuando se especifique, 
// y "Bienvenido nombre, no tienes apodo” en caso contrario.

Route::get('/saludo1/{nombre}/{nick?}', function($name, $nickname = NULL) {
    if($nickname) {
        return "Bienvenido, {{$name}}, no tienes apodo";
    }
    else {
        return  "Bienvenido, {{$name}}, tu apodo es {{$nickname}}";
    }
});

// Crea una ruta para editar usuarios 
// (la URL debería tener el formato /usuarios/{ID del usuario aquí}/edit). Debe devolver: “Hola, usuario ID!”
// Nota: La ID sólo debería aceptar enteros.

Route::get('/usuarios/{ID}/edit', function($id) {
    return "Hola, usuario $id";
})->where(['ID' => '[0-9]+']);

// Crear la ruta con url saludoTodos que acepte todos los verbos http.

Route::match(['get','post','put','delete','patch','options'], '/saludoTodos', function() {
    return 'Acepta todos los verbos';
});

// Crear un grupo de rutas que compartan el prefijo saludo2 con las siguientes rutas:
//    saludo2                que devuelve la vista welcome2
//    saludo2/uno        que devuelve la vista welcome2
//    saludo2/{id}        que solo acepta id como numero entero de 3 digitos y escriba: Hola, id!
//    saludo2/{nombre}    que solo acepta nombres de 4 caracteres alfanumericos de longitud, y escriba: nombre tiene 4 letras.

Route::prefix('saludo2')->group(function(){

    Route::get('/', function() {
        return view('welcome2');
    });

    Route::get('/uno', function() {
        return view('welcome2');
    });

    Route::get('/{id}', function($id) {
        return "Hola, $id";
    })->where(['id' => '[0-9]{1,3}']);

    Route::get('/{nombre}', function($name) {
        return $name . " tiene entre 1 y 4 letras";
    })->where(['nombre' => '[0-9]{1,4}']);

});

// Crear una ruta /saludoUno que redirija a la url saludo1 y /saludoDos a la url saludo2.

Route::get('/saludoUno', function() {
    return redirect('/saludo1');
});

Route::get('/saludoDos', function() {
    return redirect('/saludo2');
});

// Finalmente habrá una ruta por defecto que mostrará el mensaje “ERROR 404”, que capturara las peticiones inválidas.

Route::fallback(function() {
    return "ERROR 404";
});

// Renombrar la primera ruta /saludo1 a primerSaludo.

Route::get('/saludo1', function() {
    return rename('/saludo1','primerSaludo');
});




//Mueve el código de la ruta para editar usuarios que creaste en el ejercicio de rutas ( /usuarios/{ID del usuario aquí}/edit), a una nueva acción edit dentro de UserController.

Route::get('/usuarios/{id}/edit', [UserController::class, 'edit']);


// Divide la ruta de saludo /saludo1/nombre/nick en 2 rutas diferentes que apunten a 2 acciones diferentes, 
// para de esta manera eliminar la necesidad de un condicional y el parámetro opcional. 
// Deben asociarse con el controlador WelcomeUserController.

Route::get('/saludo1/{nombre}/{nick}', [WelcomeUserController::class, 'bienvenidoNick']);
Route::get('/saludo1/{nombre}', [WelcomeUserController::class, 'bienvenidoNoNick'])->middleware('checkage');

Route::get('/dump/{id}/{name}',[DumpController::class, 'index']);

// Route::get('alumno', [AlumnoController::class, 'index']);
// Route::get('alumno/create', [AlumnoController::class, 'create']);
// Crea el recurso con estos metodos: Route::resource('alumno', AlumnoController::class)->only(['index', 'show', 'update', 'destroy', 'store', 'edit', 'create']);
Route::resource('alumno', AlumnoController::class)->middleware('auth');


Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(
    ['middleware' => 'auth'], function () {
    Route::get('/', [AlumnoController::class], 'index')->name('home');
});



//Enviar email
Route::get('/email', function(){
    //Devolver un objeto Notification renderizado, al que le hemos pasado los parámetros necesarios
    $mensaje = new Notification("Juan");

    $response = Mail::to('antonio.fernandez@escuelaestech.es')->send($mensaje);
    dump($response);

});
