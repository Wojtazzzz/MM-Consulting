<?php

declare(strict_types=1);

namespace Mmconsulting\Shared;

abstract class BaseController
{
	/**
	 * Display view file
	 * @param string $view view file path
	 * @param array $variables variables to pass to the view
	 * @return void
	 */
	protected function view(string $view, array $variables = []): void
	{
		if ($variables) {
			extract($variables);
		}

		$layoutPath = getcwd() . '/src/Shared/layout.view.php';
		$viewPath = getcwd() . '/src/'. $view . '.view.php';

		if (file_exists($layoutPath) && file_exists($viewPath)) {
			extract(['view' => $viewPath]);

			require_once($layoutPath);
		}
	}
}