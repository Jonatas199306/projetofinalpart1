<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/',[HomeController::class, 'index']);
    Route::get('lang/{locale}',[LanguageController::class,'swap']);
    Route::get('logout', 'UsuariosController@logout')->name('logout');

});

       //SEGURANÇA
       //USUARIOS
       Route::get('usuarios','UsuariosController@index')->name('usuarios.index');
       Route::get('usuarios/cadastrar','UsuariosController@cadastrar')->name('usuarios.cadastrar');
       Route::get('usuarios/deletar/{id}', 'UsuariosController@deletar')->name('usuarios.deletar');
       Route::get('usuarios/editar/{id}','UsuariosController@editar')->name('usuarios.editar');

       Route::post('usuarios/salvar','UsuariosController@salvar')->name('usuarios.salvar');
       Route::patch('usuarios/atualizar/{id}','UsuariosController@atualizar')->name('usuarios.atualizar');
       Route::get('usuarios/pesquisar','UsuariosController@pesquisar')->name('usuarios.pesquisar');
       Route::post('usuarios/pesquisar','UsuariosController@pesquisar')->name('usuarios.pesquisar');

       //GRUPOS
       Route::get('grupos','GruposController@index')->name('grupos.index');
       Route::get('grupos/cadastrar','GruposController@cadastrar')->name('grupos.cadastrar');
       Route::get('grupos/editar/{id}','GruposController@editar')->name('grupos.editar');
       Route::get('grupos/deletar/{id}', 'GruposController@deletar')->name('grupos.deletar');

       Route::post('grupos/salvar','GruposController@salvar')->name('grupos.salvar');
       Route::patch('grupos/atualizar/{id}','GruposController@atualizar')->name('grupos.atualizar');
       Route::get('grupos/pesquisar','GruposController@pesquisar')->name('grupos.pesquisar');
       Route::post('grupos/pesquisar','GruposController@pesquisar')->name('grupos.pesquisar');

       Route::get('perfil/changePassword', 'UsuariosController@changePassword')->name('perfil.changePassword');
       Route::patch('perfil/storeChangePassword', 'UsuariosController@storeChangePassword')->name('perfil.storeChangePassword');

