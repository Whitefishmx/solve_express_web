<?php
	
	namespace CodeIgniter\Commands\Utilities\Routes;

use App\Controllers\SessionController;
use App\Controllers\ProfileController;
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
	$routes->add ( 'validateCode', 'ProfileController::verifyCode' /**@uses \App\Controllers\ProfileController::verifyCode * */ );
	$routes->add ( 'initRecovery', 'ProfileController::initRecovery' /**@uses \App\Controllers\ProfileController::initRecovery * */ );
	$routes->add ( 'changePassword', 'ProfileController::changePassword' /**@uses \App\Controllers\ProfileController::changePassword * */ );
	//====================================||   GET   ||====================================
	$routes->get ( 'validateIdentity', 'SignInController::validateIdentity' /**@uses \App\Controllers\SignInController::validateIdentity * */ );
	$routes->get ( 'resetPassword', 'ProfileController::resetPassword' /**@uses \App\Controllers\ProfileController::resetPassword * */ );
	$routes->get ( 'validarCURP', 'SignInController::validarCURP' /**@uses \App\Controllers\SignInController::validarCURP * */ );
	$routes->get ( 'profile', 'ProfileController::index' /**@uses \App\Controllers\ProfileController::index * */ );
	$routes->get ( 'getLaws', 'Home::getLaws' /**@uses \App\Controllers\Home::getLaws * */ );
	$routes->get ( '/', 'Home::index' /**@uses \App\Controllers\Home::index * */ );
	//====================================||   POST  ||====================================
	$routes->add ( 'toSignIn', 'SignInController::signIn' /**@uses \App\Controllers\SignInController::signIn * */ );
	$routes->add ( 'data4req', 'CompanyController::getInfo' /**@uses \App\Controllers\CompanyController::getInfo * */ );
	$routes->add ( 'setUser', 'EmployeeController::setUser' /**@uses \App\Controllers\EmployeeController::setUser * */ );
	$routes->add ( 'getLaws', 'EmployeeController::getLaws' /**@uses \App\Controllers\EmployeeController::getLaws * */ );
	$routes->add ( 'getCerts', 'EmployeeController::getCerts' /**@uses \App\Controllers\EmployeeController::getCerts * */ );
	$routes->add ( 'getProfile', 'ProfileController::getProfile' /**@uses \App\Controllers\ProfileController::getProfile * */ );
	$routes->add ( 'getPeriods', 'CompanyController::getPeriods' /**@uses \App\Controllers\CompanyController::getPeriods * */ );
	$routes->add ( 'requestPay', 'EmployeeController::requestPay' /**@uses \App\Controllers\EmployeeController::requestPay * */ );
	$routes->add ( 'getPayments', 'CompanyController::getPayments' /**@uses \App\Controllers\CompanyController::getPayments * */ );
	$routes->add ( 'getBenefits', 'EmployeeController::getBenefits' /**@uses \App\Controllers\EmployeeController::getBenefits * */ );
	$routes->add ( 'getEmployees', 'CompanyController::getEmployees' /**@uses \App\Controllers\CompanyController::getEmployees * */ );
	$routes->add ( 'dashboardEmployee', 'EmployeeController::dashboard' /**@uses \App\Controllers\EmployeeController::dashboard * */ );
	$routes->add ( 'toValidarCurp', 'EmployeeController::validarCurp' /**@uses \App\Controllers\EmployeeController::validarCurp * */ );
	$routes->add ( 'reportCompany', 'CompanyController::reportCompany' /**@uses \App\Controllers\CompanyController::reportCompany * */ );
	$routes->add ( 'disposiciones', 'EmployeeController::disposiciones' /**@uses \App\Controllers\EmployeeController::disposiciones * */ );
	$routes->add ( 'getPaymentsDetails', 'CompanyController::getPaymentsDetails' /**@uses \App\Controllers\CompanyController::getPaymentsDetails * */ );
	$routes->add ( 'getNotifications', 'NotificationController::getNotifications' /**@uses \App\Controllers\NotificationController::getNotifications * */ );
	$routes->add ( 'readNotifications', 'NotificationController::readNotifications' /**@uses \App\Controllers\NotificationController::readNotifications * */ );
	$routes->add ( 'deleteNotifications', 'NotificationController::deleteNotifications' /**@uses \App\Controllers\NotificationController::deleteNotifications * */ );
	$routes->add ( 'tutorials', 'FaqsController::index' /**@uses \App\Controllers\FaqsController::index * */ );
	//====================================||   PUT   ||====================================
	//====================================||  PATCH  ||====================================
	//====================================|| DELETE  ||====================================
	$routes->add ( 'fireEmployee', 'CompanyController::fireEmployee' /**@uses \App\Controllers\CompanyController::fireEmployee * */ );
	//====================================||   END   ||====================================
