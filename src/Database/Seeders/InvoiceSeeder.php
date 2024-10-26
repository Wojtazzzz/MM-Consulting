<?php

declare(strict_types=1);

use Mmconsulting\Shared\QueryBuilder;
use Phinx\Seed\AbstractSeed;

class InvoiceSeeder extends AbstractSeed
{
	public function getDependencies(): array
	{
		return [
			'ClientSeeder',
		];
	}

    public function run(): void
    {
		$faker = Faker\Factory::create('pl_PL');

		$clients = QueryBuilder::getConnection()
			->selectQuery(['id'])
			->from('clients')
			->execute()
			->fetchAll();

		$data = [];

		foreach ($clients as $client) {
			for ($i = 0; $i < 3; $i++) {
				$data[] = [
					'client_id' => $client[0],
					'number' => '2024/' . $faker->unique()->numberBetween(01111, 99999),
					'payment_date' => $faker->randomElement([
						date('Y-m-d H:i:s'),
						date('Y-m-d H:i:s', strtotime('+ 1 days')),
						date('Y-m-d H:i:s', strtotime('+ 2 days')),
					]),
					'total_price_gross' => 0,
				];
			}
		}

		$table = $this->table('invoices');

		$table->truncate();
		$table->insert($data)->saveData();
    }
}
