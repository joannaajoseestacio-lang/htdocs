<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-white text-gray-900">
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 p-2 rounded-lg">
                    <i class="fas fa-utensils text-white text-2xl"></i>
                </div>
                <span class="ml-3 text-2xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">FoodApp</span>
            </div>
            <div class="flex gap-4">
                <?php if (auth_check()): ?>
                    <a href="/?page=dashboard" class="flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition">
                        <i class="fas fa-th-large mr-2"></i>Dashboard
                    </a>
                    <a href="/?page=logout" class="flex items-center px-4 py-2 text-red-500 border border-red-500 rounded-lg hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                <?php else: ?>
                    <a href="/?page=login" class="flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                    <a href="/?page=register" class="flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition">
                        <i class="fas fa-user-plus mr-2"></i>Register
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen bg-gradient-to-br from-orange-50 to-red-50 flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Content -->
                <div>
                    <h1 class="text-5xl md:text-6xl font-bold mb-6">
                        <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">Discover Amazing Foods</span>
                        <br>
                        <span class="text-gray-900">at LCC Canteen</span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Connect with local food vendors, explore delicious meals, and support your community. Experience food like never before.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <?php if (!auth_check()): ?>
                            <a href="/?page=register" class="px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg font-semibold hover:shadow-xl transform hover:-translate-y-1 transition text-center">
                                <i class="fas fa-rocket mr-2"></i>Get Started
                            </a>
                            <a href="/?page=login" class="px-8 py-4 border-2 border-orange-500 text-orange-500 rounded-lg font-semibold hover:bg-orange-50 transition text-center">
                                <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                            </a>
                        <?php else: ?>
                            <a href="/?page=dashboard" class="px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-lg font-semibold hover:shadow-xl transform hover:-translate-y-1 transition text-center">
                                <i class="fas fa-arrow-right mr-2"></i>Go to Dashboard
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Illustration -->
                <div class="hidden md:flex justify-center">
                    <div class="text-center">
                        <i class="fas fa-utensils text-9xl text-orange-200 drop-shadow-lg"></i>
                        <div class="mt-8 grid grid-cols-3 gap-4">
                            <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition">
                                <i class="fas fa-apple-alt text-3xl text-red-500 mb-2"></i>
                                <p class="text-sm font-semibold">Fresh</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition">
                                <i class="fas fa-lightning-bolt text-3xl text-yellow-500 mb-2"></i>
                                <p class="text-sm font-semibold">Fast</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition">
                                <i class="fas fa-smile text-3xl text-green-500 mb-2"></i>
                                <p class="text-sm font-semibold">Happy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-bold text-center mb-16">Why Choose FoodApp?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 bg-gradient-to-br from-orange-50 to-red-50 rounded-xl hover:shadow-lg transition">
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 p-4 rounded-lg w-fit mb-4">
                        <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Find Nearby</h3>
                    <p class="text-gray-600">Discover food vendors and restaurants in your area with just one tap.</p>
                </div>
                <div class="p-8 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl hover:shadow-lg transition">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 p-4 rounded-lg w-fit mb-4">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Real-time Updates</h3>
                    <p class="text-gray-600">Get instant notifications about new products and special offers.</p>
                </div>
                <div class="p-8 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl hover:shadow-lg transition">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 p-4 rounded-lg w-fit mb-4">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Secure & Safe</h3>
                    <p class="text-gray-600">Your data is protected with industry-leading security measures.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <p class="mb-4"><i class="fas fa-utensils mr-2"></i>FoodApp © 2026</p>
            <p class="text-gray-400">Connecting food lovers with amazing cuisines</p>
        </div>
    </footer>
</body>
</html>
