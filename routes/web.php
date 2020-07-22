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
	return view('home'); 
});

Route::get('/Productos', function() { 
	return view('Productos.productos'); 
});


Route::get('/nuevo', function() { 
	return view('Proveedores.registrar'); 
});

Route::get('/Ventas', function() { 
	return view('home'); 
});

Route::get('/Compras', function() { 
	return view('home'); 
});



Route::group(['prefix'=>'Proveedor'], function(){
	Route::get('/','ProveedorController@index')->name('proveedores');
	Route::get('/nuevo','ProveedorController@create')->name('nuevoproveedor');
	Route::post('/guardar','ProveedorController@store')->name('guardarproveedor');
	Route::get('/editar/{id}','ProveedorController@edit')->name('editarproveedor');
	Route::put('/guardar/{id}','ProveedorController@update')->name('actualizarproveedor');
	Route::delete('/eliminar/{id}','ProveedorController@destroy')->name('eliminarproveedor');
});


Route::group(['prefix'=>'Producto'], function(){
	Route::get('/','ProductoController@index')->name('productos');
	Route::get('/nuevo','ProductoController@create')->name('nuevoproducto');
	Route::post('/guardar','ProductoController@store')->name('guardarproducto');
	Route::get('/editar/{id}','ProductoController@edit')->name('editarproducto');
	Route::put('/guardar/{id}','ProductoController@update')->name('actualizarproducto');
	Route::delete('/eliminar/{id}','ProductoController@destroy')->name('eliminarproducto');
});

