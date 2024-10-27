<form class="max-w-sm">
	<?php
		$sort = !empty($_GET['sort']) ? $_GET['sort'] : '';
	?>
	<label for="sort" class="block mb-2 text-sm font-semibold text-white">Sortowanie</label>
	<select id="sort" name="sort" class="border text-sm rounded-lg blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
		<option value="to_pay_asc" <?php echo $sort === 'to_pay_asc' ? 'selected' : '' ?>>Do zapłaty - rosnąco</option>
		<option value="to_pay_desc" <?php echo $sort === 'to_pay_desc' ? 'selected' : '' ?>>Do zapłaty - malejąco</option>
		<option value="paid_asc" <?php echo $sort === 'paid_asc' ? 'selected' : '' ?>>Zapłacono - rosnąco</option>
		<option value="paid_desc" <?php echo $sort === 'paid_desc' ? 'selected' : '' ?>>Zapłacono - malejąco</option>
	</select>

	<script>
        const sortSelect = document.querySelector('#sort');

        if (sortSelect) {
            sortSelect.addEventListener('change', (event) => {
                if (event.target.value) {
                    const url = new URL(window.location);

                    url.searchParams.set('sort', event.target.value);

                    window.location.href = url.toString();
                }
            });
        }
	</script>
</form>