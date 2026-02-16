<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex flex-col md:flex-row h-screen">
       <!-- Sidebar (Mobile responsive) -->
        <nav class="w-full md:w-64 bg-white shadow-md md:sticky md:top-0">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mt-4">Staff Console</h2>
            </div>
            <ul class="divide-y">
                <li><a href="/?page=dashboard" class="text-gray-700 hover:text-blue-500 block px-6 py-4 transition">
                    <i class="fas fa-home mr-3"></i>Dashboard
                </a></li>
                <?php if (auth_user()['role'] === 'staff'): ?>
                <li><a href="/?page=staff" class="text-gray-700 hover:text-blue-500 block px-6 py-4 transition">
                    <i class="fas fa-user-cog mr-3"></i>Manage Products
                </a></li>
                <?php endif; ?>

                <li><a href="/?page=account" class="text-blue-600 bg-blue-50 font-semibold block px-6 py-4 border-l-4 border-blue-500">
                    <i class="fas fa-box mr-3"></i>Profile
                </a></li>
                <li><a href="/?page=logout" class="text-red-500 hover:text-red-700 block px-6 py-4 transition font-semibold">
                    <i class="fas fa-sign-out-alt mr-3"></i>Logout
                </a></li>
            </ul>
        </nav>


        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="p-6 md:p-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2"><i class="fas fa-user-circle mr-3 text-blue-600"></i>My Account</h1>
                <p class="text-gray-600 mb-8">Welcome, <span class="font-semibold text-gray-900"><?php echo htmlspecialchars(auth_user()['email']); ?></span></p>
        <?php
            // fetch fresh user record for profile fields
            $uid = auth_user()['id'];
            $stmt = db_connect()->prepare('SELECT * FROM users WHERE id = ?');
            $stmt->execute([$uid]);
            $currentUser = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <!-- Alert Messages -->
        <?php if (!empty($message)): ?>
            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 text-blue-700 rounded-lg flex items-center">
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
            <h2 class="text-2xl font-bold text-gray-900 mb-6"><i class="fas fa-info-circle mr-3 text-blue-600"></i>Account Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Email</p>
                    <p class="text-lg font-semibold text-gray-900"><?php echo htmlspecialchars(auth_user()['email']); ?></p>
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
            <h2 class="text-2xl font-bold text-gray-900 mb-6"><i class="fas fa-user-edit mr-3 text-blue-600"></i>Update Profile</h2>
            <form method="post" action="/?page=account" enctype="multipart/form-data">
                <!-- Photo Upload -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-gray-700 mb-4">
                        <i class="fas fa-image mr-2 text-blue-600"></i>Profile Photo
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
                                    <div class="border-2 border-dashed border-blue-300 rounded-2xl p-8 text-center hover:border-blue-500 transition">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-blue-600 mb-3"></i>
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
                            <i class="fas fa-user mr-2 text-blue-600"></i>First Name
                        </label>
                        <input type="text" name="first_name" value="<?php echo htmlspecialchars($currentUser['first_name']); ?>" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-blue-600"></i>Last Name
                        </label>
                        <input type="text" name="last_name" value="<?php echo htmlspecialchars($currentUser['last_name']); ?>" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                    </div>
                </div>

                <!-- Phone -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-phone mr-2 text-blue-600"></i>Phone
                    </label>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($currentUser['phone']); ?>" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                </div>

                <!-- Staff Specific Fields -->
                <?php if ($currentUser['role'] === 'staff'): ?>
                    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 mb-6">
                        <h3 class="font-semibold text-gray-900 mb-6 text-lg"><i class="fas fa-store mr-2 text-blue-600"></i>Store Information</h3>
                        
                        <!-- Store Cover Image -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-image mr-2 text-blue-600"></i>Store Cover Image
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex flex-col items-center justify-center">
                                    <?php if (!empty($currentUser['store_cover_image'])): ?>
                                        <img src="/<?php echo htmlspecialchars($currentUser['store_cover_image']); ?>" width="200" height="100" class="rounded-lg object-cover shadow-lg mb-4" alt="Store Cover">
                                    <?php else: ?>
                                        <div class="w-full h-32 bg-gray-300 rounded-lg flex items-center justify-center text-gray-500 mb-4">
                                            <i class="fas fa-store text-4xl opacity-30"></i>
                                        </div>
                                    <?php endif; ?>
                                    <p class="text-sm text-gray-600 text-center">Current Cover</p>
                                </div>
                                <div class="flex items-center">
                                    <div class="relative w-full">
                                        <input type="file" name="store_cover_image" accept="image/*" class="hidden" id="coverInput" />
                                        <label for="coverInput" class="block cursor-pointer">
                                            <div class="border-2 border-dashed border-blue-300 rounded-lg p-6 text-center hover:border-blue-500 transition">
                                                <i class="fas fa-cloud-upload-alt text-3xl text-blue-600 mb-2"></i>
                                                <p class="text-sm font-semibold text-gray-700">Click to upload</p>
                                                <p class="text-xs text-gray-500">or drag and drop</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Store Basic Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Store Name</label>
                                <input type="text" name="store_name" value="<?php echo htmlspecialchars($currentUser['store_name'] ?? ''); ?>" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">GCash Number</label>
                                <input type="text" name="gcash_number" value="<?php echo htmlspecialchars($currentUser['gcash_number'] ?? ''); ?>" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                                    placeholder="e.g., 09xxxxxxxxx" />
                            </div>
                        </div>

                        <!-- Store Address -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Store Address</label>
                            <input type="text" name="store_address" value="<?php echo htmlspecialchars($currentUser['store_address'] ?? ''); ?>" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                                placeholder="Street, City, Barangay" />
                        </div>

                        <!-- Store Description -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Store Description</label>
                            <textarea name="store_description" rows="4"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                                placeholder="Write a brief description about your store..."><?php echo htmlspecialchars($currentUser['store_description'] ?? ''); ?></textarea>
                        </div>
                    </div>
                <?php endif; ?>

                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition">
                    <i class="fas fa-save mr-2"></i>Update Profile
                </button>
            </form>
        </div>

        <!-- Password Form -->
        <div class="bg-white rounded-2xl shadow-md p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6"><i class="fas fa-lock mr-3 text-blue-600"></i>Change Password</h2>
            <form method="post" action="/?page=account">
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-key mr-2 text-blue-600"></i>Current Password
                    </label>
                    <input type="password" name="current_password" required 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock-open mr-2 text-blue-600"></i>New Password
                    </label>
                    <input type="password" name="new_password" required 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition">
                    <i class="fas fa-check mr-2"></i>Update Password
                </button>
            </form>
        </div>
            </div>
        </div>
    </div>
</body>
</html>