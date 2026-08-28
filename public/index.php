<?php
session_start();

function redirectByRole(string $role): void
{
    $role = strtoupper(trim($role));

    $page = match ($role) {
        'SUPERADMIN' => 'superadmin.php',
        'ADMIN' => 'admin_home.php',
        'FIELD USER' => 'form.php',
        default => 'index.php',
    };

    header('Location: ' . $page);
    exit;
}

// If already logged in, redirect according to the saved role.
if (!empty($_SESSION['user_id'])) {
    redirectByRole($_SESSION['role'] ?? '');
}

require_once __DIR__ . '/../config/database.php';

$login_error   = '';
$login_success = false;
$logged_in_user = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mobile = trim($_POST['mobile'] ?? '');
    $password  = $_POST['password'] ?? '';

    if ($mobile === '' || $password === '') {
        $login_error = 'Please enter both mobile number and password.';
    } else {
        $stmt = $pdo->prepare(
            "SELECT id, user_name, mobile, password, role, div_name, Zone, executing_agency, desig, status
             FROM users
             WHERE mobile = ?
             LIMIT 1"
        );
        $stmt->execute([$mobile]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {

            if ($user['status'] != 1) {
                $login_error = 'Your account is inactive. Please contact the administrator.';
            } else {
                // Store session data
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['username']  = $user['user_name'];
                $_SESSION['mobile']    = $user['mobile'];
                $_SESSION['role']      = $user['role'];
                $_SESSION['div_name']  = $user['div_name'];
                $_SESSION['zone']      = $user['Zone'];
                $_SESSION['executing_agency'] = $user['executing_agency'];
                $_SESSION['desig']     = $user['desig'];

                redirectByRole($user['role']);
            }

        } else {
            $login_error = 'Invalid mobile number or password.';
        }
    }
}
?>


<!-- This is UI Code--------------------------------------------------------------------------------- -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | EIG Module</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/trd_eig/public/js/swal.js"></script>

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
                <label for="mobile">Registered Mobile No.</label>
                <input
                    type="number"
                    id="mobile"
                    name="mobile"
                    placeholder="Enter Registered Mobile Number"
                    autocomplete="mobile"
                    value="<?= htmlspecialchars($_POST['mobile'] ?? '') ?>"
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







<!-- This is Alert Fuction Scripts-------------------------------------------------------------------- -->
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