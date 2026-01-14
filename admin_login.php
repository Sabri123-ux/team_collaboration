<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']); // encrypt password

    // prepared statement
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid Email or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<style>
body { font-family: Arial, sans-serif; background:#f0f0f0; }
.login-box {
    width: 300px; margin: 100px auto; padding: 20px;
    background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
input { width: 100%; padding: 8px; margin: 8px 0; }
button { width: 100%; padding: 10px; background: blue; color: #fff; border: none; }
.error { color:red; text-align:center; }
</style>
</head>
<body>
<div class="login-box">
    <h2>Admin Login</h2>
    <?php if(isset($error)){ echo '<p class="error">'.$error.'</p>'; } ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
</div>
</body>
</html>
