<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gradient-to-br from-orange-50 to-red-50 min-h-screen flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-8">
                <div class="flex justify-center mb-3">
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <i class="fas fa-utensils text-white text-2xl"></i>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-white text-center">LCC Foods</h1>
                <p class="text-orange-100 text-center mt-2">Order food with love</p>
            </div>

            <!-- Form -->
            <form method="post" action="/?page=login" class="p-6 md:p-8">
                <?php if (!empty($error)): ?>
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center">
                        <i class="fas fa-exclamation-circle mr-3"></i>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-orange-500"></i>Email Address
                    </label>
                    <input type="email" name="email" required 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition" 
                        placeholder="you@example.com" />
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-orange-500"></i>Password
                    </label>
                    <input type="password" name="password" required 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition" 
                        placeholder="••••••••" />
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold py-3 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>
            </form>

            <!-- Footer -->
            <div class="px-6 md:px-8 pb-6">
                <p class="text-center text-gray-600 text-sm">
                    Don't have an account? 
                    <a href="/?page=register" class="text-orange-500 font-semibold hover:text-red-500 transition">Register here</a>
                </p>
            </div>
        </div>

        <!-- Back to home -->
        <div class="text-center mt-6">
            <a href="/?page=home" class="text-gray-600 hover:text-orange-500 transition text-sm">
                <i class="fas fa-arrow-left mr-2"></i>Back to Home
            </a>
        </div>
    </div>
</body>
</html>
