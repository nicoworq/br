
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="assets/img/favicon.png">
        <title>Expreso Brio</title>
        <link rel="stylesheet" type="text/css" href="assets/lib/stroke-7/style.css"/>
        <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
        <link rel="stylesheet" href="assets/css/worq.css" type="text/css"/>
        <link rel="stylesheet" href="assets/css/app.min.css" type="text/css"/>
    </head>
    <body class="mai-splash-screen" id="register" data-ng-app="brioApp">
        <div class="mai-wrapper mai-forgot-password" data-ng-controller="LostPasswordController">
            <div class="main-content container">
                <div class="splash-container row">

                    <div class="col-sm-6 form-message">
                        <img src="assets/img/logo-brio.svg" alt="logo" height="70" class="logo-img mb-4">

                        <div ng-show="!lost.mostrarSuccess">


                            <span class="splash-description text-center mt-5 mb-5">Te enviaremos un Email para recuperar tu contraseña.</span>
                            <form class="form-forgot-password" name="lostform">
                                <div class="form-group">
                                    <div class="input-group"><span class="input-group-addon"><i class="icon s7-mail"></i></span>
                                        <input type="email"  name="email" placeholder="Email" ng-model="lost.usuario.email" class="form-control" required>
                                    </div>
                                    <ul class="parsley-errors-list filled ng-cloak" 
                                        ng-show="lostform.email.$invalid && !lostform.email.$pristine" ><li class="parsley-required">Ingrese un email válido</li></ul>
                                    <ul class="parsley-errors-list filled ng-cloak" 
                                        ng-show="lost.mostrarErrorEmail" ><li class="parsley-required">{{lost.errorEmail}}</li></ul>
                                </div>
                                <div class="form-group login-submit">
                                    <button data-dismiss="modal" type="submit" class="btn btn-lg btn-primary btn-block"
                                            ng-disabled="!lostform.$valid"
                                            ng-click="lost.recuperarPass()">Recuperar Contraseña</button>
                                </div>
                                <p class="contact mt-4">No recuerdas tu email registrado?<br/> <a href="tel:0810-345-2746">Contactate al 0810-345-Brio (2746)</a>.</p>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <a href="<?php echo App::make('url')->to('/register'); ?>" class="link-acceso">
                                            <span>No tienes acceso?</span>
                                            Solicitar acceso

                                        </a>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div ng-show="lost.mostrarSuccess" ng-cloak> 
                            <span class="splash-description text-center mt-5 mb-5">Si eres cliente registrado, te enviaremos los datos de acceso.</span>
                            <p>En caso de no recibir los datos, revisa tu carpeta de SPAM.</p>
                            <p>Si no recibes los datos en los próximos 10 minutos, puedes comunicarte al Contactate al 0810-345-Brio (2746)</p>
                        </div>
                        <div class="out-links"><a href="http://expresobrio.com/">© 2017 Expreso Brio</a></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var Brio = {
                main_url: "<?php echo App::make('url')->to('/'); ?>",
                restore_url: "<?php echo App::make('url')->to('/lost-password/restore/'); ?>"
            };
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js" type="text/javascript"></script>
        <script src="assets/js/app-lost-pass.js" type="text/javascript"></script>
    </body>
</html>