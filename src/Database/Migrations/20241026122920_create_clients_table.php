<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateClientsTable extends AbstractMigration
{
    public function change(): void
    {
		$table = $this->table('clients');

		$table->addColumn('name', 'string', ['null' => false])
			->addColumn('account_number', 'string', ['null' => false, 'length' => 26])
			->addColumn('nip', 'string', ['null' => false, 'length' => 10])

			->addIndex(['name'], ['unique' => true])
			->addIndex(['nip'], ['unique' => true])

			->create();
    }
}
