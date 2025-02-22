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

Route::get('/', function() { 
	return view('auth.login'); 
});

/*
Route::get('/nuevo', function() { 
	return view('Proveedores.registrar'); 
});

Route::get('/Ventas', function() { 
	return view('home'); 
});

Route::get('/Compras', function() { 
	return view('home'); 
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'Proveedor', 'middleware' => 'auth'], function(){
	Route::get('/','ProveedorController@index')->name('proveedores');
	Route::get('/nuevo','ProveedorController@create')->name('nuevoproveedor');
	Route::post('/guardar','ProveedorController@store')->name('guardarproveedor');
	Route::get('/editar/{id}','ProveedorController@edit')->name('editarproveedor');
	Route::put('/guardar/{id}','ProveedorController@update')->name('actualizarproveedor');
	Route::delete('/eliminar/{id}','ProveedorController@destroy')->name('eliminarproveedor');
	Route::post('/buscar','ProveedorController@buscar')->name('buscarproveedor');
	Route::post('/buscardia','ProveedorController@buscarPorDia')->name('buscardia');
});


Route::group(['prefix'=>'Producto', 'middleware' => 'auth'], function(){
	Route::get('/','ProductoController@index')->name('productos');
	Route::get('/nuevo','ProductoController@create')->name('nuevoproducto');
	Route::post('/guardar','ProductoController@store')->name('guardarproducto');
	Route::get('/editar/{id}','ProductoController@edit')->name('editarproducto');
	Route::put('/guardar/{id}','ProductoController@update')->name('actualizarproducto');
	Route::delete('/eliminar/{id}','ProductoController@destroy')->name('eliminarproducto');
	Route::get('/descontinuados','ProductoController@descontinuados')->name('productosdescontinuados');
	Route::put('/habilitar/{id}','ProductoController@habilitar')->name('habilitarproducto');
	Route::post('/buscar','ProductoController@buscar')->name('buscarproducto');
});

Route::group(['prefix'=>'Cliente', 'middleware' => 'auth'], function(){
	Route::get('/','ClienteController@index')->name('clientes');
	Route::get('/nuevo','ClienteController@create')->name('nuevocliente');
	Route::post('/guardar','ClienteController@store')->name('guardarcliente');
	Route::get('/editar/{id}','ClienteController@edit')->name('editarcliente');
	Route::put('/guardar/{id}','ClienteController@update')->name('actualizarcliente');
	Route::delete('/eliminar/{id}','ClienteController@destroy')->name('eliminarcliente');
	Route::post('/buscar','ClienteController@buscar')->name('buscarcliente');
});

Route::group(['prefix'=>'Compra', 'middleware' => 'auth'], function(){
	Route::get('/','CompraController@index')->name('compras');
	Route::get('/nuevo','CompraController@create')->name('nuevacompra');
	Route::post('/guardar','CompraController@store')->name('guardarcompra');
	Route::get('/ver/{id}','CompraController@show')->name('vercompra');
});

Route::group(['prefix'=>'Venta', 'middleware' => 'auth'], function(){
	Route::get('/','VentaController@index')->name('ventas');
	Route::get('/nuevo','VentaController@create')->name('nuevaventa');
	Route::post('/guardar','VentaController@store')->name('guardarventa');
	Route::get('/detalle/{id}','VentaController@show')->name('verdetallesventa');
	Route::post('/consultarFecha','VentaController@buscarFecha')->name('consultarfecha');
});

