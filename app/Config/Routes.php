<?php

use App\Controllers\Admin\AdminController;
use App\Controllers\Apps\SummariesController;
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

//summaries
$routes->get('admin/summaries', [SummariesController::class, 'index']);
$routes->get('admin/summaries/(:num)/edit', [[SummariesController::class, 'buildEdit'], '$1']);
$routes->post('admin/summaries/edit', [[SummariesController::class, 'processEdit'], '$1']);
$routes->post('admin/summaries/create', [[SummariesController::class, 'processCreate'], '$1']);
