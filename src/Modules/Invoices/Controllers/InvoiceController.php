<?php

declare(strict_types=1);

namespace Mmconsulting\Modules\Invoices\Controllers;

use Mmconsulting\Modules\Invoices\Services\InvoiceReadService;
use Mmconsulting\Shared\BaseController;

class InvoiceController extends BaseController
{
	private readonly InvoiceReadService $invoiceReadService;

	public function __construct()
	{
		$this->invoiceReadService = new InvoiceReadService();
	}

	/**
	 * Listing of client's overpayments invoices
	 * @param int $client_id
	 * @return void
	 */
	public function overpayments(int $client_id): void
	{
		$client = $this->invoiceReadService->getClientOverpayments($client_id);

		$this->view('Modules/Invoices/Views/overpayments', [
			'client' => $client,
		]);
	}

	/**
	 * Listing of client's underpayments invoices
	 * @param int $client_id
	 * @return void
	 */
	public function underpayments(int $client_id): void
	{
		$client = $this->invoiceReadService->getClientUnderpayments($client_id);

		$this->view('Modules/Invoices/Views/underpayments', [
			'client' => $client,
		]);
	}
}