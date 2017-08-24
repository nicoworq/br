<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class LoginController extends Controller {

    protected $campoEmail = 'Email';
    protected $campoUsuarioWeb = 'UsuarioWeb';
    protected $campoPassWeb = 'ContraseñaWeb';

    public function login(Request $request) {


        $datosLogin = $request->input("usuario");

        //TODO: fix
        $clientes = Cliente::where($this->campoEmail, trim($datosLogin['email']))
                        ->orWhere($this->campoUsuarioWeb, trim($datosLogin['email']))->get();



        if (!$clientes->isEmpty()) {
            $cliente = $clientes->first();
            
            if (trim($cliente->ContraseñaWeb) === trim($datosLogin["password"])) {
                $request->session()->put('cliente', $clientes[0]);
                return ['logged' => TRUE, 'msg' => 'Redirigiendo'];
            }
        }

        return ['logged' => FALSE, 'error' => 'Usuario y/o contraseña inválidos'];
    }

}
