<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl mb-4">Welcome to FoodApp</h1>
        <?php if (auth_check()): ?>
            <a href="/?page=dashboard" class="text-blue-500">Dashboard</a>
            <a href="/?page=logout" class="text-red-500 ml-4">Logout</a>
        <?php else: ?>
            <a href="/?page=login" class="text-blue-500">Login</a>
            <a href="/?page=register" class="text-green-500 ml-4">Register</a>
        <?php endif; ?>
    </div>
</body>
</html>
