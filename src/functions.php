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
    $stmt = db_connect()->prepare('INSERT INTO users (first_name, last_name, email, password, role, phone, photo_path) VALUES (?, ?, ?, ?, ?, ?, ?)');
    return $stmt->execute([
        $data['first_name'] ?? null,
        $data['last_name'] ?? null,
        $data['email'],
        password_hash($data['password'], PASSWORD_DEFAULT),
        $data['role'],
        $data['phone'] ?? null,
        $data['photo_path'] ?? null,
    ]);
}

function user_update_profile(int $id, array $data): bool
{
    $stmt = db_connect()->prepare('UPDATE users SET first_name = ?, last_name = ?, phone = ?, photo_path = ? WHERE id = ?');
    return $stmt->execute([
        $data['first_name'] ?? null,
        $data['last_name'] ?? null,
        $data['phone'] ?? null,
        $data['photo_path'] ?? null,
        $id,
    ]);
}

// product helpers
function product_list()
{
    $stmt = db_connect()->query('SELECT * FROM products ORDER BY created_at DESC');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function product_find(int $id)
{
    $stmt = db_connect()->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function product_create(array $data)
{
    $stmt = db_connect()->prepare('INSERT INTO products (name, description, price, image_path) VALUES (?, ?, ?, ?)');
    return $stmt->execute([
        $data['name'],
        $data['description'],
        $data['price'],
        $data['image_path'] ?? null,
    ]);
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
