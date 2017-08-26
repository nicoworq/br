<nav class="navbar mai-sub-header">
    <div class="container">
        <!-- Mega Menu structure-->
        <nav class="navbar navbar-toggleable-sm">
            <button type="button" data-toggle="collapse" data-target="#mai-navbar-collapse" aria-controls="#mai-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler hidden-md-up collapsed">
                <div class="icon-bar"><span></span><span></span><span></span></div>
            </button>
            <div id="mai-navbar-collapse" class="navbar-collapse collapse mai-nav-tabs">
                <ul class="nav navbar-nav">
                    <li class="nav-item {{{ (Request::is('dashboard') ? 'open' : '') }}} ">
                        <a href="<?php echo App::make('url')->to('/dashboard') ?>" role="button" aria-expanded="false" class="nav-link"><span class="icon s7-home"></span><span>Panel Principal</span></a>

                    </li>
                    <li class="nav-item {{{ (Request::is('facturacion') ? 'open' : '') }}}"><a href="<?php echo App::make('url')->to('/facturacion') ?>" class="nav-link"><span class="icon s7-cash"></span><span>Facturación</span></a></li>
                    <li class="nav-item {{{ (Request::is('envios') ? 'open' : '') }}}"><a href="<?php echo App::make('url')->to('/envios') ?>" class="nav-link"><span class="icon s7-box2"></span><span>Envíos</span></a></li>
                </ul>
            </div>
        </nav>

    </div>
</nav>