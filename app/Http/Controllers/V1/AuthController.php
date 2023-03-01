<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller

{   
    //Registro de Usuarios
    public function register(Request $request) {
        //Pasamos los parametros
        $data = $request->only('name','email','password');
        //Hacemos la validacion
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
        ]);

        //Devolvemos un error si falla la validacion
        if($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        //Creamos el usuario registrado
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), //bcrypt funcion que encripta cosas en este caso la contraseña
        ]);

        //Nos quedamos con la contraseña y el usuario para realizar
        //la peticion del token A JWTAuth
        $credenciales = $request->only('email','password');

        return response()->json([
            'message' => 'User Created',
            'token' => JWTAuth::attempt($credenciales),
            'user' => $user,
        ], Response::HTTP_OK);
    }

    
    //Esta funcion la utilizaremos para hacer login a partir de la api
    public function authenticate(Request $request){
        //Indicmos los parametros que queremos recibir de la request
        $credentials = $request->only('email', 'password');

        //Validación
        $validator = Validator::make($credentials, [
            'email'=> 'required|email',
            'password'=> 'required|string|min:6|max:50'
        ]);

        //Si la validación falla devolvemos un error
        if($validator->fails()){
            return response()->json(['error'=> $validator->messages()], 400);
        }

    //Intentamos hacer login
    try{
        if(!$token = JWTAuth::attempt($credentials)){
            //Credenciales incorrectas
            return response()->json(['error'=> 'Login failed'], 401);
        }
    }catch (JWTException $e){
        //Error chungo
        return response()->json(['message'=> 'Error',], 500);
    }

    // Devolver el token

    return response()->json([
        'token'=> $token,
        'user'=> Auth::user()
    ]);

    }

    public function logout(Request $request){
        //valida que nos envía el token
        $validator = Validator::make($request->only('token'), ['token'=> 'required']);

        //Fallo de validacion
        if($validator->fails()) {
            return response()->json(['error' => $validator->messages()],400);
        }

        //si el token es válido eliminamos el token desconectando al usuario
        try {
            JWTAuth::invalidate(($request->token));
            return response()->json([
                'success' => true,
                'message' => 'User disconnected'
            ]);
        }catch(JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //Funcion que utilizaremos para obtener los datos de los usuarios y validar si el token ha expirado
    public function getUser(Request $request) {
        //Validar la peticion si tiene token
        $this->validate($request, [
            'token' => 'required'
        ]);

        //Hacer la autenticacion
        $autenticacionToken = JWTAuth::authenticate();

        //Si no hay usuario a partir del token, el token no es valido o ha expirado
        if(!$autenticacionToken) {
            return response()->json([
                'message' => 'Invalid Token / Token expired',
            ], 401);
        }
        //Devolvemos los datos de los usuarios si todo va bien
        return response()->json(['user' => $autenticacionToken]);
    }
}
