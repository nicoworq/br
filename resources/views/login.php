<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/favicon.ico" type="image/icon" >
        <title>Expreso Brio - Acceder</title>
        <link rel="stylesheet" type="text/css" href="assets/lib/stroke-7/style.css"/>
        <link rel="stylesheet" href="assets/css/app.min.css" type="text/css"/>
        <link rel="stylesheet" href="assets/css/worq.min.css" type="text/css"/>
    </head>
    <body class="mai-splash-screen" id="login" data-ng-app="brioApp">

        <?php if (Session::has('error')) { ?>
            <div role="alert" class="alert alert-danger alert-dismissible">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true" class="s7-close"></span></button>
                <span class="icon s7-close"></span><strong>Error!</strong> <?php echo Session::get('error'); ?>
            </div>
        <?php } ?>

        <?php if (Session::has('success')) { ?>
            <div role="alert" class="alert alert-contrast alert-success alert-dismissible">
                <div class="icon"><span class="s7-check"></span></div>
                <div class="message">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                        <span aria-hidden="true" class="s7-close"></span></button>
                    <?php echo Session::get('success'); ?>
                </div>
            </div>
        <?php } ?>
        <div class="mai-wrapper mai-login">
            <div class="main-content container " ng-controller="LoginController">
                <div class="splash-container row">
                   <!-- <div class="col-sm-6 user-message"><span class="splash-message text-right">Bienvenido<br> a nuestra<br> Área de Clientes</span><span class="alternative-message text-right">No tienes cuenta? <a href="#">Regístrate</a></span></div>-->
                    <div class="col-sm-6 form-message">
                        <div class="ajaxing ng-cloak" ng-show="login.cargando"><span></span></div>
                        <img src="assets/img/logo-brio.svg" alt="logo" height="70" class="logo-img mb-4">
                        <span class="splash-description text-center mt-5 mb-5">Acceso Área de Clientes</span>
                        <form novalidate name="loginform" >
                            <div class="form-group">
                                <div class="input-group"><span class="input-group-addon"><i class="icon s7-user"></i></span>
                                    <input id="username" ng-model="login.usuario.email" ng-keypress="login.mostrarError = false" type="text" placeholder="Usuario" autocomplete="off" class="form-control" required>
                                </div>
                                <ul class="parsley-errors-list filled ng-cloak" id="parsley-id-5" ng-show="login.mostrarError" ><li class="parsley-required">{{login.errorUsuario}}</li></ul>
                            </div>
                            <div class="form-group">
                                <div class="input-group"><span class="input-group-addon"><i class="icon s7-lock"></i></span>
                                    <input id="password" ng-model="login.usuario.password" type="password" placeholder="Contraseña" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group login-submit">
                                <button data-dismiss="modal" type="submit" class="btn btn-lg btn-primary btn-block" 
                                        ng-disabled="!loginform.$valid"
                                        ng-click="login.ingresar()">Ingresar</button>
                            </div>
                            <div class="form-group row login-tools">
                                <div class="col-6 login-remember">
                                    <label class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description">Recordarme</span>
                                    </label>

                                </div>
                                <div class="col-6 pt-2 text-right login-forgot-password"><a href="<?php echo App::make('url')->to('/lost-password'); ?>">Olvidaste tu contraseña?</a></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <a href="<?php echo App::make('url')->to('/register'); ?>" class="link-acceso">
                                        <span>No tienes acceso?</span>
                                        Solicitar acceso

                                    </a>


                                </div>
                            </div>
                        </form>
                        <div class="out-links"><a href="http://expresobrio.com/">© 2017 Expreso Brio</a></div>
                    </div>
                </div>
            </div>
        </div>
        <script>

            var Brio = {
                login_url: "<?php echo App::make('url')->to('/login-action'); ?>",
                dash_url: "<?php echo App::make('url')->to('/dashboard'); ?>"
            };

        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js" type="text/javascript"></script>
        <script src="assets/js/app-login.js" type="text/javascript"></script>

    </body>
</html>