<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller {

    public function verificarEmail(Request $request) {

        $email = $request->input("email");

        $clientes = Cliente::where('Email', trim($email))->get();
        if (count($clientes)) {
            return ['cliente-existente' => TRUE];
        } else {
            return ['cliente-existente' => FALSE];
        }
    }

    public function recuperarPassword(Request $request) {
        $usuario = $request->input("usuario");
        $email = trim($usuario['email']);

        $clientes = Cliente::where('Email', $email)->get();

        if (count($clientes)) {
            $cliente = $clientes->first();
        } else {
            return ['send' => true, 'error' => 'El email no pertenece a un cliente.'];
        }

        try {
            $send = Mail::send('emails.restore', [ "cliente" => $cliente], function ($m) use ($cliente) {
                        $m->from('no-reply@brio.com.ar', 'Extranet Brio');

                        $m->to($cliente->Email, 'Cliente Brio')->subject('Datos de acceso extranet');
                    });

            return ['send' => TRUE];
        } catch (\Exception $e) {
            dd($e->getMessage());
            return ['send' => false, 'error' => dd($e->getMessage())];
        }
    }

    public function solicitarAcceso(Request $request) {

        $usuario = $request->input("usuario");

        $email = trim($usuario['email']);
        $password = trim($usuario['password']);
        $usuarioIngresado = trim($usuario['user']);
        $clientes = Cliente::where('Email', $email)->get();

        if (count($clientes)) {
            $cliente = $clientes->first();
        } else {
            return ['send' => false, 'error' => 'El email no pertenece a un cliente.'];
        }

        try {
            $send = Mail::send('emails.registro', ['email' => $email, 'password' => $password, "cliente" => $cliente, 'usuarioIngresado' => $usuarioIngresado], function ($m) {
                        $m->from('no-reply@brio.com.ar', 'Extranet');

                        $m->to('nicolas@worq.com.ar', 'Registro')->subject('Nuevo registro de usuario');
                    });

            return ['send' => TRUE];
        } catch (\Exception $e) {
            dd($e->getMessage());
            return ['send' => false, 'error' => dd($e->getMessage())];
        }
    }

}
