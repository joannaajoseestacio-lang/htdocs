<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-blue-50 min-h-screen py-12 px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-blue-600 px-6 py-8">
                <div class="flex justify-center mb-3">
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-white text-center">Create Account</h1>
                <p class="text-blue-100 text-center mt-2">Join FoodApp community</p>
            </div>

            <!-- Form -->
            <form method="post" action="/?page=register" enctype="multipart/form-data" class="p-6 md:p-8">
                <!-- Row 1: Name fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-blue-600"></i>First Name
                        </label>
                        <input type="text" name="first_name" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                            placeholder="Joanna" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-blue-600"></i>Last Name
                        </label>
                        <input type="text" name="last_name" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                            placeholder="Estacio" />
                    </div>
                </div>

                <!-- Row 2: Contact info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-phone mr-2 text-blue-600"></i>Phone
                        </label>
                        <input type="text" name="phone" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                            placeholder="09xxxxxxxxx" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-blue-600"></i>Email
                        </label>
                        <input type="email" name="email" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                            placeholder="you@example.com" />
                    </div>
                </div>

                <!-- Row 3: Password -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                        </label>
                        <input type="password" name="password" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                            placeholder="••••••••" />
                    </div>
                </div>

                <!-- Row 4: Role -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-briefcase mr-2 text-blue-600"></i>Select Role
                    </label>
                    <select name="role" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="student">🎓 Student</option>
                        <option value="staff">👨‍💼 Staff / Store Owner</option>
                        <option value="admin">👨‍💻 Admin</option>
                    </select>
                </div>

                <!-- Conditional fields for staff -->
                <div id="staffFields" class="hidden">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-5">
                        <h3 class="font-semibold text-gray-700 mb-4"><i class="fas fa-store mr-2 text-blue-600"></i>Store Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Store Name</label>
                                <input type="text" name="store_name" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                                    placeholder="Your Store Name" />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Store Address</label>
                                <input type="text" name="store_address" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                                    placeholder="123 Main St, City" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Photo upload -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-image mr-2 text-blue-600"></i>Profile Photo
                    </label>
                    <div class="mt-2 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-blue-500 transition cursor-pointer">
                        <input type="file" name="photo" accept="image/*" class="hidden" id="photoInput" />
                        <label for="photoInput" class="cursor-pointer text-center">
                            <div class="text-gray-600">
                                <i class="fas fa-cloud-upload-alt text-3xl text-blue-600 mb-2"></i>
                                <p class="text-sm">Click to upload or drag and drop</p>
                                <p class="text-xs text-gray-500">PNG, JPG up to 5MB</p>
                            </div>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                    <i class="fas fa-user-check mr-2"></i>Create Account
                </button>
            </form>

            <!-- Footer -->
            <div class="px-6 md:px-8 pb-6 bg-gray-50 border-t border-gray-200">
                <p class="text-center text-gray-600 text-sm">
                    Already have an account? 
                    <a href="/?page=login" class="text-blue-600 font-semibold hover:text-blue-700 transition">Login here</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        const roleSelect = document.querySelector('select[name="role"]');
        const staffFields = document.getElementById('staffFields');
        
        function toggleStaffFields() {
            if (roleSelect.value === 'staff') {
                staffFields.classList.remove('hidden');
            } else {
                staffFields.classList.add('hidden');
            }
        }
        
        roleSelect.addEventListener('change', toggleStaffFields);
        toggleStaffFields();
    </script>
</body>
</html>
