<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function bienvenidoNick($name, $nick) {
        return "Bienvenido $name tu apodo es $nick";
    }

    public function bienvenidoNoNick($name) {
        return "Bienvenido $name no tienes apodo";
    }

}
