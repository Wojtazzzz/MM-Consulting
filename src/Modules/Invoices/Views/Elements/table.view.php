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