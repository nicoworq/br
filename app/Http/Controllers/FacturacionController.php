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

    public function descargarFactura($nroOperacion, Request $request) {
        if (!$request->session()->has('cliente')) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta seccion');
        }

        $cliente = $request->session()->get('cliente');

        $factura = Factura::where("ClienteID", $cliente->ClienteID)->where("NroOperacion", $nroOperacion)->get()->first();

        if ($factura != NULL) {

            //detecto si es carta de porte
            $carpetaFactura = "efactura";
            if (substr($factura->NroComprobante, 0, 1) === 'X') {
                $carpetaFactura = "ecartaporte";
            }

            $dir = public_path('documentos' . DIRECTORY_SEPARATOR . $carpetaFactura . DIRECTORY_SEPARATOR);
            $archivo = $factura->NroComprobante . ".pdf";
            if (file_exists($dir . $archivo)) {
                return response()->file($dir . $archivo);
            } else {
                return redirect()->route('facturacion')->with('error', "No encontramos la factura solicitada | {$archivo}");
            }
        } else {
            return redirect()->route('facturacion')->with('error', "No encontramos la factura solicitada | {$archivo}");
        }
    }

    public function descargarResumen($nroOperacion, Request $request) {
        if (!$request->session()->has('cliente')) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta seccion');
        }

        $cliente = $request->session()->get('cliente');

        $factura = Factura::where("ClienteID", $cliente->ClienteID)->where("NroOperacion", $nroOperacion)->get()->first();

        if ($factura != NULL) {
            
            $carpetaFactura = "ereportesctacte";       

            $dir = public_path('documentos' . DIRECTORY_SEPARATOR . $carpetaFactura . DIRECTORY_SEPARATOR);
            
            $archivo = "ResumenCta00{$nroOperacion}-{$factura->FechaComprobante->format('dmY')}.pdf";

            if (file_exists($dir . $archivo)) {
                return response()->file($dir . $archivo);
            } else {
                return redirect()->route('facturacion')->with('error', "No encontramos el resumen solicitado | {$archivo}");
            }
        } else {
            return redirect()->route('facturacion')->with('error', "No encontramos el resumen solicitado | {$archivo}");
        }
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
