@extends('layout.main')
@section('title',"Facturación")
@section('content')
<div class="row page-head">
    <div class="col-sm-12">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">Facturación

            </div>
            <div class="panel-body">

                <?php if (!count($facturas)) { ?>
                    <div class="listado-item">
                        <div class="cuerpo-listado">       
                            <div class="icon-listado"><span class="s7-note2"></span></div>
                            <div class="item-listado">
                                <span class="indicator-value-counter">No tienes facturas disponibles</span>
                            </div>

                        </div>
                    </div>
                <?php } ?>


                <?php
                foreach ($facturas as $factura) {

                    $facturaPagada = $factura->pagada ? "pagada" : "impaga";
                    $facturaVencida = $factura->vencida ? "vencida" : "no-vencida";
                    ?>

                    <div class="listado-item <?php echo $facturaPagada . " " . $facturaVencida ?>">
                        <div class="cabecera-listado">
                            <h6><?php echo $factura->NroComprobante ?></h6>
                            <time><?php echo $factura->FechaComprobante->format("d/m/Y") ?></time>
                        </div>
                        <div class="cuerpo-listado">     
                            <div class="icon-listado"><span class="s7-note2"></span></div>

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

                            </div>                  
                            <div class="item-listado">
                                <div class="indicator-value-title">Importe Total</div>
                                <span class="indicator-value-counter">$<?php echo number_format($factura->ImporteTotal, 2, ",", "."); ?></span>

                            </div>

                        </div>

                    </div>

                <?php } ?> 

            </div>
        </div>
    </div>


</div>
@endsection
