<div>
    <h1 class="text-3xl font-semibold text-white mb-4">Nadpłaty</h1>

    <?php if (empty($client)): ?>
        <span>Brak danych.</span>
    <?php else: ?>
        <div class="flex flex-col gap-y-10">
            <form method="get" action="<?php echo "http://localhost:8000/overpayments/{$client['Client']['id']}" ?>">
                <div class="grid gap-2 mb-6 md:grid-cols-2">
                    <div>
                        <label for="id" class="block mb-2 text-sm font-semibold text-white">ID faktury</label>
                        <input type="text" id="id" name="id" value="<?php echo $_GET['id'] ?? '' ?>" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="123" />
                    </div>
                    <div>
                        <label for="number" class="block mb-2 text-sm font-semibold text-white">Numer faktury</label>
                        <input type="text" id="number" name="number" value="<?php echo $_GET['number'] ?? '' ?>" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="2024/00001" />
                    </div>
                </div>
                <button type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Szukaj</button>
                <button type="reset" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-yellow-600 hover:bg-yellow-700 focus:ring-yellow-800">Resetuj</button>
            </form>

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

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID faktury
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Numer faktury
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Termin zapłaty
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Do zapłaty
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Zapłacono
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($client['Client']['Invoice'] as $invoice_id => $invoice): ?>
                            <tr class="border-b bg-gray-800 border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                    <?php echo $invoice_id ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo $invoice['number'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $invoice['payment_date'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo showPrice($invoice['total_price_gross']) ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo showPrice($invoice['invoice_paid_sum']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
	<?php endif ?>
</div>