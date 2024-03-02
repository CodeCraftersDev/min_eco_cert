<?php

use App\Controllers\Admin\AdminController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/validate', 'Home::validatedni');
$routes->get('/certificado/(:hash)', 'Certificados::certificadoNoRegistra/$1');
$routes->get('/certificadoregistra', 'Certificados::certificadoRegistra');

//admin
$routes->get('admin', [AdminController::class, 'index']);
//$routes->post('admin/(:any)', [[AdminController::class, 'index'], '$1']);
//$routes->get('admin/(:any)', [[AdminController::class, 'index'], '$1']);

//login & logout
$routes->post('admin/login', [AdminController::class, 'login']);
$routes->get('admin/logout', [AdminController::class, 'logout']);
