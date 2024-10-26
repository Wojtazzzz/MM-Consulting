<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateInvoiceProductsTable extends AbstractMigration
{
    public function change(): void
    {
		$table = $this->table('invoice_products');

		$table->addColumn('invoice_id', 'integer')
			->addColumn('name', 'string')
			->addColumn('quantity', 'integer', ['null' => false])
			->addColumn('price_gross', 'integer', ['null' => false])

			->addForeignKey('invoice_id', 'invoices', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])

			->create();
    }
}