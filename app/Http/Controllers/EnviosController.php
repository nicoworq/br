<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Envio;
use App\Factura;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class EnviosController extends Controller {

    private $perPage = 5;

    public function view(Request $request) {
        //$cliente = Cliente::where('ClienteID', 95)->get()->first();

        if (!$request->session()->has('cliente')) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta seccion');
        }

        $cliente = $request->session()->get('cliente');


        return view('envios', ['cliente' => $cliente]);
    }

    public function traerEnvios($page, Request $request) {

        if (!$request->session()->has('cliente')) {
            return Response::json(['error' => 'Debe iniciar sesión para ver esta seccion'], 500); // Status code here
        }

        $offset = $page == 1 ? 0 : ($page - 1) * $this->perPage;

        $cliente = $request->session()->get('cliente');

        $envios = Envio::where('clienteidorigen', $cliente->ClienteID);

        $countEnvios = $envios->count();

        $envios->limit($this->perPage)->offset($offset)->orderBy('fechaenvio', 'desc');

        //return array('prescriptions' => $prescriptions->get()->load('doctor', 'patient', 'area', 'area.institution', 'status'), 'count' => $countPrescriptions, 'offset' => $offset);

        return ['cliente' => $cliente, 'envios' => $envios->get(), 'count' => $countEnvios, 'offset' => $offset];
    }

    public function buscarEnvios(Request $request) {

        if (!$request->session()->has('cliente')) {
            return Response::json(['error' => 'Debe iniciar sesión para ver esta seccion'], 500); // Status code here
        }

        $search = json_decode($request->input('searchFront'), TRUE);

        $cliente = $request->session()->get('cliente');
        $resultado = Envio::where('clienteidorigen', $cliente->ClienteID);

        if (array_key_exists('direccionDestinatario', $search) && $search['direccionDestinatario'] !== '') {
            $resultado->where('clientedestino', 'LIKE', '%' . $search['direccionDestinatario'] . '%'); //->orWhere('domiciliodestino','LIKE', '%' . $search['direccionDestinatario'] . '%');
        }

        if (array_key_exists('fechaInicio', $search) && $search['fechaInicio'] !== '' && array_key_exists('fechaFin', $search) && $search['fechaFin'] !== '') {
            $inicio = Carbon::createFromFormat('d/m/Y', $search['fechaInicio'], 'America/Argentina/Buenos_Aires');

            $inicio->hour(0);
            $inicio->minute(0);
            $inicio->second(0);

            $fin = Carbon::createFromFormat('d/m/Y', $search['fechaFin'], 'America/Argentina/Buenos_Aires');
            $fin->hour(0);
            $fin->minute(0);
            $fin->second(0);
            $resultado->whereBetween('fechaenvio', [$inicio, $fin]);
        }

        $page = $search['pageNumber'];

        $offset = $page == 1 ? 0 : ($page - 1) * $this->perPage;

        $countEnvios = $resultado->count();

        $resultado->limit($this->perPage)->offset($offset)->orderBy('fechaenvio', 'desc');

        return ['cliente' => $cliente, 'envios' => $resultado->get(), 'count' => $countEnvios, 'offset' => $offset];
    }

}
