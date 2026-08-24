<?php
session_start();

// If already logged in, redirect to home
if (!empty($_SESSION['user_id'])) {
    header('Location: /admin_home.php');
    exit;
}

require_once __DIR__ . '/../config/database.php';

$login_error   = '';
$login_success = false;
$logged_in_user = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_name = trim($_POST['user_name'] ?? '');
    $password  = $_POST['password'] ?? '';

    if ($user_name === '' || $password === '') {
        $login_error = 'Please enter both username and password.';
    } else {
        $stmt = $pdo->prepare(
            "SELECT id, user_name, password, role, div_name, Zone, status
             FROM users
             WHERE user_name = ?
             LIMIT 1"
        );
        $stmt->execute([$user_name]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {

            if ($user['status'] != 1) {
                $login_error = 'Your account is inactive. Please contact the administrator.';
            } else {
                // Store session data
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['role']      = $user['role'];
                $_SESSION['div_name']  = $user['div_name'];
                $_SESSION['zone']      = $user['Zone'];

                $login_success  = true;
                $logged_in_user = $user['user_name'];
            }

        } else {
            $login_error = 'Invalid username or password.';
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | EIG Module</title>
    <link rel="stylesheet" href="/css/login.css">
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/js/swal.js"></script>

<body>

<div class="login-wrapper">
    <div class="login-card">
        <div class="logo-area">
            <div class="logo">EIG</div>
            <h1>EIG Module</h1>
            <p>Electrical TRD Infrastructure &amp; Projects</p>
        </div>

        <form method="POST" action="" id="loginForm">
            <div class="form-group">
                <label for="user_name">Username</label>
                <input
                    type="text"
                    id="user_name"
                    name="user_name"
                    placeholder="Enter username"
                    autocomplete="username"
                    value="<?= htmlspecialchars($_POST['user_name'] ?? '') ?>"
                    required
                >
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter password"
                    autocomplete="current-password"
                    required
                >
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>

        <div class="login-footer">
            Traction Rolling Department, W.R
        </div>
    </div>
</div>






<?php if ($login_success): ?>
<script>
    showWelcome(
        <?= json_encode($logged_in_user) ?>,
        '/admin_home.php'
    );
</script>
<?php elseif ($login_error !== ''): ?>
<script>
    Swal.fire({
        title: 'Login Failed',
        text: <?= json_encode($login_error) ?>,
        icon: 'error',
        confirmButtonText: 'Try Again',
        background: 'rgba(10, 10, 10, 0.92)',
        color: '#ffffff',
        showClass: {
            popup: 'animate__animated animate__shakeX'
        }
    });
</script>
<?php endif; ?>

</body>
</html>