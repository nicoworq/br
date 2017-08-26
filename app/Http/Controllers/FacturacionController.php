<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Envio;
use App\Factura;
use Carbon\Carbon;

class FacturacionController extends Controller {

    public function view(Request $request) {
        //$cliente = Cliente::where('ClienteID', 95)->get()->first();
        if (!$request->session()->has('cliente')) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta seccion');
        }

        $cliente = $request->session()->get('cliente');

        
        $facturas = Factura::where('ClienteID', $cliente->ClienteID)->orderBy('FechaComprobante', 'desc')->get();

        $condicionCobro = intval($cliente->CondicionesCobranza);

        $estadoFacturasCuenta = $this->estadoFacturasCuenta($facturas, $condicionCobro);

        return view('facturacion', ['cliente' => $cliente, 'facturas' => $estadoFacturasCuenta['facturas'], 'saldoCuenta' => $estadoFacturasCuenta['saldoCuenta']]);
    }

    private function estadoFacturasCuenta($facturas, $condicionCobro) {

        $aPagar = 0;
        $pagado = 0;

        foreach ($facturas as $f) {

            if ($f->ImportePagado < $f->ImporteTotal) {
                $f->pagada = FALSE;
            } else {
                $f->pagada = TRUE;
            }

            $fechaComprobante = Carbon::createFromFormat('Y-m-d G:i:s', $f->FechaComprobante);
            $hoy = Carbon::now();
            $dif = $fechaComprobante->diff($hoy);

            if ($dif->days > $condicionCobro) {
                $f->vencida = TRUE;
            } else {
                $f->vencida = FALSE;
            }

            $pagado += $f->ImportePagado;
            $aPagar += $f->ImporteTotal;
        }


        return ['facturas' => $facturas, 'saldoCuenta' => $pagado - $aPagar];
    }

}
