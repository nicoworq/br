<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="favicon.ico" type="image/icon" >
        <title>Expreso Brio - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="assets/lib/stroke-7/style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/app.min.css" type="text/css"/>
        <link rel="stylesheet" href="assets/css/worq.min.css" type="text/css"/>

    </head>
    <body ng-app="brioApp">
        <?php if (Session::has('error')) { ?>
            <div role="alert" class="alert alert-danger alert-dismissible">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true" class="s7-close"></span></button>
                <span class="icon s7-close"></span><strong>Error!</strong> <?php echo Session::get('error'); ?>
            </div>
        <?php } ?>
        <nav class="navbar navbar-full navbar-inverse navbar-fixed-top mai-top-header" style="padding: 8px 0" data-ng-controller="NavigationController">
            <div class="container"><a href="#" class="">
                    <img src="assets/img/logo-brio-positivo.svg" alt="logo" height="40"/>
                </a>
                <!--Left Menu-->
                <ul class="nav navbar-nav mai-top-nav">
                    <!-- <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                     <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                     <li class="nav-item dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">Services <span class="angle-down s7-angle-down"></span></a>
                       <div role="menu" class="dropdown-menu"><a href="#" class="dropdown-item">Information</a><a href="#" class="dropdown-item">Company</a><a href="#" class="dropdown-item">Documentation</a><a href="#" class="dropdown-item">API Settings</a><a href="#" class="dropdown-item">Export Info</a></div>
                     </li>
                     <li class="nav-item"><a href="#" class="nav-link">Support</a></li>-->
                </ul>
                <!--Icons Menu-->

                <!--User Menu-->
                <ul class="nav navbar-nav float-lg-right mai-user-nav">
                    <li class="dropdown nav-item">
                        <a data-ng-click="nav.mostrarSubmenu = !nav.mostrarSubmenu" href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle nav-link">
                            <!--<img src="assets/img/avatar.jpg">-->
                            <span class="user-name"><?php echo $cliente->ClienteNombre; ?></span><span class="angle-down s7-angle-down"></span>
                        </a>
                        <div  role="menu" class="dropdown-menu" data-ng-show="nav.mostrarSubmenu" data-ng-cloak>
                            <a href="<?php echo App::make('url')->to('/datos-personales') ?>" class="dropdown-item"> <span class="icon s7-user"> </span>Datos Personales</a>
                            <a href="<?php echo App::make('url')->to('/logout') ?>" class="dropdown-item"> <span class="icon s7-power"> </span>Cerrar Sesión</a></div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="mai-wrapper">

            @include('layout.nav')

            <div class="main-content container" >
                @yield('content')
            </div>
        </div>

        <footer>

            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="footerContenido">
                            <div class="datos">
                                <p class="title">Casa Central</p>

                                <p>Av. Ing. Acevedo 2949.<br>
                                    Rosario (2000) - SF - Argentina</p>

                                <p>info@brio.com.ar<br>
                                    Tel.: 0810-345-Brio (2746)</p>

                                <a href="http://expresobrio.com/index.php?page=destinos&idciudad=7" class="verOtras">Ver contacto de otras sucursales</a>
                                <img src="assets/img/sucursalesfooter.png" height="18" width="13" class="sucursalesicon">
                            </div><!-- FIN datos -->
                        </div>

                    </div>
                    <div class="col-md-2">
                        <div class="footerContenido">
                            <div class="menuFooter">
                                <div class="linksempresa">
                                    <p class="title">EMPRESA</p>
                                    <ul>
                                        <li><a href="http://expresobrio.com/index.php?page=la_empresa&amp;id=9&amp;title=La-Empresa">Institucional</a></li>
                                        <li><a href="http://expresobrio.com/index.php?page=la_empresa&amp;id=10&amp;title=Experiencia">Experiencia</a></li>
                                        <li><a href="http://expresobrio.com/index.php?page=sucursales&amp;id=1&amp;title=Rosario">Sucursales</a></li>
                                        <li><a href="http://expresobrio.com/index.php?page=la_empresa&amp;id=12&amp;title=Personal">Recursos Humanos</a></li>
                                        <li><a href="http://expresobrio.com/index.php?page=galeria">Galería</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="footerContenido">
                            <div class="menuFooter">
                                <div class="linksservicios">
                                    <p class="title">SERVICIOS</p>
                                    <ul>
                                        <li><a href="http://expresobrio.com/index.php?page=servicios&amp;id=3&amp;title=Logística">Logística</a></li>
                                        <li><a href="http://expresobrio.com/index.php?page=servicios&amp;id=2&amp;title=Distribución">Distribución</a></li>
                                        <li><a href="http://expresobrio.com/index.php?page=servicios&amp;id=6&amp;title=Carga-Completa">Carga Completa</a></li>
                                        <li><a href="http://expresobrio.com/index.php?page=servicios&amp;id=7&amp;title=Movimiento-de-Contenedores">Movimiento de Contenedores</a></li>
                                        <li><a href="http://expresobrio.com/index.php?page=servicios&amp;id=1&amp;title=Tracking-Online">Tracking Online</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="footerContenido">
                            <div class="menuFooter">
                                <div class="linksdestinos">
                                    <p class="title">DESTINOS</p>
                                    <ul>
                                        <li><a href="http://expresobrio.com/index.php?page=destinos&amp;idciudad=1">Rosario</a></li>
                                        <li><a href="http://expresobrio.com/index.php?page=destinos&amp;idciudad=2">Ciudad de Santa Fe</a></li>
                                        <li><a href="http://expresobrio.com/index.php?page=destinos&amp;idciudad=3">Ciudad de Córdoba</a></li>
                                        <li><a href="http://expresobrio.com/index.php?page=destinos&amp;idciudad=4">Ciudad de Buenos Aires</a></li>
                                        <li><a href="http://expresobrio.com/index.php?page=destinos&amp;idciudad=5">Prov de Buenos Aires</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="logo-footer">
                            <img src="assets/img/briofooter.png" height="107" width="81" class="logofooter">
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>© Copyright <?php echo date('Y') ?> - Brios SRL - Todos los Derechos Reservados.</p>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </footer>

    <script>

        var Brio = {
            main_url: "<?php echo App::make('url')->to('/'); ?>"
        };

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js" type="text/javascript"></script>


    <script src="assets/js/controllers/controller-dashboard.js" type="text/javascript"></script>   
    <script src="assets/js/controllers/controller-envios.js" type="text/javascript"></script>   
    <script src="assets/js/controllers/controller-datos.js" type="text/javascript"></script>   
    <script src="assets/js/controllers/controller-navigation.js" type="text/javascript"></script>   
    <script src="assets/js/services/service-envios.js" type="text/javascript"></script>   
    <script src="assets/js/services/service-datos.js" type="text/javascript"></script>   
    <script src="assets/js/directives/dirPagination.js" type="text/javascript"></script>   
    <script src="assets/js/directives/datepicker.js" type="text/javascript"></script>   





</body>
</html>