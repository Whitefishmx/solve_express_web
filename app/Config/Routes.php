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
	//====================================||   POST  ||====================================
	$routes->add ( 'toSignIn', 'SignInController::signIn' /**@uses \App\Controllers\SignInController::signIn * */ );
	$routes->add ( 'disposiciones', 'EmployeeController::disposiciones' /**@uses \App\Controllers\EmployeeController::disposiciones * */ );
	$routes->add ( 'dashboardEmployee', 'EmployeeController::dashboard' /**@uses \App\Controllers\EmployeeController::dashboard * */ );
	$routes->add ( 'requestPay', 'EmployeeController::requestPay' /**@uses \App\Controllers\EmployeeController::requestPay * */ );
	$routes->add ( 'getPeriods', 'CompanyController::getPeriods' /**@uses \App\Controllers\CompanyController::getPeriods * */ );
	//====================================||   PUT   ||====================================
	//====================================||  PATCH  ||====================================
	//====================================|| DELETE  ||====================================
	//====================================||   END   ||====================================
