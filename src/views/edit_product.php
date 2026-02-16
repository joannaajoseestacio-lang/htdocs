<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <div class="bg-blue-600 p-2 rounded-lg">
                    <i class="fas fa-box text-white text-2xl"></i>
                </div>
                <span class="ml-3 text-2xl font-bold text-blue-600">Edit Product</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="/?page=staff" class="text-gray-700 hover:text-blue-500 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <?php if ($product): ?>
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <!-- Header -->
                <div class="bg-blue-600 px-8 py-8">
                    <h1 class="text-3xl font-bold text-white"><i class="fas fa-edit mr-3"></i>Edit Product</h1>
                    <p class="text-blue-100 mt-2">Product ID: #<?php echo $product['id']; ?></p>
                </div>

                <!-- Form -->
                <form method="post" action="/?page=edit_product&id=<?php echo $product['id']; ?>" enctype="multipart/form-data" class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Left Column: Image -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-4"><i class="fas fa-image mr-2 text-blue-600"></i>Product Image</label>
                            <div class="mb-4">
                                <?php if (!empty($product['image_path'])): ?>
                                    <img src="/<?php echo htmlspecialchars($product['image_path']); ?>" class="w-full rounded-xl shadow-lg object-cover" alt="Product">
                                    <p class="text-sm text-gray-500 mt-2">Current Image</p>
                                <?php else: ?>
                                    <div class="w-full h-64 bg-gray-200 rounded-xl flex items-center justify-center text-gray-400">
                                        <div class="text-center">
                                            <i class="fas fa-image text-4xl mb-2"></i>
                                            <p class="text-sm">No image</p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="relative">
                                <input type="file" name="image" accept="image/*" class="hidden" id="imageInput" />
                                <label for="imageInput" class="block cursor-pointer">
                                    <div class="border-2 border-dashed border-blue-300 rounded-xl p-6 text-center hover:border-blue-500 transition">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-blue-600 mb-2"></i>
                                        <p class="text-sm font-semibold text-gray-700">Upload new image</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, up to 5MB</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Right Column: Details -->
                        <div>
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-2"><i class="fas fa-heading mr-2 text-blue-600"></i>Product Name</label>
                                <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-2"><i class="fas fa-dollar-sign mr-2 text-blue-600"></i>Price</label>
                                <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                            </div>

                            <div class="bg-blue-50 rounded-xl p-4">
                                <p class="text-sm text-gray-600 mb-1">Created</p>
                                <p class="font-semibold text-gray-900">Product #{<?php echo $product['id']; ?>}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-2"><i class="fas fa-align-left mr-2 text-blue-600"></i>Description</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                            placeholder="Enter product description..."><?php echo htmlspecialchars($product['description']); ?></textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-3 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                        <a href="/?page=staff" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-bold rounded-lg hover:bg-gray-50 transition text-center">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-2xl shadow-md p-12 text-center">
                <div class="text-5xl text-gray-300 mb-4">
                    <i class="fas fa-search"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Product Not Found</h2>
                <p class="text-gray-600 mb-8">The product you're trying to edit doesn't exist.</p>
                <a href="/?page=staff" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:shadow-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Products
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
