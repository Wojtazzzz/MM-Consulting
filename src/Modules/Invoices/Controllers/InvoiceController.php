<?php

declare(strict_types=1);

namespace Mmconsulting\Modules\Invoices\Controllers;

use Mmconsulting\Shared\BaseController;

class InvoiceController extends BaseController
{
	/**
	 * Listing of client's overpayments
	 * @return void
	 */
	public function overpayments(): void
	{
		$this->view('Modules/Invoices/Views/overpayments');
	}
}