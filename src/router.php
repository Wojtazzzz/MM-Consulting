<?php

declare(strict_types=1);

use Mmconsulting\Modules\Invoices\InvoiceController;

require_once __DIR__ . '/../vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $router) {
	$router->addRoute('GET', '/overpayments', [InvoiceController::class, 'overpayments']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
	$uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
	case FastRoute\Dispatcher::NOT_FOUND:
		echo 'ERROR 404';
		break;
	case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
//		$allowedMethods = $routeInfo[1];
		echo 'ERROR 405';
		break;
	case FastRoute\Dispatcher::FOUND:
		[$status, $handler, $vars] = $routeInfo;

		if (is_array($handler) && class_exists($handler[0])) {
			if (method_exists($handler[0], $handler[1])) {
				$controller = new $handler[0]();

				$controller->{$handler[1]}();
			}
		}

		break;
}