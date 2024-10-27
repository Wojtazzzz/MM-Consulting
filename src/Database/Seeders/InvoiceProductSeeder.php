<?php

declare(strict_types=1);

use Mmconsulting\Shared\QueryBuilder;use Phinx\Seed\AbstractSeed;

class InvoiceProductSeeder extends AbstractSeed
{
	public function getDependencies(): array
	{
		return [
			'InvoiceSeeder',
		];
	}

    public function run(): void
    {
		$faker = Faker\Factory::create('pl_PL');

		$invoices = QueryBuilder::getConnection()
			->selectQuery(['id'])
			->from('invoices')
			->execute()
			->fetchAll();

		$data = [];

		foreach ($invoices as $invoice) {
			$invoice_price = 0;

			for ($i = 0; $i < 2; $i++) {
				$product_price = $faker->numberBetween(100, 999) * 100;

				$data[] = [
					'invoice_id' => $invoice[0],
					'name' => '2024/' . $faker->unique()->numberBetween(01111, 99999),
					'quantity' => '2024/' . $faker->unique()->numberBetween(01111, 99999),
					'price_gross' => $product_price,
				];

				$invoice_price += $product_price;
			}

			$invoice_price = $faker->randomElement([
				$invoice_price,
				$invoice_price + $faker->numberBetween(10, 50),
				$invoice_price - $faker->numberBetween(10, 50),
			]);

			QueryBuilder::getConnection()->update(
				'invoices',
				['total_price_gross' => $invoice_price],
				['id' => $invoice[0]]
			);
		}

		$table = $this->table('invoice_products');

		$table->truncate();
		$table->insert($data)->saveData();
    }
}
