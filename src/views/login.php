<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 max-w-md">
        <h1 class="text-2xl mb-4">Login</h1>
        <form method="post" action="/?page=login">
            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" name="email" required class="w-full border p-2" />
            </div>
            <div class="mb-4">
                <label class="block mb-1">Password</label>
                <input type="password" name="password" required class="w-full border p-2" />
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Login</button>
        </form>
    </div>
</body>
</html>
