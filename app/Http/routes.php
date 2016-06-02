<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});


Route::get('/home', 'HomeController@index');
Route::post('/pedido', 'HomeController@pedido');
Route::get('/pedidos', 'HomeController@pedidos');
//Route::get('/confirmacao', 'HomeController@confirmacao');

Route::get('/pedido/{id}', 'HomeController@detalhesPedido');
Route::get('/cancelarPedido/{id}', 'HomeController@cancelarPedido');
Route::get('/pagarEntrega/{id}', 'HomeController@pagarEntrega');
Route::get('/pagarPagseguro/{id}', 'HomeController@pagarPagseguro');

Route::post('/pedidos', 'HomeController@meusPedidos');

Route::any('login', function(){
    return Redirect::to('/redirectToProvider');
});

Route::get('logout', 'SocialAuthController@logout');

Route::get('/redirectToProvider', 'SocialAuthController@redirectToProvider');
Route::get('/callback', 'SocialAuthController@callback');

Route::any('/notificacao', 'HomeController@notificacao');

Route::any('/pagseguro/redirect', [
    'uses' => 'HomeController@notificacao',
    'as' => 'pagseguro.redirect',
]);

Route::post('/pagseguro/notification', [
    'uses' => '\laravel\pagseguro\Platform\Laravel5\NotificationController@notification',
    'as' => 'pagseguro.notification',
]);

//Route::auth();
