<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Envio;
use App\Factura;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller {

    public function actualizarDatosPersonales(Request $request) {
        if (!$request->session()->has('cliente')) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta seccion');
        }

        $nuevosDatos = $request->input('nuevosDatos');

        $cliente = $request->session()->get('cliente');
        $nuevosDatos['ClienteID'] = $cliente->ClienteID;

        try {
            $send = Mail::send('emails.datos', [ "nuevosDatos" => $nuevosDatos], function ($m) use ($nuevosDatos) {
                        $m->from('no-reply@brio.com.ar', 'Extranet Brio');

                        $m->to('sistemas1@brio.com.ar', 'Mariano')->subject('Modificacion de Datos de Cliente');

                        $m->cc('sistemas@brio.com.ar', 'Alejandro');
                        $m->bcc('nicolas@worq.com.ar', 'Prueba');
                    });

            return ['modificado' => TRUE];
        } catch (\Exception $e) {
            dd($e->getMessage());
            return ['modificado' => false, 'error' => dd($e->getMessage())];
        }
    }

    public function datosPersonales(Request $request) {

        if (!$request->session()->has('cliente')) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta seccion');
        }

        $cliente = $request->session()->get('cliente');
        return view('datos', [
            'cliente' => $cliente,
        ]);
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'Cerraste sesión correctamente.');
    }

    public function view(Request $request) {

        if (!$request->session()->has('cliente')) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta seccion');
        }

        $cliente = $request->session()->get('cliente');

        //$cliente = Cliente::where('ClienteID', 95)->get()->first();

        $envios = Envio::where('clienteidorigen', $cliente->ClienteID)->orderBy('fechaenvio', 'desc')->limit(5)->get();
        $facturas = Factura::where('ClienteID', $cliente->ClienteID)->orderBy('FechaComprobante', 'desc')->limit(5)->get();

        $condicionCobro = intval($cliente->DiasSaldoPendiente);

        $estadoFacturasCuenta = $this->estadoFacturasCuenta($facturas, $condicionCobro);

        return view('dashboard', [
            'cliente' => $cliente,
            'envios' => $envios,
            'facturas' => $estadoFacturasCuenta['facturas'],
            'saldoCuenta' => $estadoFacturasCuenta['saldoCuenta'],
            'facturasVencidas' => $estadoFacturasCuenta['vencidas']
        ]);
    }

    public function traerEnvio($id_envio) {
        $envio = Envio::where('envioid', $id_envio)->get()->first();
        $envio->fecha = $envio->fechaenvio->format("d/M/Y");
        return $envio;
    }

    private function estadoFacturasCuenta($facturas, $condicionCobro) {

        $aPagar = 0;
        $pagado = 0;
        $tieneFacturasVencidas = FALSE;

        foreach ($facturas as $f) {

            if ($f->ImportePagado < $f->ImporteTotal) {
                $f->pagada = FALSE;

                $fechaComprobante = $f->FechaComprobante;
                $hoy = Carbon::now();
                $dif = $fechaComprobante->diff($hoy);

                if ($dif->days > $condicionCobro) {
                    $tieneFacturasVencidas = TRUE;
                    $f->vencida = TRUE;
                } else {
                    $f->vencida = FALSE;
                }
            } else {
                $f->pagada = TRUE;
            }



            $pagado += $f->ImportePagado;
            $aPagar += $f->ImporteTotal;
        }


        return ['facturas' => $facturas, 'saldoCuenta' => $pagado - $aPagar, 'vencidas' => $tieneFacturasVencidas];
    }

}
