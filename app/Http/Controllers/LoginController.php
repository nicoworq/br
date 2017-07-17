<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class LoginController extends Controller {

    protected $campoEmail = 'EmailEnvioCompCtaCte';

    public function login(Request $request) {


        $datosLogin = $request->input("usuario");

        //TODO: fix
        $cliente = Cliente::where($this->campoEmail, "LIKE", '%' . $datosLogin['email'] . '%')->get();

        if (!$cliente->isEmpty()) {
            if (!$request->session()->has('cliente')) {
                $request->session()->put('cliente', $cliente->first());
            }
            return ['logged' => TRUE, 'msg' => 'Redirigiendo'];
        } else {

            return ['logged' => FALSE, 'error' => 'Usuario y/o contraseña inválidos'];
        }
    }

}
