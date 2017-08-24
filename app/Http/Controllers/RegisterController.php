<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller {

    public function register(Request $request) {

        $email = $request->input("email");
        $password = $request->input("password");
        echo $email;
        echo $password;

        try {
            $send = Mail::send('emails.registro', ['email' => $email, 'password' => $password], function ($m) {
                $m->from('no-reply@brio.com.ar', 'Extranet');

                $m->to('nicolas@worq.com.ar', 'Registro')->subject('Nuevo registro de usuario');
            });
            var_dump($send);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }



        
        echo "mail!";

        /*
          if (!$cliente->isEmpty()) {
          if (!$request->session()->has('cliente')) {
          $request->session()->put('cliente', $cliente->first());
          }
          return ['logged' => TRUE, 'msg' => 'Redirigiendo'];
          } else {

          return ['logged' => FALSE, 'error' => 'Usuario y/o contraseña inválidos'];
          } */
    }

}
