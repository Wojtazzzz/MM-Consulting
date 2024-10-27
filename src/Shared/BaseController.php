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

		$layout_path = getcwd() . '/src/Shared/layout.view.php';
		$view_path = getcwd() . '/src/'. $view . '.view.php';

		if (file_exists($layout_path) && file_exists($view_path)) {
			extract(['view' => $view_path]);

			require_once($layout_path);
		}
	}
}