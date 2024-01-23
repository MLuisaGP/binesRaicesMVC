<?php

require_once __DIR__ .'/../includes/app.php'; // aqui ya esta incluido el bd

use MVC\Router;
use Controllers\AdministradorController;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;
$router = new Router();

//*ZONA PRIVADA
$router->get('/admin', [AdministradorController::class,'index']);//el metodo index se encuentra en la clase de PropiedadController

$router->get('/propiedades/create', [PropiedadController::class,'create']);
$router->post('/propiedades/create', [PropiedadController::class,'create']);
$router->get('/propiedades/update', [PropiedadController::class,'update']);
$router->post('/propiedades/update', [PropiedadController::class,'update']);
$router->post('/propiedades/delete', [PropiedadController::class,'delete']);

$router->get('/vendedores/create', [VendedorController::class,'create']);
$router->post('/vendedores/create', [VendedorController::class,'create']);
$router->get('/vendedores/update', [VendedorController::class,'update']);
$router->post('/vendedores/update', [VendedorController::class,'update']);
$router->post('/vendedores/delete', [VendedorController::class,'delete']);

//*ZONA PUBLICA
$router->get('/', [PaginasController::class,'index']);
$router->get('/nosotros', [PaginasController::class,'nosotros']);
$router->get('/propiedades', [PaginasController::class,'propiedades']);
$router->get('/propiedad', [PaginasController::class,'propiedad']);
$router->get('/blog', [PaginasController::class,'blog']);
$router->get('/entrada', [PaginasController::class,'entrada']);
$router->get('/contacto', [PaginasController::class,'contacto']);
$router->post('/contacto', [PaginasController::class,'contacto']);

//Login y Autenticacion
$router->get('/login', [AdministradorController::class,'login']); //mostrar formulario
$router->post('/login', [AdministradorController::class,'login']); //enviar datos al formulario
$router->get('/logout', [AdministradorController::class,'logout']); //cerrar sesion


$router->checkRouter();