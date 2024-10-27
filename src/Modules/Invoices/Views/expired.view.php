<div>
    <h1 class="text-3xl font-semibold text-white mb-4">Nierozliczone faktury po terminie płatności</h1>

    <?php if (empty($client)): ?>
        <span>Brak danych.</span>
    <?php else: ?>
        <div class="flex flex-col gap-y-10">
			<?php require_once('Elements/filters.view.php'); ?>
			<?php require_once('Elements/sort.view.php'); ?>
			<?php require_once('Elements/table.view.php'); ?>
        </div>
	<?php endif ?>
</div>