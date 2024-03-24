<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::dashboard');
$routes->get('/cars', 'Home::cars');

$routes->get('/registercustomer', 'Home::registercustomer');
$routes->post('/registercustomer', 'Home::registercustomer');

$routes->get('/registeragency', 'Home::registeragency');
$routes->post('/registeragency', 'Home::registeragency');


$routes->get('/login', 'Home::login');
$routes->post('/login', 'Home::login');

$routes->get('/logout', 'Home::logout');

$routes->get('/addcar/(:num)?', 'AgencyDashboardController::addcar/$1', ['filter' => 'isAgency']);
$routes->get('/addcar', 'AgencyDashboardController::addcar', ['filter' => 'isAgency']);
$routes->post('/addcar', 'AgencyDashboardController::addcar', ['filter' => 'isAgency']);

$routes->get('/agencycars', 'AgencyDashboardController::allcars', ['filter' => 'isAgency']);

$routes->post('/rent', 'CustomerDashboardController::rent', ['filter' => 'isCustomer']);

$routes->get('/agency_dashboard', 'AgencyDashboardController::index');

$routes->get('/bookedcars', 'AgencyDashboardController::bookedcars', ['filter' => 'isAgency']);
