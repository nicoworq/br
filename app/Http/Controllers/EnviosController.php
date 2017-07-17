<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Envio;
use App\Factura;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class EnviosController extends Controller {

    public function view(Request $request) {
        //$cliente = Cliente::where('ClienteID', 95)->get()->first();

        if (!$request->session()->has('cliente')) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta seccion');
        }

        $cliente = $request->session()->get('cliente');

        $envios = Envio::where('clienteidorigen', $cliente->ClienteID)->get();


        return view('envios', ['cliente' => $cliente, 'envios' => $envios]);
    }

}
