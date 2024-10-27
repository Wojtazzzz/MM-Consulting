<?php
    $link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<form method="get" action="<?php echo $link.'/'.$client['Client']['id'] ?>">
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