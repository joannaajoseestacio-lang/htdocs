<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl mb-4">Edit Product</h1>
        <?php if ($product): ?>
            <form method="post" action="/?page=edit_product&id=<?php echo $product['id']; ?>" enctype="multipart/form-data">
                <div class="mb-2">
                    <label class="block">Name</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required class="border p-1 w-full">
                </div>
                <div class="mb-2">
                    <label class="block">Description</label>
                    <textarea name="description" class="border p-1 w-full"><?php echo htmlspecialchars($product['description']); ?></textarea>
                </div>
                <div class="mb-2">
                    <label class="block">Price</label>
                    <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required class="border p-1 w-full">
                </div>
                <div class="mb-2">
                    <label class="block">Image</label>
                    <?php if (!empty($product['image_path'])): ?>
                        <div class="mb-1"><img src="/<?php echo htmlspecialchars($product['image_path']); ?>" width="100" alt=""></div>
                    <?php endif; ?>
                    <input type="file" name="image" accept="image/*" class="border p-1 w-full">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2">Update</button>
            </form>
        <?php else: ?>
            <p>Product not found.</p>
        <?php endif; ?>
        <div class="mt-4">
            <a href="/?page=staff" class="text-blue-500">Back to Staff Panel</a>
        </div>
    </div>
</body>
</html>
