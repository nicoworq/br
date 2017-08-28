@extends('layout.main')
@section('title',"Panel Principal")
@section('content')

<?php
$estadoCuenta = "primary"; //verde

if ($saldoCuenta < 0) {


    $estadoCuenta = 'warning';
}

if ($facturasVencidas) {
    $estadoCuenta = 'danger';
}
?>
<div class="" >
    <div ng-controller="DashboardController">
        <div class="row">
            <div class="col-md-12">

                <div class="widget widget-tile widget-tile-wide panel-border-color panel-border-color-<?php echo $estadoCuenta; ?>">
                    <div class="tile-info">
                        <div class="icon"><span class="s7-wallet"></span></div>
                        <div class="data-info">
                            <div class="title">Estado de Cuenta:</div>
                        </div>
                    </div>
                    <div class="tile-value">

                        <div class="">
                            <span class="estado-cuenta">$ <?php echo number_format($saldoCuenta, 2, ",", ".") ?></span>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="row page-head" >
            <div class="col-sm-6">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">Últimas facturas

                    </div>
                    <div class="panel-body">

                        <?php if (!count($facturas)) { ?>
                            <div class="listado-item">
                                <div class="cuerpo-listado">       
                                    <div class="icon-listado"><span class="s7-note2"></span></div>
                                    <div class="item-listado item-sin-facturas">
                                        <span class="indicator-value-counter">No tienes facturas disponibles</span>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>


                        <?php
                        foreach ($facturas as $factura) {

                            $facturaPagada = $factura->pagada ? "pagada" : "impaga";
                            $facturaVencida = $factura->vencida ? "vencida" : "no-vencida";

                            $diasImpaga = false;
                            if (!$factura->pagada) {
                                $hoy = new DateTime();
                                $diasImpaga = $hoy->diff($factura->FechaComprobante);
                            }
                            ?>

                            <div class="listado-item <?php echo $facturaPagada . " " . $facturaVencida ?>">
                                <div class="cabecera-listado">
                                    <h6><?php echo $factura->NroComprobante ?></h6>
                                    <time><?php echo $factura->FechaComprobante->format("d/m/Y"); ?></time>
                                </div>
                                <div class="cuerpo-listado">     
                                    <div class="icon-listado"><span class="s7-note2"></span></div>
                                    <!--
                                    <div class="accion-listado">
                                        <a href="#" class="icon" title="Descargar Factura"><i class="s7-download"></i></a>
                                    </div>
                                    -->
                                    <div class="item-listado item-listado-importe-abonado">
                                        <div class="indicator-value-title">Descargar</div>
                                        <div class="btn-doble">
                                            <a target="blank" href="<?php echo App::make('url')->to("/facturacion/descargar-factura/{$factura->NroOperacion}") ?>">Factura</a>
                                            <a target="blank" href="<?php echo App::make('url')->to("/facturacion/descargar-resumen/{$factura->NroOperacion}") ?>">Resumen</a>
                                        </div>
                                    </div> 


                                    <div class="item-listado item-listado-importe-abonado">
                                        <div class="indicator-value-title">Importe Abonado</div>
                                        <span class="indicator-value-counter">$<?php echo number_format($factura->ImportePagado, 2, ",", ".") ?></span>

                                        <?php if ($diasImpaga) { ?>
                                        <div class="dias-impaga">Impaga hace <?php echo $diasImpaga->format("%a") ?> dia/s</div>
                                        <?php } ?>
                                    </div>                  
                                    <div class="item-listado item-listado-importe-total">
                                        <div class="indicator-value-title">Importe Total</div>
                                        <span class="indicator-value-counter">$<?php echo number_format($factura->ImporteTotal, 2, ",", "."); ?></span>

                                    </div>

                                </div>

                            </div>

                        <?php } ?> 



                        <div class="btn-ver-todos">
                            <a  href="<?php echo App::make('url')->to('/facturacion') ?>" class="btn btn-space btn-primary btn-lg"><i class="icon icon-left s7-cash"></i> Ver todas las facturas</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-6">



                <div class="panel panel-default panel-table">
                    <div class="panel-heading">Últimos envíos

                    </div>
                    <div class="panel-body">



                        <?php if (!count($envios)) { ?>
                            <div class="listado-item item-sin-envios">
                                <div class="cuerpo-listado">       
                                    <div class="icon-listado"><span class="s7-box2"></span></div>
                                    <div class="item-listado ">
                                        <span class="indicator-value-counter">No tienes envíos disponibles</span>
                                    </div>

                                </div>
                            </div> 
                        <?php } ?>
                        <?php
                        foreach ($envios as $envio) {

                            $estadoEnvio = $envio->estado == "Entregado" ? "entregado" : "en-transito";
                            ?>

                            <div class="listado-item <?php echo $estadoEnvio; ?>">
                                <div class="cabecera-listado">
                                    <h6><?php echo $envio->envioid ?></h6>
                                    <time><?php echo $envio->fechaenvio->format("d/m/Y") ?></time>
                                </div>
                                <div class="cuerpo-listado">     
                                    <div class="icon-listado">
                                        <?php if ($envio->estado == "Entregado") { ?>
                                            <span class="s7-check envio-entregado" title="Entregado"></span>
                                        <?php } else { ?>
                                            <div class="icono-transito" title="En tránsito">
                                                <img src="assets/img/delivery-truck.svg" alt="camion"/>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="accion-listado">
                                        <a class="icon" title="Ver Detalles" ng-click="dashboard.traerEnvio(<?php echo $envio->envioid ?>)"><i class="s7-search"></i></a>
                                    </div>

                                    <div class="item-listado item-listado-destinatario item-listado-destinatario-home" title="<?php echo $envio->clientedestino ?>">
                                        <div class="indicator-value-title">Destinatario</div>
                                        <span class="indicator-value-counter indicator-value-counter-envio"><?php echo $envio->clientedestino ?></span>

                                    </div>

                                    <div class="item-listado item-listado-localidad item-listado-localidad-home" title="<?php echo $envio->localidaddestino ?>">
                                        <div class="indicator-value-title">Localidad</div>
                                        <span class="indicator-value-counter indicator-value-counter-envio"><?php echo $envio->localidaddestino ?></span>
                                    </div>

                                </div>

                            </div>


                        <?php } ?>



                        <div class="btn-ver-todos">
                            <a href="<?php echo App::make('url')->to('/envios') ?>" class="btn btn-space btn-primary btn-lg"><i class="icon icon-left s7-box2"></i> Ver todos los envíos</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div id="tapa-envio" class="ng-cloak" ng-show="dashboard.mostrarDetalleEnvio">
            @verbatim
            <div id="detalle-envio" ng-click="dashboard.cerrarDetalleEnvio();">
                <div id="detalle-envio-cerrar">
                    <i class="s7-close-circle"></i>
                </div>

                <div class="panel panel-default panel-table">
                    <div class="panel-heading">Detalle de Envío

                    </div>
                    <div class="panel-body">
                        <div class="listado-item listado-detalle">

                            <div class="cuerpo-listado cuerpo-listado-detalle">     

                                <div class="fila-listado-detalle">

                                    <div class=" float-left">
                                        <div class="indicator-value-title">Estado</div>
                                        <span class="indicator-value-counter">{{dashboard.envioSeleccionado.estado}}</span>
                                    </div>
                                    <div class="float-right ">
                                        <div class="indicator-value-title text-right">Fecha Envío</div>
                                        <span class="indicator-value-counter">{{dashboard.envioSeleccionado.fecha}}</span>
                                    </div>


                                </div>

                                <div class="fila-listado-detalle">
                                    <div class="float-left detalle-destinatario">
                                        <div class="indicator-value-title text-left ">Destinatario</div>
                                        <span class="indicator-value-counter">{{dashboard.envioSeleccionado.clientedestino}}</span>
                                    </div>
                                </div>
                                <div class="fila-listado-detalle">
                                    <div class="float-left detalle-localidad ">
                                        <div class="indicator-value-title text-left">Localidad</div>
                                        <span class="indicator-value-counter">{{dashboard.envioSeleccionado.localidaddestino}}</span>
                                    </div>      
                                </div>
                                <div class="fila-listado-detalle">
                                    <div class="float-left detalle-direccion">
                                        <div class="indicator-value-title text-left">Dirección</div>
                                        <span class="indicator-value-counter">{{dashboard.envioSeleccionado.domiciliodestino}}</span>
                                    </div>
                                </div>
                                <div class="fila-listado-detalle">
                                    <div class="float-left">
                                        <div class="indicator-value-title text-left">Bultos</div>
                                        <span class="indicator-value-counter">{{dashboard.envioSeleccionado.bultos}}</span>
                                    </div>

                                    <div class="float-right">
                                        <div class="indicator-value-title text-right">Valor Declarado</div>
                                        <span class="indicator-value-counter">${{dashboard.envioSeleccionado.valordeclarado}}</span>
                                    </div>


                                </div>
                                <div class="fila-listado-detalle">                              
                                    <div class="float-left">
                                        <div class="indicator-value-title text-left">Remitos</div>
                                        <span class="indicator-value-counter">{{dashboard.envioSeleccionado.remitos}}</span>
                                    </div>
                                    <div class="float-right">
                                        <div class="indicator-value-title text-right">Comprobante</div>
                                        <span class="indicator-value-counter">{{dashboard.envioSeleccionado.nrocomprobante}}</span>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>



            </div>
            @endverbatim
        </div>


    </div>
</div>
@endsection
