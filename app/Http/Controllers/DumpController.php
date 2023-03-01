<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DumpController extends Controller
{
    public function index(Request $request){
        //var_dump($request);
        //die();
        // dd($request); // var_Dump con los datos ordenados, aplica un die() por defecto

        //dump($request); // var_Dump con los datos ordenados, sin die()
        //dump($request)->input();
        //dump($request)->all();
        //dump(\Request::all());
        //dump(request()->all());

        //dump($request->input('variable','por'));

        //value = $request->header('X-Header-Name','nada'); // Al no encontrar esta cabecera "X-Header-Name" muestra elñ valor por defecto "nada.
        //dd($value);

        /*
        if($request->hasHeader('X-Header-Name')){
            return "tiene header name";
        } else {
            "No tiene el heaader name";
        }
        */

        //$contentTypes = $request->getAcceptableContentTypes();
        /*
        if($request->accepts(['text/html', 'application/json'])){
            return "si lo acepta";
        } else {
            return "No lo acepta";
        }
        */

        /*
        $preferred = $request->prefers(['text/html', 'application/json']);
        dd($preferred);
        */  

        /*
        if($request->expectsJSON()){
            return 'yes';
        }else{
            return 'No';
        }
        */
        /*
        $value = $request->all();
        dump($value);

        $value = $request->collect(); // Para arrays
        $value = $request->collect('variable')->each(function($num){
            echo $num;
        }); 
        dd($value);*/

        //$value = $request->boolean('guardado'); // Para booleanos
        //$value = $request->date('cumple'); // Para fechas

        //$value = $request->only('variable','por'); //Obtienes solo las dichas

        //$value = $request->except('por'); // Obtienes todas menos la dicha
        
        /*
        if($request->has(['variable','por'])){
            return 'correcto';
        }else{
            return 'falso';
        }
        */
        /*  
        $value = $request->whenHas('variable',function($input){
            return "Se ha guardado correctamente $input";
        }, function(){
            return 'no se había guardado';
        }); // Para saber si tiene una variable determinada
        */

        /*
        if($request->hasAny(['variable','meloinvento'])){
            return "Se ha encontrado alguno de los buscados";
        }else{
            return 'no se encontraba ninguno de los buscados';
        }; // Para saber si tiene alguna de las variables determinadas
        */
        /*
        if($request->filled('variable')){
            echo ' La variable existe y no está vacía';
        }
        */

        /*
        $request->whenFilled('variablew', function($input){
            echo $input;
        }, function(){
            echo "no existe la variable";
        });
        */

        /*
        if($request->missing('lalalala')){
            return "el parametro no existe";
        } else { 
            return 'si lo tiene';
        } //Comprueba si no existe una variable (miss-falta)
        */

        //dump($request->all());

        //Añade una variable
        $request->merge(['hola'=>'hi']);

        //Añade una variable solo cuando falte
        $request->mergeifMissing(['holas'=>'his']);
        dump($request->all());

        //dd($value);
        //$token = $request->bearerToken();
        //return "Sale";
    }
}
