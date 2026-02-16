<?php
$role = auth_user()['role'];
$user = auth_user();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <div class="bg-blue-600 p-2 rounded-lg">
                    <i class="fas fa-utensils text-white text-2xl"></i>
                </div>
                <span class="ml-3 text-2xl font-bold text-blue-600">FoodApp</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="/?page=account" class="text-gray-700 hover:text-blue-600 transition">
                    <i class="fas fa-user-circle text-2xl"></i>
                </a>
                <a href="/?page=logout" class="px-4 py-2 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 transition">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Welcome Card -->
        <div class="bg-blue-600 rounded-2xl shadow-xl p-8 md:p-12 mb-8 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-2">Welcome back! 👋</h1>
                    <p class="text-lg text-blue-100"><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
                <div class="hidden md:block text-6xl opacity-20">
                    <i class="fas fa-utensils"></i>
                </div>
            </div>
        </div>

        <!-- Role Badge & Info -->
        <div class="mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-2">Account Role</p>
                    <p class="text-2xl font-bold text-gray-900">
                        <?php 
                            $roleIcons = ['admin' => '👨‍💻', 'staff' => '👨‍💼', 'student' => '🎓'];
                            echo ($roleIcons[$role] ?? '') . ' ' . ucfirst($role);
                        ?>
                    </p>
                </div>
                <div class="text-5xl opacity-20">
                    <i class="fas fa-briefcase"></i>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if ($role === 'admin'): ?>
                <a href="/?page=admin" class="bg-blue-600 rounded-xl p-6 text-white hover:shadow-xl transform hover:-translate-y-1 transition">
                    <div class="text-3xl mb-3"><i class="fas fa-crown"></i></div>
                    <h3 class="font-bold text-lg mb-2">Admin Panel</h3>
                    <p class="text-blue-100">Manage system and users</p>
                </a>
            <?php elseif ($role === 'staff'): ?>
                <a href="/?page=staff" class="bg-blue-600 rounded-xl p-6 text-white hover:shadow-xl transform hover:-translate-y-1 transition">
                    <div class="text-3xl mb-3"><i class="fas fa-store"></i></div>
                    <h3 class="font-bold text-lg mb-2">Manage Products</h3>
                    <p class="text-blue-100">Create and edit your products</p>
                </a>
            <?php else: ?>
                <a href="/?page=student" class="bg-blue-600 rounded-xl p-6 text-white hover:shadow-xl transform hover:-translate-y-1 transition">
                    <div class="text-3xl mb-3"><i class="fas fa-shopping-bag"></i></div>
                    <h3 class="font-bold text-lg mb-2">Browse Products</h3>
                    <p class="text-blue-100">Explore available food items</p>
                </a>
            <?php endif; ?>

            <a href="/?page=account" class="bg-blue-600 rounded-xl p-6 text-white hover:shadow-xl transform hover:-translate-y-1 transition">
                <div class="text-3xl mb-3"><i class="fas fa-user-cog"></i></div>
                <h3 class="font-bold text-lg mb-2">Account Settings</h3>
                <p class="text-blue-100">Update your profile & password</p>
            </a>
        </div>

        <!-- Quick Stats (if applicable) -->
        <?php if ($role === 'staff'): ?>
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Quick Stats</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Total Products</p>
                                <p class="text-3xl font-bold text-gray-900" id="productCount">--</p>
                            </div>
                            <div class="text-4xl text-blue-500 opacity-20"><i class="fas fa-box"></i></div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Active Listings</p>
                                <p class="text-3xl font-bold text-gray-900">--</p>
                            </div>
                            <div class="text-4xl text-blue-500 opacity-20"><i class="fas fa-list-check"></i></div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Store Status</p>
                                <p class="text-3xl font-bold text-green-500">Active</p>
                            </div>
                            <div class="text-4xl text-green-500 opacity-20"><i class="fas fa-check-circle"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
