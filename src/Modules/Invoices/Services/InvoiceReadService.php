<?php

declare(strict_types=1);

namespace Mmconsulting\Modules\Invoices\Services;

use Mmconsulting\Shared\QueryBuilder;

final class InvoiceReadService
{
	public function getOverpayments(int $client_id): array
	{
		$conditions = [
			'Client.id' => $client_id,
		];

		$order = [
			'Invoice.total_price_gross' => 'ASC'
		];

		if (!empty($_GET['sort'])) {
			$order = match ($_GET['sort']) {
				'to_pay_desc' => ['Invoice.total_price_gross' => 'DESC'],
				'paid_desc' => ['invoice_paid_sum' => 'DESC'],
				'paid_asc' => ['invoice_paid_sum' => 'ASC'],
				default => ['Invoice.total_price_gross' => 'ASC'], // to_pay_asc
			};
		}

		if (isset($_GET['id']) && is_numeric($_GET['id'])) {
			$conditions[] = [
				'Invoice.id' => (int) $_GET['id'],
			];
		}

		if (!empty($_GET['number'])) {
			$conditions[] = [
				'Invoice.number LIKE' => '%'. $_GET['number'] .'%',
			];
		}

		$data = QueryBuilder::getConnection()
			->selectQuery([
				'Client.id',
				'Client.name',
				'Invoice.id as invoice_id',
				'Invoice.number as invoice_number',
				'Invoice.payment_date as payment_date',
				'Invoice.total_price_gross as invoice_total_price_gross',
				'InvoiceProduct.id as invoice_product_id',
				'InvoiceProduct.name as invoice_product_name',
				'InvoiceProduct.price_gross as invoice_product_price_gross',
				'SUM(InvoiceProduct.price_gross) as invoice_paid_sum'
			])
			->from(['Client' => 'clients'])
			->leftJoin(
				['Invoice' => 'invoices'],
				'Invoice.client_id = Client.id',
			)
			->leftJoin(
				['InvoiceProduct' => 'invoice_products'],
				'InvoiceProduct.invoice_id = Invoice.id',
			)
			->where($conditions)
			->groupBy(['InvoiceProduct.invoice_id'])
			->having(['SUM(InvoiceProduct.price_gross) > Invoice.total_price_gross'])
			->orderBy($order)
			->execute()
			->fetchAll('assoc');

		$client = [];

		foreach ($data as $row) {
			if (!isset($client['Client'])) {
				$client['Client'] = [
					'id' => $row['id'],
					'Invoice' => [],
				];
			}

			$client['Client']['Invoice'][$row['invoice_id']] = [
				'number' => $row['invoice_number'],
				'payment_date' => $row['payment_date'],
				'total_price_gross' => $row['invoice_total_price_gross'],
				'invoice_paid_sum' => $row['invoice_paid_sum'],
			];

			$client['Client']['Invoice'][$row['invoice_id']]['InvoiceProduct'][$row['invoice_product_id']] = [
				'name' => $row['invoice_product_name'],
				'price_gross' => $row['invoice_product_price_gross'],
			];
		}

		return $client;
	}
}