<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Panel - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 flex">
        <!-- sidebar -->
        <nav class="w-1/4 bg-white p-4 shadow mr-4">
            <h2 class="text-xl mb-2">Account</h2>
            <ul>
                <li><a href="/?page=dashboard" class="text-blue-500 block mb-1">Dashboard</a></li>
                <li><a href="/?page=staff" class="text-blue-500 block mb-1">Manage Products</a></li>
                <li><a href="/?page=account" class="text-blue-500 block mb-1">Profile</a></li>
                <li><a href="/?page=logout" class="text-red-500 block">Logout</a></li>
            </ul>
        </nav>
        <div class="w-3/4">
            <h1 class="text-3xl mb-4">Staff Panel</h1>
            <p>Welcome, <?php echo htmlspecialchars(auth_user()['email']); ?>!</p>
            <p>Here you can manage products.</p>

            <!-- product list -->
        <h2 class="text-2xl mt-6 mb-2">Products</h2>
        <?php if (!empty($products)): ?>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Image</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $p): ?>
                    <tr class="border-t">
                        <td class="px-4 py-2"><?php echo $p['id']; ?></td>
                        <td class="px-4 py-2">
                            <?php if (!empty($p['image_path'])): ?>
                                <img src="/<?php echo htmlspecialchars($p['image_path']); ?>" width="50" alt="">
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($p['name']); ?></td>
                        <td class="px-4 py-2">$<?php echo number_format($p['price'],2); ?></td>
                        <td class="px-4 py-2">
                            <a href="/?page=edit_product&id=<?php echo $p['id']; ?>" class="text-blue-500">Edit</a>
                            <form method="post" action="/?page=delete_product" class="inline">
                                <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                                <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Delete this product?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No products yet.</p>
        <?php endif; ?>

        <!-- create product form -->
        <h2 class="text-2xl mt-6 mb-2">Add new product</h2>
        <form method="post" action="/?page=staff" enctype="multipart/form-data">
            <input type="hidden" name="action" value="create">
            <div class="mb-2">
                <label class="block">Name</label>
                <input type="text" name="name" required class="border p-1 w-full">
            </div>
            <div class="mb-2">
                <label class="block">Description</label>
                <textarea name="description" class="border p-1 w-full"></textarea>
            </div>
            <div class="mb-2">
                <label class="block">Price</label>
                <input type="number" step="0.01" name="price" required class="border p-1 w-full">
            </div>
            <div class="mb-2">
                <label class="block">Image</label>
                <input type="file" name="image" accept="image/*" class="border p-1 w-full">
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2">Create</button>
        </form>

        <div class="mt-4">
            <a href="/?page=dashboard" class="text-blue-500">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
