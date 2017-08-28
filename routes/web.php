<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('login');
});
Route::get('/login', ['as' => 'login', function () {
        return view('login');
    }]);
Route::get('/lost-password', function () {
    return view('lost-password');
});

/*
 * REGISTER
 */

Route::get('/register', function () {
    return view('register');
});
Route::get('/register/check-email/', 'RegisterController@verificarEmail');
Route::post('/register/ask-access/', 'RegisterController@solicitarAcceso');

/*
 * RECUPERAR PASS
 */
Route::post('/lost-password/restore/', 'RegisterController@recuperarPassword');


/*
 * FACTURAS
 */

Route::get('/facturacion',['as'=>'facturacion','uses' => 'FacturacionController@view']);
Route::get('/facturacion/descargar-factura/{nroOperacion}','FacturacionController@descargarFactura');
Route::get('/facturacion/descargar-resumen/{nroOperacion}','FacturacionController@descargarResumen');



/*
 * ENVIOS
 */

Route::get('/envios', 'EnviosController@view');
Route::get('/traer-envios/{page}', 'EnviosController@traerEnvios');
Route::get('/buscar-envio/', 'EnviosController@buscarEnvios');


/*
 * DASHBOARD
 */
Route::get('/dashboard', 'DashboardController@view');
Route::get('/logout', 'DashboardController@logout');

Route::get('/traer-envio/{id_envio}', 'DashboardController@traerEnvio');

/*
 * LOGIN
 */

Route::post('/login-action', 'LoginController@login');



