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
        
        <link rel="stylesheet" href="assets/css/app.min.css" type="text/css"/>
        <link rel="stylesheet" href="assets/css/worq.css" type="text/css"/>
       
    </head>
    <body ng-app="brioApp">
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
                            <a href="#" class="dropdown-item"> <span class="icon s7-user"> </span>Datos Personales</a>
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
            
            
            
        </footer>

        <script>

            var Brio = {
                main_url: "<?php echo App::make('url')->to('/'); ?>"
            };

        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js" type="text/javascript"></script>
        

        <script src="assets/js/controllers/controller-dashboard.js" type="text/javascript"></script>   
        <script src="assets/js/controllers/controller-envios.js" type="text/javascript"></script>   
        <script src="assets/js/controllers/controller-navigation.js" type="text/javascript"></script>   
        <script src="assets/js/services/service-envios.js" type="text/javascript"></script>   
        <script src="assets/js/directives/dirPagination.js" type="text/javascript"></script>   
        <script src="assets/js/directives/datepicker.js" type="text/javascript"></script>   
        
        

        
        
    </body>
</html>