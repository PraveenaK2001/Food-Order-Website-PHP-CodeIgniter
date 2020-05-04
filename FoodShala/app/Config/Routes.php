<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Static Routes
$routes->get('/', 'Home::index');
$routes->get('/user-login', 'UserController::userLogin');
$routes->get('/user-logout', 'UserController::userLogout');
$routes->get('/user-registration', 'UserController::userRegistration');
$routes->get('/cus-registration', 'UserController::customerRegistration');
$routes->get('/res-registration', 'UserController::restaurantRegistration');
$routes->match(['get','post'],'/MenuItem/New-Menu-Item','ItemController::createMenuItem');
$routes->get('/view-cart', 'ItemController::viewCart');
$routes->match(['get','post'],'/add-customer', 'UserController::addCustomer');
$routes->match(['get','post'],'/add-restaurant', 'UserController::addRest');
$routes->match(['get','post'],'/user-authenticate', 'UserController::userAuthenticate');
$routes->get('/dashboard', 'Home::resDashboard');
$routes->get('/my-res-menu', 'Home::myResMenu');
$routes->get('/place-order', 'ItemController::placeOrder');
$routes->get('/order-placed', 'ItemController::viewOrder');

//Dynamic Routes
$routes->get('/AddToCart/(:any)','ItemController::addToCart/$1');
$routes->get('/Remove-From-Cart/(:any)','ItemController::removeFromCart/$1');
$routes->get('/Remove-From-menu/(:any)','ItemController::removeFromMenu/$1');
$routes->get('/mark-deliver/(:any)','ItemController::markDeliver/$1');


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
