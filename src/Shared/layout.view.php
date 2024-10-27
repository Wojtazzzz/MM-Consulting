<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MMConsulting - Recruitment app</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-400">
    <div class="w-full max-w-7xl mx-auto flex justify-center items-center my-12">
        <?php if (isset($view_path)): ?>
            <?php require_once $view_path ?>
        <?php endif; ?>
    </div>
</body>
</html>