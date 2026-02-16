<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 max-w-md">
        <h1 class="text-2xl mb-4">Register</h1>
        <form method="post" action="/?page=register" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block mb-1">First Name</label>
                <input type="text" name="first_name" class="w-full border p-2" />
            </div>
            <div class="mb-4">
                <label class="block mb-1">Last Name</label>
                <input type="text" name="last_name" class="w-full border p-2" />
            </div>
            <div class="mb-4">
                <label class="block mb-1">Phone</label>
                <input type="text" name="phone" class="w-full border p-2" />
            </div>
            <div class="mb-4">
                <label class="block mb-1">Photo</label>
                <input type="file" name="photo" accept="image/*" class="w-full border p-2" />
            </div>
            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" name="email" required class="w-full border p-2" />
            </div>
            <div class="mb-4">
                <label class="block mb-1">Password</label>
                <input type="password" name="password" required class="w-full border p-2" />
            </div>
            <div class="mb-4">
                <label class="block mb-1">Role</label>
                <select name="role" class="w-full border p-2">
                    <option value="student">Student</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2">Register</button>
        </form>
    </div>
</body>
</html>
