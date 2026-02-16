<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 p-2 rounded-lg">
                    <i class="fas fa-utensils text-white text-2xl"></i>
                </div>
                <span class="ml-3 text-2xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">FoodApp</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="/?page=dashboard" class="text-gray-700 hover:text-orange-500 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
                <a href="/?page=logout" class="px-4 py-2 text-red-500 border border-red-500 rounded-lg hover:bg-red-50 transition">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-8"><i class="fas fa-user-circle mr-3 text-orange-500"></i>My Account</h1>
        <?php
            // fetch fresh user record for profile fields
            $uid = auth_user()['id'];
            $stmt = db_connect()->prepare('SELECT * FROM users WHERE id = ?');
            $stmt->execute([$uid]);
            $currentUser = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <!-- Alert Messages -->
        <?php if (!empty($message)): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
                <i class="fas fa-check-circle mr-3 text-lg"></i>
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-lg"></i>
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <!-- Account Info Card -->
        <div class="bg-white rounded-2xl shadow-md p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6"><i class="fas fa-info-circle mr-3 text-blue-500"></i>Account Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Email</p>
                    <p class="text-lg font-semibold text-gray-900"><?php echo htmlspecialchars($currentUser['email']); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Role</p>
                    <p class="text-lg font-semibold">
                        <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                            <?php echo ucfirst(htmlspecialchars($currentUser['role'])); ?>
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="bg-white rounded-2xl shadow-md p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6"><i class="fas fa-user-edit mr-3 text-orange-500"></i>Update Profile</h2>
            <form method="post" action="/?page=account" enctype="multipart/form-data">
                <!-- Photo Upload -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-gray-700 mb-4">
                        <i class="fas fa-image mr-2 text-orange-500"></i>Profile Photo
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col items-center justify-center">
                            <?php if (!empty($currentUser['photo_path'])): ?>
                                <img src="/<?php echo htmlspecialchars($currentUser['photo_path']); ?>" width="150" height="150" class="rounded-2xl object-cover shadow-lg mb-4" alt="Profile">
                            <?php else: ?>
                                <div class="w-32 h-32 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-400 mb-4">
                                    <i class="fas fa-user text-5xl"></i>
                                </div>
                            <?php endif; ?>
                            <p class="text-sm text-gray-600 text-center">Current Photo</p>
                        </div>
                        <div class="flex items-center">
                            <div class="relative w-full">
                                <input type="file" name="photo" accept="image/*" class="hidden" id="photoInput" />
                                <label for="photoInput" class="block cursor-pointer">
                                    <div class="border-2 border-dashed border-orange-300 rounded-2xl p-8 text-center hover:border-orange-500 transition">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-orange-500 mb-3"></i>
                                        <p class="text-sm font-semibold text-gray-700">Click to upload</p>
                                        <p class="text-xs text-gray-500">or drag and drop</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Name Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-orange-500"></i>First Name
                        </label>
                        <input type="text" name="first_name" value="<?php echo htmlspecialchars($currentUser['first_name']); ?>" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-orange-500"></i>Last Name
                        </label>
                        <input type="text" name="last_name" value="<?php echo htmlspecialchars($currentUser['last_name']); ?>" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition" />
                    </div>
                </div>

                <!-- Phone -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-phone mr-2 text-orange-500"></i>Phone
                    </label>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($currentUser['phone']); ?>" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition" />
                </div>

                <!-- Staff Specific Fields -->
                <?php if ($currentUser['role'] === 'staff'): ?>
                    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 mb-6">
                        <h3 class="font-semibold text-gray-900 mb-4"><i class="fas fa-store mr-2 text-blue-500"></i>Store Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Store Name</label>
                                <input type="text" name="store_name" value="<?php echo htmlspecialchars($currentUser['store_name']); ?>" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Store Address</label>
                                <input type="text" name="store_address" value="<?php echo htmlspecialchars($currentUser['store_address']); ?>" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold py-3 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition">
                    <i class="fas fa-save mr-2"></i>Update Profile
                </button>
            </form>
        </div>

        <!-- Password Form -->
        <div class="bg-white rounded-2xl shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6"><i class="fas fa-lock mr-3 text-red-500"></i>Change Password</h2>
            <form method="post" action="/?page=account">
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-key mr-2 text-red-500"></i>Current Password
                    </label>
                    <input type="password" name="current_password" required 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition" />
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock-open mr-2 text-red-500"></i>New Password
                    </label>
                    <input type="password" name="new_password" required 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition" />
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-pink-500 text-white font-bold py-3 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition">
                    <i class="fas fa-check mr-2"></i>Update Password
                </button>
            </form>
        </div>
    </div>
</body>
</html>