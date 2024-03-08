<?php

use App\Controllers\Admin\AdminController;
use App\Controllers\Apps\SummariesController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/validatedni', 'Home::validatedni');
$routes->get('/certificado/(:hash)', 'Certificados::certificado/$1');
$routes->get('/validacert/(:hash)', 'Certificados::certificado/$1');

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
$routes->post('admin/summaries/delete',  [[SummariesController::class, 'processDelete'], '$1']);

/*ajax mostrar historico */
$routes->post('admin/summaries/show_hist', [SummariesController::class, 'getHistory']);
/* ajax formularios */
$routes->post('admin/summaries/adduser', [[SummariesController::class, 'ABMUserSumary'], 'add']);
$routes->post('admin/summaries/updtUser', [[SummariesController::class, 'ABMUserSumary'], 'updt']);
$routes->post('admin/summaries/delUser', [[SummariesController::class, 'ABMUserSumary'], 'del']);
