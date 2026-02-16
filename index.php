<?php

require_once __DIR__ . '/src/functions.php';

session_start();

// load environment variables from .env if present
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = parse_ini_file(__DIR__ . '/../.env');
    foreach ($dotenv as $k => $v) {
        putenv("$k=$v");
    }
}

// simple routing
$page = $_GET['page'] ?? 'home';

// if the visitor is already logged in, send them directly to their dashboard
if ($page === 'home' && auth_check()) {
    header('Location: /?page=dashboard');
    exit;
}

switch ($page) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (auth_attempt($_POST['email'], $_POST['password'])) {
                // redirect according to role immediately
                $role = auth_user()['role'] ?? null;
                switch ($role) {
                    case 'admin':
                        header('Location: /?page=admin');
                        break;
                    case 'staff':
                        header('Location: /?page=staff');
                        break;
                    case 'student':
                        header('Location: /?page=student');
                        break;
                    default:
                        header('Location: /?page=dashboard');
                        break;
                }
                exit;
            } else {
                $error = 'Invalid credentials';
            }
        }
        require __DIR__ . '/src/views/login.php';
        break;
    case 'logout':
        auth_logout();
        header('Location: /');
        break;
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // handle profile photo upload
            if (!empty($_FILES['photo']['name'])) {
                $_POST['photo_path'] = handle_upload($_FILES['photo']);
            }
            // store details only relevant for staff; can be null
            user_create($_POST);
            header('Location: /?page=login');
            exit;
        }
        require __DIR__ . '/src/views/register.php';
        break;
    case 'dashboard':
        if (!auth_check()) {
            header('Location: /?page=login');
            exit;
        }
        // forward to role-specific page rather than show generic dashboard
        $role = auth_user()['role'];
        switch ($role) {
            case 'admin':
                header('Location: /?page=admin');
                exit;
            case 'staff':
                header('Location: /?page=staff');
                exit;
            case 'student':
                header('Location: /?page=student');
                exit;
            default:
                require __DIR__ . '/src/views/dashboard.php';
                break;
        }
        break;
    case 'admin':
        require_role('admin');
        echo '<h2>Admin Panel</h2>';
        break;
    case 'staff':
        require_role('staff');
        // show list and creation form
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
            // handle image upload
            if (!empty($_FILES['image']['name'])) {
                $_POST['image_path'] = handle_upload($_FILES['image']);
            }
            product_create($_POST);
            header('Location: /?page=staff');
            exit;
        }
        $products = product_list();
        require __DIR__ . '/src/views/staff.php';
        break;
    case 'create_product':
        require_role('staff');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            product_create($_POST);
        }
        header('Location: /?page=staff');
        break;
    case 'edit_product':
        require_role('staff');
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /?page=staff');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['image']['name'])) {
                $_POST['image_path'] = handle_upload($_FILES['image']);
            }
            product_update($id, $_POST);
            header('Location: /?page=staff');
            exit;
        }
        $product = product_find($id);
        require __DIR__ . '/src/views/edit_product.php';
        break;
    case 'delete_product':
        require_role('staff');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            product_delete($_POST['id']);
        }
        header('Location: /?page=staff');
        break;
    case 'account':
        if (!auth_check()) {
            header('Location: /?page=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = auth_user();

            // profile update
            if (isset($_POST['first_name']) || isset($_FILES['photo']) || isset($_POST['store_name']) || isset($_POST['store_address'])) {
                if (!empty($_FILES['photo']['name'])) {
                    $_POST['photo_path'] = handle_upload($_FILES['photo']);
                }
                user_update_profile($user['id'], $_POST);
                $message = 'Profile updated.';
            }

            // password change
            if (!empty($_POST['current_password']) || !empty($_POST['new_password'])) {
                $current = $_POST['current_password'] ?? '';
                $new = $_POST['new_password'] ?? '';
                $stmt = db_connect()->prepare('SELECT password FROM users WHERE id = ?');
                $stmt->execute([$user['id']]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row && password_verify($current, $row['password']) && $new !== '') {
                    user_update_password($user['id'], $new);
                    $message = isset($message) ? $message . ' Password changed.' : 'Password updated.';
                } else {
                    $error = 'Current password invalid or new password empty.';
                }
            }
        }
        require __DIR__ . '/src/views/account.php';
        break;
    case 'student':
        require_role('student');
        $products = product_list();
        require __DIR__ . '/src/views/student.php';
        break;
    default:
        require __DIR__ . '/src/views/home.php';
        break;
}
