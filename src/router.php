<?php

declare(strict_types=1);

use Mmconsulting\Modules\Invoices\Controllers\InvoiceController;
use function FastRoute\simpleDispatcher;
use FastRoute\RouteCollector;

$dispatcher = simpleDispatcher(function (RouteCollector $router) {
	$router->addRoute('GET', '/overpayments/{client_id:\d+}', [InvoiceController::class, 'overpayments']);
	$router->addRoute('GET', '/underpayments/{client_id:\d+}', [InvoiceController::class, 'underpayments']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

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
		echo 'ERROR 405';
		break;

	case FastRoute\Dispatcher::FOUND:
		[$status, $handler, $vars] = $routeInfo;

		if (is_array($handler) && class_exists($handler[0])) {
			if (method_exists($handler[0], $handler[1])) {
				$controller = new $handler[0]();

				$params = [];

				foreach ($vars as $key => $value) {
					if (is_numeric($value)) {
						$params[$key] = (int) $value;
					} else {
						$params[$key] = $value;
					}
				}

				$controller->{$handler[1]}(...$params);
			}
		}

		break;
}