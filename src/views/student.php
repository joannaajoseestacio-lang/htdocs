<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Products - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 p-2 rounded-lg">
                    <i class="fas fa-utensils text-white text-2xl"></i>
                </div>
                <span class="ml-3 text-2xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">LCC Foods</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="/?page=dashboard" class="text-gray-700 hover:text-orange-500 transition">
                    <i class="fas fa-th-large mr-2"></i>Dashboard
                </a>
                <a href="/?page=account" class="text-gray-700 hover:text-orange-500 transition">
                    <i class="fas fa-user-circle text-2xl"></i>
                </a>
                <a href="/?page=logout" class="px-4 py-2 text-red-500 border border-red-500 rounded-lg hover:bg-red-50 transition">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-12">
            <div class="">
                <h1 class="text-2xl md:text-3xl font-bold mb-2">Browse Food Products</h1>
                <p class="text-lg text-gray-400">Discover delicious food from local lcc vendors.</p>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <div class="mb-8 flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <input type="text" id="searchInput" placeholder="Search products..." 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                <i class="fas fa-search absolute right-3 top-4 text-gray-400"></i>
            </div>
            <div class="flex gap-2">
                <button onclick="filterByPrice('all')" class="px-4 py-3 bg-white border border-gray-300 rounded-lg hover:border-green-500 transition">
                    All Prices
                </button>
                <button onclick="filterByPrice('low')" class="px-4 py-3 bg-white border border-gray-300 rounded-lg hover:border-green-500 transition">
                    Under ₱10
                </button>
            </div>
        </div>

        <!-- Products Grid -->
        <?php if (!empty($products)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="productsGrid">
                <?php foreach ($products as $product): ?>
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition transform hover:-translate-y-1 product-card" data-price="<?php echo $product['price']; ?>" data-name="<?php echo strtolower($product['name']); ?>">
                        <!-- Image -->
                        <div class="relative h-48 bg-gradient-to-br from-gray-200 to-gray-300 overflow-hidden cursor-pointer" onclick="openProductModal(<?php echo htmlspecialchars(json_encode($product)); ?>)">
                            <?php if (!empty($product['image_path'])): ?>
                                <img src="/<?php echo htmlspecialchars($product['image_path']); ?>" 
                                    class="w-full h-full object-cover hover:scale-110 transition duration-300" 
                                    alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-utensils text-5xl opacity-30"></i>
                                </div>
                            <?php endif; ?>
                            <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-star mr-1"></i>New
                            </div>
                            <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 transition flex items-center justify-center">
                                <span class="text-white text-sm font-semibold opacity-0 hover:opacity-100 transition">View Details</span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                <?php echo htmlspecialchars($product['name']); ?>
                            </h3>

                            <!-- Description -->
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                <?php echo htmlspecialchars($product['description']); ?>
                            </p>

                            <!-- Vendor/Store Info (if available) -->
                            <div class="mb-4 pb-4 border-b border-gray-200">
                                <p class="text-xs text-gray-500">
                                    <i class="fas fa-store mr-1"></i>
                                     <?php echo htmlspecialchars($product['store_name']); ?>
                                </p>
                            </div>

                            <!-- Price & Action -->
                            <div class="flex items-center justify-between">
                                <div class="text-2xl font-bold text-green-600">
                                    ₱<?php echo number_format($product['price'], 2); ?>
                                </div>
                                <button onclick="openProductModal(<?php echo htmlspecialchars(json_encode($product)); ?>)" class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg hover:shadow-lg transition font-semibold">
                                    <i class="fas fa-shopping-cart mr-2"></i>Order
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-md p-12 text-center">
                <div class="text-6xl text-gray-300 mb-4">
                    <i class="fas fa-inbox"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">No Products Available</h2>
                <p class="text-gray-600 mb-6">No food products are available right now. Please check back later.</p>
                <a href="/?page=dashboard" class="inline-block px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg hover:shadow-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Product Details Modal -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-green-500 to-emerald-500 p-6 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-white" id="modalProductName">Product Name</h2>
                <button onclick="closeProductModal()" class="text-white hover:bg-white hover:bg-opacity-20 rounded-lg p-2 transition">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-8">
                <!-- Product Image -->
                <div class="mb-8 rounded-xl overflow-hidden h-80 bg-gray-200">
                    <img id="modalProductImage" src="" alt="Product" class="w-full h-full object-cover">
                </div>

                <!-- Product Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Left Column -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-600 mb-2 uppercase">Price</h3>
                        <p class="text-4xl font-bold text-green-600 mb-6" id="modalProductPrice">₱0.00</p>

                        <h3 class="text-sm font-semibold text-gray-600 mb-2 uppercase">Product ID</h3>
                        <p class="text-lg text-gray-900 mb-6 font-mono" id="modalProductID">#000</p>

                        <h3 class="text-sm font-semibold text-gray-600 mb-2 uppercase">Status</h3>
                        <div class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                            <i class="fas fa-check-circle mr-2"></i>Available
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-600 mb-2 uppercase">Description</h3>
                        <p class="text-gray-700 leading-relaxed mb-6" id="modalProductDescription">No description available</p>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-8"></div>

                <!-- Additional Info -->
                <div class="bg-gray-50 rounded-xl p-6 mb-8">
                    <h3 class="text-sm font-semibold text-gray-600 mb-4 uppercase"><i class="fas fa-info-circle mr-2 text-blue-500"></i>Product Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-600 mb-1">Vendor</p>
                            <p class="text-gray-900 font-semibold" id="modalVendorName">Local Food Store</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600 mb-1">Category</p>
                            <p class="text-gray-900 font-semibold">Food & Beverages</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <button onclick="addToCart()" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-bold py-3 rounded-lg hover:shadow-lg transition">
                        <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
                    </button>
                    <button onclick="closeProductModal()" class="flex-1 border-2 border-gray-300 text-gray-700 font-bold py-3 rounded-lg hover:bg-gray-50 transition">
                        <i class="fas fa-times mr-2"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Product Modal Functions
        function openProductModal(product) {
            document.getElementById('modalProductName').textContent = product.name;
            document.getElementById('modalProductPrice').textContent = '₱' + parseFloat(product.price).toFixed(2);
            document.getElementById('modalProductID').textContent = '#' + product.id;
            document.getElementById('modalProductDescription').textContent = product.description || 'No description available';
            document.getElementById('modalVendorName').textContent = product.store_name || 'Unknown Store';
            
            if (product.image_path) {
                document.getElementById('modalProductImage').src = '/' + product.image_path;
            } else {
                document.getElementById('modalProductImage').src = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"%3E%3Crect fill="%23e5e7eb" width="100" height="100"/%3E%3Ctext x="50" y="50" font-size="20" fill="%239ca3af" text-anchor="middle" dy=".3em"%3ENo Image%3C/text%3E%3C/svg%3E';
            }
            
            document.getElementById('productModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeProductModal() {
            document.getElementById('productModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function addToCart() {
            alert('Shopping cart functionality coming soon!');
        }

        // Close modal on outside click
        document.getElementById('productModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeProductModal();
            }
        });

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeProductModal();
            }
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.product-card');
            
            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                if (name.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
        
        // Price filter functionality
        function filterByPrice(filter) {
            const cards = document.querySelectorAll('.product-card');
            
            cards.forEach(card => {
                const price = parseFloat(card.getAttribute('data-price'));
                let show = true;
                
                if (filter === 'low' && price >= 10) {
                    show = false;
                }
                
                card.style.display = show ? '' : 'none';
            });
        }
    </script>
</body>
</html>
