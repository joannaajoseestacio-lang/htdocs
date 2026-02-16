<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Panel - FoodApp</title>
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
                <li><a href="/?page=staff" class="text-blue-600 bg-blue-50 font-semibold block px-6 py-4 border-l-4 border-blue-500">
                    <i class="fas fa-box mr-3"></i>Manage Products
                </a></li>
                <li><a href="/?page=account" class="text-gray-700 hover:text-blue-500 block px-6 py-4 transition">
                    <i class="fas fa-user-cog mr-3"></i>Profile
                </a></li>
                <li><a href="/?page=logout" class="text-red-500 hover:text-red-700 block px-6 py-4 transition font-semibold">
                    <i class="fas fa-sign-out-alt mr-3"></i>Logout
                </a></li>
            </ul>
        </nav>

        <!-- Add Product Modal Script -->
        <script>
            function openAddProductModal() {
                document.getElementById('addProductModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeAddProductModal() {
                document.getElementById('addProductModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
                document.getElementById('addProductForm').reset();
            }

            // Close modal on outside click
            document.getElementById('addProductModal')?.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeAddProductModal();
                }
            });

            // Close modal on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeAddProductModal();
                }
            });
        </script>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="p-6 md:p-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Manage Products</h1>
                    <p class="text-gray-600">Welcome, <span class="font-semibold text-gray-900"><?php echo htmlspecialchars(auth_user()['email']); ?></span></p>
                </div>

                <!-- Products Section -->
                <div class="mb-12">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900"><i class="fas fa-list mr-3 text-blue-600"></i>Your Products</h2>
                        <button onclick="openAddProductModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:shadow-lg transition">
                            <i class="fas fa-plus mr-2"></i>Add New
                        </button>
                    </div>

                    <?php if (!empty($products)): ?>
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-blue-50 border-b">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">ID</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Image</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Name</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Description</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Price</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody divide-y">
                                        <?php foreach ($products as $p): ?>
                                            <tr class="hover:bg-blue-50 transition border-b">
                                                <td class="px-6 py-4 text-sm font-mono text-gray-600">#<?php echo $p['id']; ?></td>
                                                <td class="px-6 py-4">
                                                    <?php if (!empty($p['image_path'])): ?>
                                                        <img src="/<?php echo htmlspecialchars($p['image_path']); ?>" width="50" height="50" class="rounded-lg object-cover" alt="Product">
                                                    <?php else: ?>
                                                        <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                                                            <i class="fas fa-image"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="px-6 py-4 text-sm font-semibold text-gray-900"><?php echo htmlspecialchars($p['name']); ?></td>
                                                <td class="px-6 py-4 text-sm text-gray-600"><?php echo substr(htmlspecialchars($p['description']), 0, 30) . (strlen($p['description']) > 30 ? '...' : ''); ?></td>
                                                <td class="px-6 py-4 text-sm font-bold text-green-600">₱<?php echo number_format($p['price'], 2); ?></td>
                                                <td class="px-6 py-4 text-sm flex gap-2">
                                                    <a href="/?page=edit_product&id=<?php echo $p['id']; ?>" class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form method="post" action="/?page=delete_product" class="inline" onsubmit="return confirm('Delete this product?');">
                                                        <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                                                        <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 transition">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="bg-white rounded-2xl shadow-md p-12 text-center">
                            <div class="text-5xl text-gray-300 mb-4">
                                <i class="fas fa-inbox"></i>
                            </div>
                            <p class="text-xl text-gray-600 mb-6">No products yet</p>
                            <p class="text-gray-500 mb-6">Get started by adding your first product</p>
                            <button onclick="openAddProductModal()" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:shadow-lg transition">
                                <i class="fas fa-plus mr-2"></i>Create Your First Product
                            </button>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Add Product Modal -->
                <div id="addProductModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
                    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                        <!-- Modal Header -->
                        <div class="sticky top-0 bg-blue-600 p-6 flex items-center justify-between">
                            <h2 class="text-2xl font-bold text-white"><i class="fas fa-plus-circle mr-3"></i>Add New Product</h2>
                            <button onclick="closeAddProductModal()" class="text-white hover:bg-white hover:bg-opacity-20 rounded-lg p-2 transition">
                                <i class="fas fa-times text-2xl"></i>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="p-8">
                            <form method="post" action="/?page=staff" enctype="multipart/form-data" id="addProductForm">
                                <input type="hidden" name="action" value="create">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-heading mr-2 text-blue-600"></i>Product Name
                                        </label>
                                        <input type="text" name="name" required 
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                                            placeholder="e.g., Delicious Pizza">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-align-left mr-2 text-blue-600"></i>Description
                                        </label>
                                        <textarea name="description" rows="3"
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                                            placeholder="Describe your product..."></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-dollar-sign mr-2 text-blue-600"></i>Price
                                        </label>
                                        <input type="number" step="0.01" name="price" required 
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                                            placeholder="0.00">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-image mr-2 text-blue-600"></i>Product Image
                                        </label>
                                        <input type="file" name="image" accept="image/*" 
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-4 pt-6 border-t border-gray-200">
                                    <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-3 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition">
                                        <i class="fas fa-check mr-2"></i>Create Product
                                    </button>
                                    <button type="button" onclick="closeAddProductModal()" class="flex-1 border-2 border-gray-300 text-gray-700 font-bold py-3 rounded-lg hover:bg-gray-50 transition">
                                        <i class="fas fa-times mr-2"></i>Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
