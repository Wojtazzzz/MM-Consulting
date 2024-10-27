<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class ClientSeeder extends AbstractSeed
{
    public function run(): void
    {
		$faker = Faker\Factory::create('pl_PL');

		$data = [];

		for ($i = 0; $i < 10; $i++) {
			$data[] = [
				'name' => $faker->unique()->name(),
				'account_number' => (string) $faker->unique()->numberBetween(00000000000000000000000001, 9999999999999999999999999),
				'nip' => (string) $faker->unique()->numberBetween(0000000001, 9999999999)
			];
		}

		$table = $this->table('clients');

		$table->truncate();
		$table->insert($data)->saveData();
    }
}
