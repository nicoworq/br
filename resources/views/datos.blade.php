@extends('layout.main')
@section('title',"Datos Personales")
@section('content')
<div class="row page-head" id="datos" ng-controller="DatosController">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-divider" style="margin: 0;padding: 24px 20px 14px;margin-bottom: 30px;">Datos Personales

            </div>
            <div class="panel-body">

                <div role="alert" class="alert alert-success alert-dismissible" ng-show="datos.mostrarSuccess" ng-cloak>
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                        <span aria-hidden="true" class="s7-close"></span>
                    </button><span class="icon s7-check"></span><strong>Operacion realizada!</strong> Hemos notificado tu cambio. Tendrás tus datos actualizados en 24hs hábiles.
                </div>

                <div role="alert" class="alert alert-danger alert-dismissible" ng-show="datos.mostrarError" ng-cloak>
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                        <span aria-hidden="true" class="s7-close"></span>
                    </button><span class="icon s7-close"></span><strong>Operacion no realizada</strong> Ocurrió un error al actualizar. Intenta nuevamente o contactate al  0810-345-Brio (2746).
                </div>

                <form name="formdatos" >
                    <div class="ajaxing" ng-show="datos.cargando" ng-cloak><span></span></div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Nombre cliente</label>
                        <div class="col-6">
                            <input type="text" name="nombre" class="form-control" ng-model="datos.usuario.nombre" value="<?php echo $cliente->ClienteNombre ?>" required>
                            <ul class="parsley-errors-list filled ng-cloak" id="parsley-id-5" ng-show="!formdatos.nombre.$pristine && formdatos.nombre.$invalid"><li class="parsley-required">Ingrese un nombre</li></ul>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Domicilio</label>
                        <div class="col-6">
                            <input type="text" name="domicilio" class="form-control" ng-model="datos.usuario.domicilio" value="<?php echo $cliente->DomicilioFiscal ?>" required>
                            <ul class="parsley-errors-list filled ng-cloak" id="parsley-id-5" ng-show="!formdatos.domicilio.$pristine && formdatos.domicilio.$invalid"><li class="parsley-required">Ingrese un domicilio</li></ul>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Código postal</label>
                        <div class="col-6">
                            <input type="text" name="codigopostal" class="form-control" ng-model="datos.usuario.codigoPostal" value="<?php echo $cliente->CodigoPostalFiscal ?>" required> 
                            <ul class="parsley-errors-list filled ng-cloak" id="parsley-id-5" ng-show="!formdatos.codigopostal.$pristine && formdatos.codigopostal.$invalid"><li class="parsley-required">Ingrese un codigo postal</li></ul>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Teléfono</label>
                        <div class="col-6">
                            <input type="text" name="telefono" class="form-control" ng-model="datos.usuario.telefono" value="<?php echo $cliente->Telefono ?>" required>
                            <ul class="parsley-errors-list filled ng-cloak" id="parsley-id-5" ng-show="!formdatos.telefono.$pristine && formdatos.telefono.$invalid"><li class="parsley-required">Ingrese un teléfono</li></ul>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Email:</label>
                        <div class="col-6">
                            <input type="email" name="email" class="form-control" ng-model="datos.usuario.email" value="<?php echo $cliente->Email ?>" required>
                            <ul class="parsley-errors-list filled ng-cloak" id="parsley-id-5" ng-show="!formdatos.email.$pristine && formdatos.email.$invalid"><li class="parsley-required">Ingrese un email válido</li></ul>
                        </div>
                    </div>

                    <div class="text-center modificar-datos-bt" >
                        <a href="<?php echo App::make('url')->to('/dashboard') ?>" class="btn btn-secondary">Volver</a>
                        <button class="btn btn-primary" ng-click="datos.modificarDatos()" ng-disabled="formdatos.$invalid || formdatos.$pristine">Modificar Datos</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <script>
                window.usuario = {
                    nombre: '<?php echo $cliente->ClienteNombre ?>',
                    domicilio: '<?php echo $cliente->DomicilioFiscal ?>',
                    codigoPostal: '<?php echo $cliente->CodigoPostalFiscal ?>',
                    telefono: '<?php echo $cliente->Telefono ?>',
                    email: '<?php echo $cliente->Email ?>',
                }
    </script>

</div>
@endsection
