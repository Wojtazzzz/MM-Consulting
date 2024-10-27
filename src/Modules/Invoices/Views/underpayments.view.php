<div>
    <h1 class="text-3xl font-semibold text-white mb-4">Niedopłaty</h1>

    <?php if (empty($client)): ?>
        <div class="flex flex-col gap-y-4">
            <span>Brak danych.</span>
            <button type="button" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" onclick="history.back()">Powrót</button>
        </div>
    <?php else: ?>
        <div class="flex flex-col gap-y-10">
			<?php require_once('Elements/filters.view.php'); ?>
			<?php require_once('Elements/sort.view.php'); ?>
			<?php require_once('Elements/table.view.php'); ?>
        </div>
	<?php endif ?>
</div>