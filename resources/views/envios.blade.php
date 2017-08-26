@extends('layout.main')
@section('title',"Envíos")
@section('content')

<div class="" data-ng-controller="EnviosController">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider panel-heading-full-width">Buscar Envíos<span class="panel-subtitle">Puedes buscar por Destinatario y rango de fechas</span></div>
                <div class="panel-body">
                    <form>
                        <div class="form-group row mt-4">

                            <div class="col-5">
                                <input id="inputEmail3"  type="text" placeholder="Ingresa Destinatario" class="form-control"
                                       data-ng-model="buscar.direccionDestinatario"
                                       ng-model-options="{allowInvalid: true, debounce: 300}">
                            </div>
                            @verbatim
                            <div class="col-3">
                                <datepicker date-format="d/MM/yyyy" date-max-limit="{{buscar.fechaMaxima}}">
                                    <input  data-ng-model="buscar.fechaInicio" type="text" class="form-control datepicker" placeholder="Desde"
                                            data-ng-change="buscar.fechaChange();">
                                </datepicker>

                            </div>
                            <div class="col-3">
                                <datepicker date-format="d/MM/yyyy"  date-max-limit="{{buscar.fechaMaxima}}">
                                    <input  type="text" class="form-control datepicker" placeholder="Hasta"
                                            data-ng-model="buscar.fechaFin"
                                            data-ng-change="buscar.fechaChange();">
                                </datepicker>

                            </div>
                            @endverbatim
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-space btn-primary" data-ng-click="buscar.buscarEnvios(1)">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="row page-head">

        <div class="col-sm-12">

            <div class="panel panel-default panel-table">
                <div class="ajaxing" data-ng-show="envios.cargandoEnvios"><span></span></div>
                <div class="panel-heading">Todos los Envíos

                </div>
                <div class="panel-body">


                    <div class="listado-item" data-ng-if="!envios.listadoEnvios.length">
                        <div class="cuerpo-listado">       
                            <div class="icon-listado"><span class="s7-box2"></span></div>
                            <div class="item-listado">
                                <span class="indicator-value-counter">No tienes envíos disponibles</span>
                            </div>

                        </div>
                    </div> 

                    <?php
                    //$estadoEnvio = $envio->estado == "Entregado" ? "entregado" : "en-transito";
                    ?>
                    @verbatim
                    <div class="listado-item envio-full <?php // echo $estadoEnvio;         ?>" 


                         dir-paginate="envio in envios.listadoEnvios | itemsPerPage: pagination.enviosPerPage" 
                         total-items="pagination.totalEnvios"
                         current-page="pagination.currentPage"

                         data-ng-cloak
                         data-ng-class="{'entregado':envio.estado === 'Entregado','en-transito':envio.estado !== 'Entregado'}">
                        <div class="cabecera-listado">


                            <time>
                                {{ envios.formatearFecha(envio.fechaenvio.date)}}</time>
                            <h6>{{envio.envioid}}</h6>

                        </div>
                        <div class="cuerpo-listado">     
                            <div class="icon-listado">

                                <span class="s7-check envio-entregado" title="Entregado" data-ng-if="envio.estado === 'Entregado'"></span>
                                <div class="icono-transito" title="En tránsito" data-ng-if="envio.estado !== 'Entregado'">
                                    <img src="assets/img/delivery-truck.svg" alt="camion"/>
                                </div>

                            </div>
                            <div class="accion-listado">
                                <a href="#" class="icon" title="Ver Detalles"><i class="s7-search"></i></a>
                            </div>

                            <div class="item-listado item-listado-bultos">
                                <div class="indicator-value-title">Bultos</div>
                                <span class="indicator-value-counter">{{envio.bultos}}</span>
                            </div>
                            <div class="item-listado item-listado-direccion ">
                                <div class="indicator-value-title">Dirección</div>
                                <span class="indicator-value-counter">{{envio.domiciliodestino}} <br/> {{envio.localidaddestino}}</span>

                            </div>
                            <div class="item-listado item-listado-destinatario ">
                                <div class="indicator-value-title">Destinatario</div>
                                <span class="indicator-value-counter">{{envio.clientedestino}}</span>

                            </div>





                            <!--
                            <div class="item-listado item-listado-kilos">
                                <div class="indicator-value-title">Kilos</div>
                                <span class="indicator-value-counter"><?php // echo $envio->kilos      ?></span>


                            </div>
                            <div class="item-listado item-listado-vd">
                                <div class="indicator-value-title">Valor declarado</div>
                                <span class="indicator-value-counter">$<?php //echo $envio->valordeclarado      ?></span>

                            </div>
                            <div class="item-listado item-listado-remitos">
                                <div class="indicator-value-title">Remitos</div>
                                <span class="indicator-value-counter"><?php //echo $envio->remitos      ?></span>

                            </div>-->

                        </div>

                    </div>

                    @endverbatim


                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="contenedor-paginacion">
            <dir-pagination-controls on-page-change="pagination.envioPageChanged(newPageNumber)" template-url="assets/js/directives/dirPagination.tpl.html"></dir-pagination-controls>    
        </div>

    </div>
</div>

@endsection
