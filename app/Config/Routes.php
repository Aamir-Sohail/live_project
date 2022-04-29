<?php

namespace Config;

use App\Controllers\RegistrationController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//user Registration APIs////////
$routes->post('/registration','RegistrationController::user_register');

$routes->post('/login','RegistrationController::user_login');
/////////////


//The New TenantUserController //
//Register New Tenat User..
$routes->post('/create','TenantUserController::create_tenant');
//Delete the TenatUser...
$routes->delete('/delete/(:num)','TenantUserController::Delete_Tenant/$1');
//View All Tenant Data...
$routes->get('/findall','TenantUserController::view_Tenant');
//Update the Tenant User Account...
$routes->put('/update/(:num)','TenantUserController::update_tenant/$1'); 
//Tenant View Single record View...
$routes->get('/view/(:num)','TenantUserController::Tenant_single/$1');
////////////////////////////////////////End Of TenantController

//The New Upgrade User Controller Route....

//this route create new payement plan of the user...
$routes->post('/create_plan','UpgradeUserController::create_upgradeplan');

//This route delete the plan of the user..
$routes->delete('/delete_plan','UpgradeUserController::Delete_upgradeplan');

// This route show single view of plan...
$routes->get('/single_plan','UpgradeUserController::Upgradeplan_single');

// This route show all view of plan...
$routes->get('/all_plan','UpgradeUserController::Upgradeplan_all');

// This route update all data of plan...
$routes->put('/update_plan','UpgradeUserController::UpgradePlan_Update');


//

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
