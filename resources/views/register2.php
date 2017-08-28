
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="/favicon.ico" type="image/icon" >
        <title>Expreso Brio - Solicitar Acceso</title>
        <link rel="stylesheet" type="text/css" href="assets/lib/stroke-7/style.css"/>
        <link rel="stylesheet" href="assets/css/app.min.css" type="text/css"/>
        <link rel="stylesheet" href="assets/css/worq.min.css" type="text/css"/>
    </head>
    <body class="mai-splash-screen" id="register" data-ng-app="brioApp">
        <div class="mai-wrapper mai-sign-up" data-ng-controller="RegisterController as registerController">
            <div class="main-content container">
                <div class="splash-container row" style="width: 900px">
                    <div class="col-sm-7 form-message">
                        <div class="ajaxing ng-cloak" ng-show="register.cargando"><span></span></div>
                        <img src="assets/img/logo-brio.svg" alt="logo" height="70" class="logo-img mb-4">

                        <div ng-show="!register.mostrarSuccess">
                            <span class="splash-description text-center mt-4 mb-4">Completa este formulario para solicitar tu acceso al Área de Clientes.</span>
                            <p>Utiliza tu email de cliente e ingresa tu nombre de usuario que desees. </p>

                            <form class="sign-up-form" novalidate name="registerController.registerform">
                                <div class="form-group">
                                    <div class="input-group"><span class="input-group-addon"><i class="icon s7-mail"></i></span>
                                        <input  name="email" type="email" placeholder="Email de cliente" class="form-control" required
                                                ng-model="register.usuario.email"
                                                ng-blur="register.emailBlur()"
                                                ng-keypress="register.emailKeyPress()">
                                    </div>
                                    <ul class="parsley-errors-list filled ng-cloak" ng-show="registerController.registerform.email.$invalid && !registerController.registerform.email.$pristine" ><li class="parsley-required">{{register.errorEmail}}</li></ul>
                                    <div class="email-ok" ng-cloak ng-show="register.emailOK">
                                        <i class="icon s7-check-circle"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group"><span class="input-group-addon"><i class="icon s7-user"></i></span>
                                        <input  name="user" type="text" placeholder="Nombre de usuario deseado" class="form-control" ng-model="register.usuario.user" required>
                                    </div>
                                    <ul class="parsley-errors-list filled ng-cloak" id="parsley-id-5" ng-show="register.mostrarErrorUsuario" ><li class="parsley-required">{{register.errorUsuario}}</li></ul>
                                </div>
                                <div class="form-group inline row">
                                    <div class="col-6">
                                        <div class="input-group"><span class="input-group-addon"><i class="icon s7-lock"></i></span>
                                            <input name="password" type="password" ng-model="register.usuario.password" placeholder="Contraseña" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group"><span class="input-group-addon"><i class="icon s7-lock"></i></span>
                                            <input name="password2" type="password" ng-model="register.usuario.password2" placeholder="Confirmar Contraseña" class="form-control" required
                                                   compare-to="register.usuario.password" >
                                        </div>
                                    </div>
                                    <ul class="parsley-errors-list filled ng-cloak" id="parsley-id-5" ng-show="!registerController.registerform.password2.$pristine && registerController.registerform.password2.$invalid" ><li class="parsley-required">Las contraseñas no coinciden</li></ul>
                                </div>
                                <div class="form-group sign-up-submit">
                                    <button data-dismiss="modal" type="submit" class="btn btn-lg btn-primary btn-block"
                                            ng-disabled="!registerController.registerform.$valid"
                                            ng-click="register.solicitarAcceso()">Solicitar Acceso</button>
                                </div>
                            </form>
                        </div>
                        <div class="form-group row" ng-cloak ng-show="register.mostrarSuccess">
                            <div class="col-md-12">
                                <span class="splash-description text-center mt-4 mb-4">Hemos recibido correctamente tu solicitud</span>
                                <p >Nos pondremos en contacto para notificarte cuando tu acceso esté listo. Muchas Gracias!</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <span class="alternative-message text-center"> <a href="<?php echo App::make('url')->to('/login'); ?>"> Volver</a></span>
                            </div>
                        </div>


                        <div class="out-links"><a href="http://expresobrio.com/">© 2017 Expreso Brio</a></div>
                    </div>
                    <!--<div class="col-sm-6 user-message"><span class="splash-message text-left">Bienvenido <br> a nuestra <br> Area de clientes</span></div>-->
                </div>
            </div>
        </div>
        <script>

            var Brio = {
                main_url: "<?php echo App::make('url')->to('/'); ?>",
                ask_access_url: "<?php echo App::make('url')->to('/register/ask-access/'); ?>"
            };

        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js" type="text/javascript"></script>
        <script src="assets/js/app-register.js" type="text/javascript"></script>


    </body>
</html>