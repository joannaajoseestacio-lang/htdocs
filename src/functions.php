<?php

// database connection
function db_connect()
{
    static $pdo;
    if ($pdo === null) {
        $host = getenv('DB_HOST') ?: '127.0.0.1';
        $db   = getenv('DB_NAME') ?: 'foodapp';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: '';
        $dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $pdo;
}

// user helper
function user_find_by_email(string $email)
{
    $stmt = db_connect()->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function user_create(array $data)
{
    $stmt = db_connect()->prepare('INSERT INTO users (first_name, last_name, email, password, role, phone, photo_path, store_name, store_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    return $stmt->execute([
        $data['first_name'] ?? null,
        $data['last_name'] ?? null,
        $data['email'],
        password_hash($data['password'], PASSWORD_DEFAULT),
        $data['role'],
        $data['phone'] ?? null,
        $data['photo_path'] ?? null,
        ($data['role'] === 'staff' ? ($data['store_name'] ?? null) : null),
        ($data['role'] === 'staff' ? ($data['store_address'] ?? null) : null),
    ]);
}

function user_update_profile(int $id, array $data): bool
{
    $stmt = db_connect()->prepare('UPDATE users SET first_name = ?, last_name = ?, phone = ?, photo_path = ?, store_name = ?, store_address = ?, store_cover_image = ?, store_description = ?, gcash_number = ? WHERE id = ?');
    return $stmt->execute([
        $data['first_name'] ?? null,
        $data['last_name'] ?? null,
        $data['phone'] ?? null,
        $data['photo_path'] ?? null,
        $data['store_name'] ?? null,
        $data['store_address'] ?? null,
        $data['store_cover_image'] ?? null,
        $data['store_description'] ?? null,
        $data['gcash_number'] ?? null,
        $id,
    ]);
}

// product helpers
function product_list()
{
    // Build query based on available columns
    $query = 'SELECT p.*';
    
    // Check if user_id column exists by trying to fetch count first
    $checkStmt = db_connect()->query("SHOW COLUMNS FROM products LIKE 'user_id'");
    $hasUserId = $checkStmt->rowCount() > 0;
    
    if ($hasUserId) {
        $checkName = db_connect()->query("SHOW COLUMNS FROM users LIKE 'store_name'");
        if ($checkName->rowCount() > 0) {
            $query = 'SELECT p.*, IFNULL(u.store_name, "Unknown Store") as store_name, u.store_address FROM products p LEFT JOIN users u ON p.user_id = u.id';
        } else {
            $query = 'SELECT p.* FROM products p';
        }
    } else {
        $query = 'SELECT p.* FROM products p';
    }
    
    $query .= ' ORDER BY p.created_at DESC';
    $stmt = db_connect()->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function product_find(int $id)
{
    // Check if user_id column exists
    $checkStmt = db_connect()->query("SHOW COLUMNS FROM products LIKE 'user_id'");
    $hasUserId = $checkStmt->rowCount() > 0;
    
    if ($hasUserId) {
        $checkName = db_connect()->query("SHOW COLUMNS FROM users LIKE 'store_name'");
        if ($checkName->rowCount() > 0) {
            $stmt = db_connect()->prepare('SELECT p.*, IFNULL(u.store_name, "Unknown Store") as store_name, u.store_address FROM products p LEFT JOIN users u ON p.user_id = u.id WHERE p.id = ?');
        } else {
            $stmt = db_connect()->prepare('SELECT p.* FROM products p WHERE p.id = ?');
        }
    } else {
        $stmt = db_connect()->prepare('SELECT p.* FROM products p WHERE p.id = ?');
    }
    
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function product_create(array $data)
{
    $user = auth_user();
    
    // Check if user_id and image_path columns exist
    $checkUserId = db_connect()->query("SHOW COLUMNS FROM products LIKE 'user_id'");
    $hasUserId = $checkUserId->rowCount() > 0;
    
    $checkImage = db_connect()->query("SHOW COLUMNS FROM products LIKE 'image_path'");
    $hasImage = $checkImage->rowCount() > 0;
    
    if ($hasUserId && $hasImage) {
        $stmt = db_connect()->prepare('INSERT INTO products (user_id, name, description, price, image_path) VALUES (?, ?, ?, ?, ?)');
        return $stmt->execute([
            $user['id'] ?? null,
            $data['name'],
            $data['description'],
            $data['price'],
            $data['image_path'] ?? null,
        ]);
    } elseif ($hasImage) {
        $stmt = db_connect()->prepare('INSERT INTO products (name, description, price, image_path) VALUES (?, ?, ?, ?)');
        return $stmt->execute([
            $data['name'],
            $data['description'],
            $data['price'],
            $data['image_path'] ?? null,
        ]);
    } else {
        $stmt = db_connect()->prepare('INSERT INTO products (name, description, price) VALUES (?, ?, ?)');
        return $stmt->execute([
            $data['name'],
            $data['description'],
            $data['price'],
        ]);
    }
}

function product_update(int $id, array $data)
{
    $stmt = db_connect()->prepare('UPDATE products SET name = ?, description = ?, price = ?, image_path = ? WHERE id = ?');
    return $stmt->execute([
        $data['name'],
        $data['description'],
        $data['price'],
        $data['image_path'] ?? null,
        $id,
    ]);
}

function product_delete(int $id)
{
    $stmt = db_connect()->prepare('DELETE FROM products WHERE id = ?');
    return $stmt->execute([$id]);
}

// store helpers
function store_list()
{
    $stmt = db_connect()->query('SELECT id, first_name, last_name, store_name, store_address, store_cover_image, gcash_number, store_description, photo_path FROM users WHERE role = "staff" ORDER BY store_name ASC');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// file upload helper
function handle_upload(array $file): ?string
{
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadsDir = __DIR__ . '/../uploads';
        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
        }
        $filename = basename($file['name']);
        $dest = $uploadsDir . '/' . $filename;
        if (move_uploaded_file($file['tmp_name'], $dest)) {
            // return path relative to web root
            return 'uploads/' . $filename;
        }
    }
    return null;
}


// user management helpers
function user_update_password(int $id, string $newPassword): bool
{
    $stmt = db_connect()->prepare('UPDATE users SET password = ? WHERE id = ?');
    return $stmt->execute([password_hash($newPassword, PASSWORD_DEFAULT), $id]);
}

// auth helpers
function auth_attempt(string $email, string $password): bool
{
    $user = user_find_by_email($email);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role']
        ];
        return true;
    }
    return false;
}

function auth_check(): bool
{
    return isset($_SESSION['user']);
}

function auth_user()
{
    return $_SESSION['user'] ?? null;
}

function auth_logout()
{
    session_destroy();
}

function require_role(string $role)
{
    if (!auth_check() || auth_user()['role'] !== $role) {
        header('Location: /?error=Unauthorized');
        exit;
    }
}
