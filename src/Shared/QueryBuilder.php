<?php

declare(strict_types=1);

namespace Mmconsulting\Shared;

use Cake\Database\Connection;
use Cake\Database\Driver\Sqlite;

class QueryBuilder
{
	private static Connection|null $connection = null;

	public static function getConnection(): Connection
	{
		if (self::$connection === null) {
			self::$connection = new Connection([
				'driver' => Sqlite::class,
				'database' => 'src/Database.sqlite3'
			]);
		}

		return self::$connection;
	}
}