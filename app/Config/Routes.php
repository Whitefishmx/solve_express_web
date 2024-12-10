<?php
	
	namespace CodeIgniter\Commands\Utilities\Routes;
	
	use CodeIgniter\Router\RouteCollection;
	
	/**
	 * @var RouteCollection $routes
	 */
	$routes->setDefaultNamespace ( 'App\Controllers' );
	$routes->setTranslateURIDashes ( FALSE );
	$routes->setDefaultController ( 'Home' );
	$routes->setDefaultMethod ( 'index' );
	$routes->setAutoRoute ( FALSE );
	//====================================||  Rutas  ||====================================
	//====================================|| Webhook ||====================================
	//====================================|| Session ||====================================
	$routes->add ( 'signout', 'SessionController::signOut' /**@uses \App\Controllers\SessionController::signOut * */ );
	$routes->add ( 'forgot', 'ProfileController::forgot' /**@uses \App\Controllers\ProfileController::forgot * */ );
	$routes->add ( 'signIn', 'SignInController::index' /**@uses \App\Controllers\SignInController::index * */ );
	//====================================||   GET   ||====================================
	$routes->add ( 'validateIdentity', 'SignInController::validateIdentity' /**@uses \App\Controllers\SignInController::validateIdentity * */ );
	$routes->add ( 'validarCURP', 'SignInController::validarCURP' /**@uses \App\Controllers\SignInController::validarCURP * */ );
	$routes->add ( 'profile', 'ProfileController::index' /**@uses \App\Controllers\ProfileController::index * */ );
	$routes->add ( 'getLaws', 'Home::getLaws' /**@uses \App\Controllers\Home::getLaws * */ );
	$routes->add ( '/', 'Home::index' /**@uses \App\Controllers\Home::index * */ );
	//====================================||   POST  ||====================================
	$routes->add ( 'disposiciones', 'EmployeeController::disposiciones' /**@uses \App\Controllers\EmployeeController::disposiciones * */ );
	$routes->add ( 'reportCompany', 'CompanyController::reportCompany' /**@uses \App\Controllers\CompanyController::reportCompany * */ );
	$routes->add ( 'dashboardEmployee', 'EmployeeController::dashboard' /**@uses \App\Controllers\EmployeeController::dashboard * */ );
	$routes->add ( 'toValidarCurp', 'EmployeeController::validarCurp' /**@uses \App\Controllers\EmployeeController::validarCurp * */ );
	$routes->add ( 'getEmployees', 'CompanyController::getEmployees' /**@uses \App\Controllers\CompanyController::getEmployees * */ );
	$routes->add ( 'setPassword', 'EmployeeController::setPassword' /**@uses \App\Controllers\EmployeeController::setPassword * */ );
	$routes->add ( 'requestPay', 'EmployeeController::requestPay' /**@uses \App\Controllers\EmployeeController::requestPay * */ );
	$routes->add ( 'getProfile', 'ProfileController::getProfile' /**@uses \App\Controllers\ProfileController::getProfile * */ );
	$routes->add ( 'getPeriods', 'CompanyController::getPeriods' /**@uses \App\Controllers\CompanyController::getPeriods * */ );
	$routes->add ( 'data4req', 'CompanyController::getInfo' /**@uses \App\Controllers\CompanyController::getInfo * */ );
	$routes->add ( 'toSignIn', 'SignInController::signIn' /**@uses \App\Controllers\SignInController::signIn * */ );
	//====================================||   PUT   ||====================================
	//====================================||  PATCH  ||====================================
	//====================================|| DELETE  ||====================================
	$routes->add ( 'fireEmployee', 'CompanyController::fireEmployee' /**@uses \App\Controllers\CompanyController::fireEmployee * */ );
	//====================================||   END   ||====================================
