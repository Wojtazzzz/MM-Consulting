<?php

declare(strict_types=1);

// contracts
// 0 => id, 2 => nazwa przedsiebiorcy, 4 => NIP, 10 => kwota,

$SHOW_ONLY_VALUABLE_CONTRACTS_ACTION = 5;
$MIN_HIDDEN_PRICE = 5;
$VALUABLE_CONTRACT_OVER = 10;

$db_connection = mysqli_connect('localhost', 'my_user', 'my_password', 'database');

$dg_bgcolor = '#ffffff';

echo '<html lang="pl">';
echo '<body style="'. $dg_bgcolor .'">';
echo '<br />';

echo '<table style="width: 95%">';
// table headers? <thead>, <th>?

$conditions = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$contract_id = (int) $_GET['id'];

	$conditions = "`Contract`.`id` = {$contract_id}";
}

if ($_GET['akcja'] == $SHOW_ONLY_VALUABLE_CONTRACTS_ACTION) {
	if (strlen($conditions) > 0) {
		$conditions .= ' AND ';
	}

	$conditions .= "`Contract`.`kwota` >= {$VALUABLE_CONTRACT_OVER}";

	$order_by = '';

	if (isset($_GET['sort']) && is_numeric($_GET['sort'])) {
		$order_by = match ((int) $_GET['sort']) {
			1 => 'ORDER BY `nazwa_przedsiebiorcy` ASC, `nip` DESC',
			2 => 'ORDER BY `kwota` ASC',
			default => '',
		};
	};

	$result = $db_connection->query("
		SELECT
			`Contract`.`id`,
			`Contract`.`nazwa_przedsiebiorcy`,
			`Contract`.`nip`,
			`Contract`.`kwota`
		FROM 
		    `contracts` AS `Contract`
		WHERE {$conditions} {$order_by}
	;");

	if (!$result) {
		// TODO: Handling errors
		echo 'ERROR!';
		exit;
	}

	while ($row = $result->fetch_assoc()) {
		echo '<tr>';
		echo "<td>{$row['id']}</td>";
		echo '<td>';
		echo $row['nazwa_przedsiebiorcy'];

		if ($row['kwota'] > $MIN_HIDDEN_PRICE) {
			echo ' ';
			echo $row['kwota'];
		}

		echo '</td>';
		echo '</tr>';
	}
} else {
	$result = $db_connection->query("
		SELECT
			`Contract`.`id`,
			`Contract`.`nazwa_przedsiebiorcy`,
			`Contract`.`nip`,
			`Contract`.`kwota`
		FROM 
		    `contracts` AS `Contract`
		WHERE {$conditions}
		ORDER BY
		    `Contract`.`id` ASC
	;");

	if (!$result) {
		// TODO: Handling errors
		echo 'ERROR!';
		exit;
	}

	while ($row = $result->fetch_assoc()) {
		echo '<tr>';
		echo "<td>{$row['id']}</td>";
		echo "<td>{$row['nazwa_przedsiebiorcy']}</td>";
		echo '</tr>';
	}
}

echo '</table>';
echo '</body>';
echo '</html>';