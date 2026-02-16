<?php
$role = auth_user()['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl mb-4">Dashboard</h1>
        <p>Welcome, <?php echo htmlspecialchars(auth_user()['email']); ?>!</p>
        <p>Your role: <?php echo htmlspecialchars($role); ?></p>
        <?php if ($role === 'admin'): ?>
            <a href="/?page=admin" class="text-blue-500">Admin Panel</a>
        <?php elseif ($role === 'staff'): ?>
            <a href="/?page=staff" class="text-blue-500">Staff Area</a>
        <?php else: ?>
            <a href="/?page=student" class="text-blue-500">Student Area</a>
        <?php endif; ?>
        <div class="mt-4">
            <a href="/?page=logout" class="text-red-500">Logout</a>
        </div>
    </div>
</body>
</html>
