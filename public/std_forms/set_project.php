<?php
session_start();
if (isset($_POST['common_id']) && $_POST['common_id'] !== '') {
    $_SESSION['common_id'] = $_POST['common_id'];
}
header("Location: /std_forms/form_10_01.php");
exit;