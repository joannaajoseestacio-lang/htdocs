<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account - FoodApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl mb-4">My Account</h1>
        <?php
            // fetch fresh user record for profile fields
            $uid = auth_user()['id'];
            $stmt = db_connect()->prepare('SELECT * FROM users WHERE id = ?');
            $stmt->execute([$uid]);
            $currentUser = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <p>Email: <?php echo htmlspecialchars($currentUser['email']); ?></p>
        <p>Role: <?php echo htmlspecialchars($currentUser['role']); ?></p>

        <?php if (!empty($message)): ?>
            <p class="text-green-600"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <p class="text-red-600"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <h2 class="text-xl mt-6">Profile</h2>
        <form method="post" action="/?page=account" enctype="multipart/form-data">
            <div class="mb-2">
                <label class="block">First Name</label>
                <input type="text" name="first_name" value="<?php echo htmlspecialchars($currentUser['first_name']); ?>" class="border p-1 w-full">
            </div>
            <div class="mb-2">
                <label class="block">Last Name</label>
                <input type="text" name="last_name" value="<?php echo htmlspecialchars($currentUser['last_name']); ?>" class="border p-1 w-full">
            </div>
            <div class="mb-2">
                <label class="block">Phone</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($currentUser['phone']); ?>" class="border p-1 w-full">
            </div>
            <div class="mb-2">
                <label class="block">Photo</label>
                <?php if (!empty($currentUser['photo_path'])): ?>
                    <div class="mb-1"><img src="/<?php echo htmlspecialchars($currentUser['photo_path']); ?>" width="100" alt=""></div>
                <?php endif; ?>
                <input type="file" name="photo" accept="image/*" class="border p-1 w-full">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Update Profile</button>
        </form>

        <h2 class="text-xl mt-6">Change Password</h2>
        <form method="post" action="/?page=account">
            <div class="mb-2">
                <label class="block">Current Password</label>
                <input type="password" name="current_password" required class="border p-1 w-full">
            </div>
            <div class="mb-2">
                <label class="block">New Password</label>
                <input type="password" name="new_password" required class="border p-1 w-full">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Update Password</button>
        </form>

        <div class="mt-4">
            <a href="/?page=staff" class="text-blue-500">Back to Staff Panel</a>
        </div>
    </div>
</body>
</html>