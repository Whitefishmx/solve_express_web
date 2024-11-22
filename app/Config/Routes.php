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
	$routes->add ( '/', 'Home::index' /**@uses \App\Controllers\Home::index * */ );
	$routes->add ( 'getLaws', 'Home::getLaws' /**@uses \App\Controllers\Home::getLaws * */ );
	$routes->add ( 'validarCURP', 'SignInController::validarCURP' /**@uses \App\Controllers\SignInController::validarCURP * */ );
	$routes->add ( 'validateIdentity', 'SignInController::validateIdentity' /**@uses \App\Controllers\SignInController::validateIdentity * */ );
	//====================================||   POST  ||====================================
	$routes->add ( 'toSignIn', 'SignInController::signIn' /**@uses \App\Controllers\SignInController::signIn * */ );
	$routes->add ( 'disposiciones', 'EmployeeController::disposiciones' /**@uses \App\Controllers\EmployeeController::disposiciones * */ );
	$routes->add ( 'dashboardEmployee', 'EmployeeController::dashboard' /**@uses \App\Controllers\EmployeeController::dashboard * */ );
	$routes->add ( 'requestPay', 'EmployeeController::requestPay' /**@uses \App\Controllers\EmployeeController::requestPay * */ );
	$routes->add ( 'getPeriods', 'CompanyController::getPeriods' /**@uses \App\Controllers\CompanyController::getPeriods * */ );
	$routes->add ( 'reportCompany', 'CompanyController::reportCompany' /**@uses \App\Controllers\CompanyController::reportCompany * */ );
	$routes->add ( 'toValidarCurp', 'EmployeeController::validarCurp' /**@uses \App\Controllers\EmployeeController::validarCurp * */ );
	$routes->add ( 'setPassword', 'EmployeeController::setPassword' /**@uses \App\Controllers\EmployeeController::setPassword * */ );
	$routes->add ( 'data4req', 'CompanyController::getInfo' /**@uses \App\Controllers\CompanyController::getInfo * */ );
	//====================================||   PUT   ||====================================
	//====================================||  PATCH  ||====================================
	//====================================|| DELETE  ||====================================
	//====================================||   END   ||====================================
