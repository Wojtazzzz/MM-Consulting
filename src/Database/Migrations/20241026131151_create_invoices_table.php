<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateInvoicesTable extends AbstractMigration
{
    public function change(): void
    {
		$table = $this->table('invoices');

		$table->addColumn('client_id', 'integer')
			->addColumn('number', 'string', ['null' => false])
			->addColumn('created_at', 'datetime', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
			->addColumn('payment_date', 'datetime', ['null' => false])
			->addColumn('total_price_gross', 'integer', ['null' => false])

			->addIndex(['number'], ['unique' => true])

			->addForeignKey('client_id', 'clients', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])

			->create();
    }
}
